<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\MailController;
use App\Models\Bids;
use App\Models\BiddingCycle;
use App\Models\Products;
use Storage;
use Illuminate\Support\Facades\Log;


class BidsController extends Controller
{
    public function placeBid(Request $request){
        date_default_timezone_set('Asia/Singapore');

        $request->validate([
            'product_identification_number' => 'required|exists:products,product_identification_number|max:255',
            'product_id' => 'required|exists:products,id|max:255',
            'bid_amount' => 'required|numeric|min:1'
        ]);


        // check if user is banned
        $dateBanned = new \DateTime(auth()->user()->date_banned);

        // Add 6 months to the date_banned
        $dateBanned->modify('+6 months');

        // Get the current date and time
        $currentDate = new \DateTime();

        // Check if the current date is equal to or greater than the new date
        if ($currentDate < $dateBanned && auth()->user()->date_banned != null) {
            return redirect()->back()->withErrors(["msg" => "Cannot bid at this time. You have been banned."])->withInput();
        }

        //check if highest bid exists
        if ($highestBid = $this->getHighestBid($request->product_id)) {
            if ($highestBid->customer_id == Auth::user()->id) {
                return redirect()->back()->withErrors(["msg" => "You must be outbid before you can re-bid."])->withInput();
            }
            if ($highestBid->amount + 4999 >= $request->bid_amount) {
                return redirect()->back()->withErrors(["msg" => "Bid amount must be higher than the current highest bid by ₱5000."])->withInput();
            }
        }else{
            //if highest bid does not exist, check for minimum bid amount
            if($product = Products::where('product_identification_number', $request->product_identification_number)->where('id', $request->product_id)->first()){
                //minimum amount must be 50% or 70% of selling price + 5000 bid amount
                if((($product->selling_price * $product->min_bid_price) + 4999) >= $request->bid_amount){
                    return redirect()->back()->withErrors(["msg" => "Bid amount does not meet the minimum."])->withInput();
                }
            }else{
                return redirect()->back()->withErrors(["msg" => "Product does not exist."])->withInput();
            }
        }

        $bid = new Bids();

        $bid->customer_id = (int) Auth::user()->id;
        $bid->product_id = (int) $request->product_id;
        $bid->bidding_cycle_id = Products::isBiddingOpen()->id;
        $bid->product_identification_number = $request->product_identification_number;
        $bid->amount = $request->bid_amount;
        $bid->firstname = Auth::user()->firstname;
        $bid->middlename = Auth::user()->middlename;
        $bid->lastname = Auth::user()->lastname;
        $bid->email_add = Auth::user()->email;
        $bid->mobile_number = Auth::user()->mobile_number;
        $bid->birth_date = Auth::user()->date_of_birth;
        $bid->address = Auth::user()->address;
        // $bid->source_of_income = Auth::user()->source_of_income;
        $bid->e_signature = Auth::user()->e_signature;
        $bid->govt_id = Auth::user()->govt_id;
        $bid->selfie_with_id = Auth::user()->selfie_with_id;
        $bid->save();

        if ($highestBid) {
            $products = new Products();
            $cycle = BiddingCycle::orderBy('id', 'desc')->first();
            $endDate = new \DateTime($cycle->end_date);
            $remaining_time = $endDate->diff(new \DateTime()); // Calculate the time difference

            // Log the remaining time in hours
            Log::info($remaining_time->format('%h hours'));

            MailController::sendMail(
                $highestBid->email_add,
                [
                    "product_id" => $request->product_id,
                    "product_name" => $products->find($request->product_id)->product_name,
                    "time_remaining" => $endDate->diff(new \DateTime())
                ]
            );
        }

        // MailController::sendReceipt(
        //     Auth::user()->email,
        //     [
        //         "bid_amount" => $request->bid_amount,
        //         "product_identification_number" => $request->product_identification_number,
        //     ]
        // );

        // MailController::sendRfShopCopy([
        //         "bid_amount" => $request->bid_amount,
        //         "product_identification_number" => $request->product_identification_number,
        //     ]
        // );

        return redirect()->back()->with('status', 'Bidding success!');
    }

    private function getHighestBid($id)
    {
        return DB::table('bids')
            ->where('product_id', $id)
            ->where('bidding_cycle_id', Products::isBiddingOpen()->id)
            ->where('status', 'pending')
            ->orderBy('amount', 'desc')
            ->first();
    }
}
