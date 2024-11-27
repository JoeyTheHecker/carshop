<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
class Inquiry extends Model
{
    use HasFactory;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public function getProducts()
    {
        return $this->belongsTo('App\Models\Products', 'product_id','id');
    }

    public function ctrInquiryToday()
    {
        $result = self::where('status', (int)self::STATUS_ACTIVE)
        ->whereDate('created_at', '>=', ''.date("Y-m-d").'')
        ->whereDate('created_at', '<=', ''.date("Y-m-d").'')
        ->count();

        if($result){
            return $result;
        }

        return 0;
    }

    public function countBy($status=false, $year=false, $month=false)
    {
        if($year && $month){
            $dateFilter = $year.'_'.$month;
        }else{
            $dateFilter = 'data';
        }

        $cacheKey = $dateFilter;

        return Cache::remember($cacheKey, 5, function() use($status, $year, $month) {

            $result = self::where('status', (int)$status);

            if($year && $month){
                $result->whereYear('created_at', '=', (int)$year)
                ->whereMonth('created_at', '=', (int)$month);
            }

            $data = $result->count();

            return $data;
        });
    }
}
