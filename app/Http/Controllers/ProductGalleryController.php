<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductGallery;
use App\Models\Products;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class ProductGalleryController extends Controller
{
    public function galleryPost($id)
    {
        $data = array();

        $products = new Products();

        $data = $products->where('id', '=', (int)$id)->first();

        /* gallery */
        $gallery = new ProductGallery();

        $product_gallery = $gallery->where('product_id', '=', (int)$id)->get();

        return view('products.gallery')
        ->with('data', $data)
        ->with('product_gallery', $product_gallery);
    }

    public function galleryPostNew($id, Request $request)
    {
        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";

		$validator = Validator::make($request->all(), [
			'file' => 'required|mimes:jpg,jpeg,gif,png',
		]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
            exit();
        }

        $gallery = new ProductGallery();

        $file = $request->file;
        $imageName = $gallery->generateUniqueID() . '.' .
        $file->getClientOriginalExtension();

        $ext = $file->getClientOriginalExtension();

        // Save the file to the 'public/car_images' folder
        Storage::disk('public')->put('car_images/' . $imageName, file_get_contents($file));

        $gallery->product_id = (int)$id;
        $gallery->image_full = (string)$imageName;
        $gallery->image_thumb = (string)$imageName;
        $gallery->status = 1;
        $gallery->save();

        $response = [
            'success' => true,
            'message' => "Image has been saved.",
            'image' => $imageName,
        ];

        return response()->json($response, 200);
    }

    public function galleryRemoveImage($id)
    {
        $gallery = new ProductGallery();

        $product_gallery = $gallery->where('id', '=', (int)$id)->first();

        if($product_gallery){

            $explode_data = explode("/",$product_gallery->image_full);

            Storage::disk('s3')->delete((string)$explode_data[4]);
            $gallery->where('id', '=', (int)$id)->delete();
        }

        $response = [
            'success' => true,
            'message' => "Photo has been removed.",
        ];

        return response()->json($response, 200);
    }
}
