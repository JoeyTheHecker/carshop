<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $data = array();

        $products = new Products();
        // $inquiry = new Inquiry();

        // $data['newInquiry'] = $inquiry->ctrInquiryToday();
        $data['totalActive'] = $products->ctrProducts($products::STATUS_ACTIVE);
        $data['totalSold'] = $products->ctrProducts($products::STATUS_SOLD);
        $data['totalInactive'] = $products->ctrProducts($products::STATUS_INACTIVE);
        $data['totalActiveBids'] = $this->totalActiveBids();

        return view('admin.dashboard')
        ->with('data', $data);
    }

    private function totalActiveBids(){
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

        $latestCycle = DB::table('bidding_cycles')->orderBy('id', 'desc')->select('id')->first();
        $query .= " WHERE b.bidding_cycle_id = ?";
        $bindings[] = $latestCycle->id;

        $results = DB::select($query, $bindings);
        return count($results);

    }
}
