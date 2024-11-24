<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Validator;

class BidderController extends Controller
{
    public function indexSummary()
    {
        $user = new User();
        $data['pending'] = $user->countBidder((int)$user::PENDING);
        $data['approved'] = $user->countBidder((int)$user::APPROVED);

        return view('bidders.index')->with('data', $data);
    }

    public function ajaxSummaryPending()
    {
        $user = new User();

        $query = $user->query();

        // if(isset($_GET['search_email'])  && strlen($_GET['search_email']) != ""){
        //     $query->where('email', '=', (string)$_GET['search_email']);
        // }

        // if(isset($_GET['search_name'])  && strlen($_GET['search_name']) != ""){
        //     $query->where('name', 'LIKE', '%'.(string)$_GET['search_name'].'%');
        // }

        // $query->where('role_id', '!=', (int)$user::ROLE_ROOT);

        $query->where('customer_status', '=', (int)$user::PENDING);
        // $pending = count($query);
        $data = $query
        ->orderBy('updated_at', 'DESC')
        ->paginate(15);

        return view('bidders.ajax.index')
        ->with('data', $data);
    }

    public function ajaxSummaryApproved()
    {
        $user = new User();

        $query = $user->query();


        // if(isset($_GET['search_email'])  && strlen($_GET['search_email']) != ""){
        //     $query->where('email', '=', (string)$_GET['search_email']);
        // }

        // if(isset($_GET['search_name'])  && strlen($_GET['search_name']) != ""){
        //     $query->where('name', 'LIKE', '%'.(string)$_GET['search_name'].'%');
        // }

        $query->where('customer_status', '=', (int)$user::APPROVED);

        $data = $query
        ->orderBy('updated_at', 'DESC')
        ->paginate(15);

        return view('bidders.ajax.index')
        ->with('data', $data);
    }

    public function viewDetails($id)
    {
        $data = array();

        $user = new User();

        $query = $user->query();

        $query->where('id', '=', (int)$id);

        $data = $query->first();

        return view('bidders.view')->with('data', $data);
    }

    public function bidderPut(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'email' => 'required',
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
            exit();
        }
        $user = new User();

        $user->where('id', '=', (int)$request->id)->update([
            'customer_status' => $user::APPROVED,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $response = [
            'success' => true,
            'message' => "Bidder has successfully been approved.",
        ];


        MailController::sendNotifApproved(
            $request->email,
            [
                "firstname" => $request->firstname,
            ]
        );

        return response()->json($response, 200);
    }
}
