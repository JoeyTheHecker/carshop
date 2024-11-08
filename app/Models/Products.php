<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'products';
    protected $guarded = [];

    public $timestamps = true;

    protected $casts = [
        'min_bid_price' => 'decimal:2',
    ];


    const STATUS_ACTIVE = 0;
    const STATUS_INACTIVE = 1;
    const STATUS_SOLD = 2;
    const STATUS_DELETED = 3;
    const STATUS_BIDDING = 4;

    public function getCategory()
    {
        return $this->belongsTo('App\Models\Categories', 'category_id','id');
    }

    public function getSubCategory()
    {
        return $this->belongsTo('App\Models\Subcategory', 'sub_category_id','id');
    }

    public function getGroup()
    {
        return $this->belongsTo('App\Models\Groups', 'group_id','id');
    }

    public function generateUniqueID()
    {
        return date('Y').''.substr(str_shuffle("0123456789").''.rand(000,999), 0, 10);
    }

    public function isStatus()
    {
        if($this->status == self::STATUS_ACTIVE){
            return 'Active';
        }elseif($this->status == self::STATUS_INACTIVE){
            return 'Draft';
        }elseif($this->status == self::STATUS_SOLD){
            return 'Sold';
        }elseif($this->status == self::STATUS_DELETED){
            return 'Deleted';
        }elseif($this->status == self::STATUS_BIDDING){
            return 'For Bidding';
        }else{
            return 'None';
        }
    }

    public function ctrProducts($status)
    {
        if($status == 0){
           $result = self::whereIn('status', [0,4])->count();
        }else{
           $result = self::where('status', (int)$status)->count();
        }


        if($result){
            return $result;
        }

        return 0;
    }

    public function getYoutubeVideoId($url) {
        // Regular expression to extract video ID from YouTube URL
        $pattern = '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';

        // Execute the regular expression
        preg_match($pattern, $url, $matches);

        // Check if a match was found
        if (isset($matches[1])) {
            // Return the video ID
            return $matches[1];
        } else {
            // Return null if no match was found
            return null;
        }
    }

    public function clearSellingPrice()
    {
        return number_format($this->selling_price, 2);
    }
    public static function minBidPrice($id)
    {
        $product = DB::table('products')
        ->where('id', $id)
        ->select('min_bid_price')
        ->first();

        return $product ? $product->min_bid_price : null;
    }

    public static function isBiddingOpen()
    {
        return DB::table('bidding_cycles')
            ->orderBy('id', 'desc')
            ->select('id', 'is_open', 'start_date', 'end_date')
            ->first();
    }
}
