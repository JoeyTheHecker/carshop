<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BiddingCycle;
use App\Models\Products;

class IndexController extends Controller
{
    public function index(){
        date_default_timezone_set('Asia/Singapore');
        // exit;
        $data = array();

        $products = new Products();
        $biddingCycles = new BiddingCycle();


        // $data['winning_bids'] = $products->winningBids(3);
        // $data['is_bidding_open'] = $products->isBiddingOpen();

        $data['bidding_cycles'] = $biddingCycles->orderBy('id', 'desc')->first();

        if($data['bidding_cycles']){
            $endDate = new \DateTime($data['bidding_cycles']->end_date);


            if ($data['bidding_cycles']->is_open != 1) {
                $endDate->modify('+39 hours');
                $data['bidding_cycles']->end_date = $endDate->format('Y-m-d H:i:s');
            }
            $endDate = $endDate->diff(new \DateTime());

            $data['bidding_cycles'] = (object) [
                "start_date" => $data['bidding_cycles']->start_date,
                "end_date" => $data['bidding_cycles']->end_date,
                "end_timer" => $endDate,
                "is_open" => $data['bidding_cycles']->is_open,
                "id" => $data['bidding_cycles']->id
            ];
        }

        return view('index')->with('data', $data);
    }
}
