<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ProductGallery;
use Illuminate\Http\Request;

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
        $data = Products::FindOrFail($id);

        /* gallery */
        $gallery = new ProductGallery();

        $product_gallery = $gallery->where('product_id', '=', (int)$id)->get();
        return view('details',compact('data'))->with('product_gallery', $product_gallery);;
    }
}
