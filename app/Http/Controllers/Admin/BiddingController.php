<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\MailController;
use App\Models\Bids;
use App\Models\Products;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class BiddingController extends Controller
{
    public function indexSummary()
    {
        return view('bidding.index');
    }

    public function biddingAjaxSummary()
    {
        $query = "SELECT b.amount AS max_amount, b.product_id, b.status AS bid_status, b.bidding_cycle_id, p.*, bc.* FROM (
            SELECT product_id, MAX(amount) as max_amount
            FROM bids
            GROUP BY product_id
        ) as max_bids
        JOIN bids b ON b.product_id = max_bids.product_id AND b.amount = max_bids.max_amount
        JOIN products p ON b.product_id = p.id
        JOIN bidding_cycles bc ON b.bidding_cycle_id = bc.id
        ";


        $bindings = [];
        if (isset($_GET['start_date']) && strlen($_GET['start_date']) > 0 && isset($_GET['end_date']) && strlen($_GET['end_date']) > 0) {
            $query .= " WHERE bc.start_date >= ? AND bc.end_date <= ?";
            $bindings[] = $_GET['start_date'];
            $bindings[] = $_GET['end_date'];
        } else {
            $latestCycle = DB::table('bidding_cycles')->orderBy('id', 'desc')->select('id')->first();
            $query .= " WHERE b.bidding_cycle_id = ?";
            $bindings[] = $latestCycle->id;
        }

        if (isset($_GET['search_name']) && strlen($_GET['search_name']) != "") {
            $query .= " AND b.full_name LIKE ?";
            $bindings[] = '%' . $_GET['search_name'] . '%';
        }

        if (isset($_GET['search_email']) && strlen($_GET['search_email']) != "") {
            $query .= " AND b.email_add LIKE ?";
            $bindings[] = '%' . $_GET['search_email'] . '%';
        }

        $query .= " ORDER BY b.amount";

        $results = DB::select($query, $bindings);
        $bids_count = count($results);
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $perPage = 15;
        $offset = ($page - 1) * $perPage;
        $pagedData = array_slice($results, $offset, $perPage);

        $paginatedData = new LengthAwarePaginator(
            $pagedData,
            count($results),
            $perPage,
            $page,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('bidding.ajax.index')
            ->with('data', $paginatedData)
            ->with('bids_count', $bids_count);
    }

    public function bidderInfo($id, $cycle_id, $bid_id)
    {
        Log::info('bidder info');
        $result = DB::table('bids')
            ->where('bids.id', $bid_id)
            ->where('bids.product_id', $id)
            ->where('bids.bidding_cycle_id', $cycle_id)
            ->join('users', 'users.id', '=', 'bids.customer_id')
            ->select('bids.*', 'users.date_banned')
            ->first();
        $position = DB::select(
            "SELECT COUNT(id) AS cnt FROM bids WHERE product_id = ? AND bidding_cycle_id = ? AND amount > (SELECT amount FROM bids WHERE id = ?) AND status NOT IN ('backedout', 'rejected')",
            [$id, $cycle_id, $bid_id]
        );

        return view('bidding.ajax.bidder_info')->with('data', $result)->with('bid_position', $position[0]->cnt);

        // return response()->json(['data' => $result]);
    }

    public function biddingInfo($id, $cycleId)
    {
        $product = DB::table('products')
            ->where('id', $id)->first();

        $bids = DB::table('bids')
            ->select('bids.status AS bid_status', 'bids.id AS bidder_id','bids.created_at AS bid_created_at', 'bids.*', 'users.*', 'products.*')
            ->join('users', 'users.id', '=', 'bids.customer_id')
            ->join('products', 'products.id', '=', 'bids.product_id')
            ->where('bids.product_id', $id)
            ->where('bids.bidding_cycle_id', $cycleId)
            ->orderBy('bids.amount', 'DESC')
            ->get();


        if (count($bids) == 0) {
            exit;
        }
        Log::info($bids);
        $data = (object) array(
            'product' => $product,
            'bids' => $bids
        );

        return view('bidding.bidding_info')->with('data', $data);
    }

    public function productSold(Request $request, $product_id, $cycle_id, $bid_id)
    {
        Validator::make(
            [$product_id, 'exists:products,id'],
            [$bid_id, 'exists:bids,id'],
            [$cycle_id, 'exists:bidding_cycles,id']
        );

        DB::transaction(function () use ($bid_id, $cycle_id, $product_id) {
            DB::table('bids')
                ->where('id', $bid_id)
                ->where('bidding_cycle_id', $cycle_id)
                ->where('product_id', $product_id)
                ->update(['status' => 'sold']);

            // set the status of the pruduct to sold in the products table
            DB::table('products')
                ->where('id', $product_id)
                ->whereIn('status', ['0', '4'])
                ->update(['status' => 2, 'is_sold' => 'SOLD THROUGH BIDDING']);
        });

        return response()->json(['message' => 'Success']);
    }

    public function backOutBid(Request $request, $product_id, $cycle_id, $bid_id)
    {
        Validator::make(
            [$product_id, 'exists:products,id'],
            [$bid_id, 'exists:bids,id'],
            [$cycle_id, 'exists:bidding_cycles,id']
        );
        DB::table('bids')
            ->where('id', $bid_id)
            ->where('bidding_cycle_id', $cycle_id)
            ->where('product_id', $product_id)
            ->update(['status' => 'backed_out']);

        return response()->json(['message' => 'Success']);
    }

    public function banUser(Request $request, $product_id, $cycle_id, $bid_id)
    {
        Validator::make(
            [$product_id, 'exists:products,id'],
            [$bid_id, 'exists:bids,id'],
            [$cycle_id, 'exists:bidding_cycles,id']
        );

        $user = DB::table('bids')
            ->where('id', $bid_id)
            ->where('bidding_cycle_id', $cycle_id)
            ->where('product_id', $product_id)
            ->first();

        DB::transaction(function () use ($user, $bid_id, $cycle_id, $product_id) {
            DB::table('users')
                ->where('id', $user->customer_id)
                // ->where('role_id', '2') // user is not an admin
                ->update([
                    'date_banned' => date('Y-m-d H:i:s') //user is banned
                ]);

            // set to status to defaulted
            DB::table('bids')
                ->where('id', $bid_id)
                ->where('bidding_cycle_id', $cycle_id)
                ->where('product_id', $product_id)
                ->update(['status' => 'defaulted']);
        });

        MailController::sendNotifBanned(
            $user->email_add,
            [
                "firstname" => $user->firstname,
            ]
        );

        return response()->json(['message' => 'Success']);
    }

    private function getHighestBid($id, $cycle_id)
    {
        return DB::table('bids')
            ->where('product_id', $id)
            ->where('bidding_cycle_id', $cycle_id)
            ->where('status', 'pending')
            ->orderBy('amount', 'desc')
            ->first();
    }
}
