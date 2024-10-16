<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductController extends Controller
{
    public function search(){
        $data = array();

        $products = new Products();

        $query = $products->query();
        
        $data = $query->paginate(20);
        
        return view('ajax.search')
            ->with('data', $data);
    }
}
