<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Products;
use App\Models\CustomerIntent;

class ProductController extends Controller
{
    public function search(){
        $data = array();

        $products = new Products();

        $query = $products->query();

        $query->where('status', '=', 0)->get();

        $data = $query->paginate(20);

        return view('ajax.search')
            ->with('data', $data);
    }

    public function postCustomerLoi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_product_id' => 'required',
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'customer_mobile' => 'required',
            'customer_address' => 'required',
            'bid_amount' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
            exit();
        }

        $cusIntentSave = new CustomerIntent();
        $cusIntentSave->agent_name = $request->agent_name;
        $cusIntentSave->product_id = $request->customer_product_id;
        $cusIntentSave->name = $request->customer_name;
        $cusIntentSave->email = $request->customer_email;
        $cusIntentSave->contact_number = $request->customer_mobile;
        $cusIntentSave->address = $request->customer_address;
        $cusIntentSave->region = $request->region;
        $cusIntentSave->bid_amount = $request->bid_amount;
        $cusIntentSave->presented_id = '-';
        $cusIntentSave->type_id = 1;
        $cusIntentSave->status = CustomerIntent::STATUS_ACTIVE;
        $cusIntentSave->save();

        if($cusIntentSave){
            $response = [
                'success' => true
            ];
        }else{
            $response = [
                'success' => false,
                'message' => "Cannot process the transaction right now...",
            ];
        }

        return response()->json($response, 200);
    }
}
