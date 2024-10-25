<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerIntent extends Model
{
    use HasFactory;
    public $timestamps = true;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public function getProduct($productId)
    {
    	$products = new Products();

        $query = $products->query();

        $query->where('id', '=', (int)$productId);

        $data = $query->first();

        if($data){
        	return $data->product_name;
        }

        return false;
    }

    public function getProductSellingPrice($productId)
    {
        $products = new Products();

        $query = $products->query();

        $query->where('id', '=', (int)$productId);

        $data = $query->first();

        if($data){
            return $data->selling_price;
        }

        return false;
    }

    public function getProductPuoDate($productId)
    {
        $products = new Products();

        $query = $products->query();

        $query->where('id', '=', (int)$productId);

        $data = $query->first();

        if($data){
            return date("d M Y", strtotime($data->puo_date));
        }

        return false;
    }

    public function getProductPuoNumber($productId)
    {
        $products = new Products();

        $query = $products->query();

        $query->where('id', '=', (int)$productId);

        $data = $query->first();

        if($data){
            return $data->puo_number;
        }

        return false;
    }
}
