<?php

namespace App\Http\Controllers;

use App\Models\Products;
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

        return view('details',compact('data'));
    }
}
