<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Bids;
use App\Models\ProductGallery;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {
        return view('search');
    }
    public function details($id)
    {
        date_default_timezone_set('Asia/Singapore');

        $data = Products::FindOrFail($id);

        /* gallery */
        $gallery = new ProductGallery();

        $product_gallery = $gallery->where('product_id', '=', (int)$id)->get();

        $currentDateTime = date('Y-m-d H:i:s');
        $biddingCycle = DB::table('bidding_cycles')
            ->where('is_open', 1)
            ->where('start_date', '<', $currentDateTime)
            ->where('end_date', '>', $currentDateTime)
            ->orderBy('id', 'desc')
            ->select('id', 'is_open', 'start_date', 'end_date')
            ->first();



        $biddingData = (object) [];
        if ($biddingCycle) {
            $bids = DB::table('bids')
                ->where('product_id', $id)
                ->orderBy('amount', 'desc')
                ->select('amount')
                ->first();
            // dd($id);

            $endDate = new \DateTime($biddingCycle->end_date);
            $endDate = $endDate->diff(new \DateTime());
            $biddingData->bidding_cycle = (object) [
                "start_date" => $biddingCycle->start_date,
                "end_date" => $biddingCycle->end_date,
                "end_timer" => $endDate,
                "is_open" => $biddingCycle->is_open,
                "id" => $biddingCycle->id
            ];

            $bidCount = Bids::where('bidding_cycle_id', $biddingCycle->id)->where('product_id', $data->id)->count();
            $biddingData->bid_count = $bidCount;

            $biddingData->max_amount = !$bids || $data->selling_price < $bids->amount
                ? $data->selling_price * $data->minBidPrice($id)
                : $bids->amount;
            // dd($biddingData->max_amount);
        }

        return view('details',compact('data'))->with('product_gallery', $product_gallery)->with('bidding_data', $biddingData);
    }
}
