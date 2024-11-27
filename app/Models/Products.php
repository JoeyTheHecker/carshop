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

    public static function filterInput($data)
    {
        // Fix &entity\n;
        $data = str_replace(array('&amp;', '&lt;', '&gt;'), array('&amp;amp;', '&amp;lt;', '&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        $badSyntax = array("--", "'", "\"", "*", "onload", "onmouseover1 ", "=", "(", ")", "[", "]", "<", ">", "/", "script", "alert");
        $data = str_replace($badSyntax, "", $data);
        $data = strip_tags($data);
        $data = filter_var($data, FILTER_SANITIZE_STRING);

        return $data;
    }
    public function hotBids($limit)
    {
        $subquery = DB::table('bidding_cycles')
            ->select('id')
            ->where('is_open', 1)
            ->orderByDesc('id')
            ->limit(1);

        // Main query
        $userId = auth()->id(); // Assuming you're using Laravel's authentication to get the logged-in user's ID

    $query = self::query()
        ->select(
            'products.id',
            'products.product_identification_number',
            'products.product_name',
            'products.image',
            DB::raw('COUNT(DISTINCT bids.customer_id) AS bidders_count'),
            DB::raw('COUNT(bids.id) AS bid_count')
        )
        ->leftJoin('bids', 'products.id', '=', 'bids.product_id')
        ->where('bids.bidding_cycle_id', '=', $subquery) // Filter by bidding cycle
        ->where('bids.customer_id', '=', $userId) // Add condition for logged-in user
        ->whereRaw('bids.created_at = (SELECT MAX(b.created_at) FROM bids b WHERE b.product_id = bids.product_id AND b.customer_id = bids.customer_id)') // Get the latest bid
        ->groupBy('products.id', 'products.product_identification_number', 'products.product_name','products.image')
        ->orderByDesc('bid_count')
        ->limit($limit);

    return $query->get();



    }

    public function winningBids($limit)
    {
        // Subquery to get the latest closed bidding cycle id
        $subqueryResult = DB::table('bidding_cycles')
            ->select('id')
            ->where('is_open', 0)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->value('id');

        if(!$subqueryResult){
            return [];
        }
        // Main query
        $query = self::query()
            ->select('products.*', DB::raw('b.top_bid_amount'))
            ->leftJoin(
                DB::raw(
                    '(SELECT product_id, MAX(amount) AS top_bid_amount
                              FROM bids
                              WHERE bidding_cycle_id = ' . $subqueryResult . '
                              GROUP BY product_id) AS b'
                ),
                'products.id',
                '=',
                'b.product_id'
            )
            ->orderByDesc('b.top_bid_amount')
            ->limit($limit);

        return $query->get();
    }


}
