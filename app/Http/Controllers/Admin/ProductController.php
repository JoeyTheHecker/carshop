<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\BrandCar;
use App\Models\Categories;
use App\Models\Groups;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function indexSummary()
    {
        $data = array();

        $products = new Products();

        $data['active'] = $products->ctrProducts((int)$products::STATUS_ACTIVE);
        $data['sold'] = $products->ctrProducts((int)$products::STATUS_SOLD);
        $data['inactive'] = $products->ctrProducts((int)$products::STATUS_INACTIVE);
        $data['deleted'] = $products->ctrProducts((int)$products::STATUS_DELETED);
        $data['bidding'] = $products->ctrProducts((int)$products::STATUS_BIDDING);

        $groups = new Groups();
        $groupsQuery = $groups->get();

        $categories = new Categories();
        $categoriesQuery = $categories
        ->where('status', '=', (int)$categories::STATUS_ACTIVE)
        ->get();

        return view('products.index')
        ->with('data', $data)
        ->with('groups', $groupsQuery)
        ->with('categories', $categoriesQuery);
    }

    public function productAjaxSummary(Request $request)
    {
        // Initialize the query from the Products model
        $query = Products::query();

        // Check if 'is_display_on' is present in the request and apply the filters
        if ($request->filled('is_display_on')) {
            switch ($request->input('is_display_on')) {
                case 1:
                    $query->whereIn('is_display_on', [1]);
                    break;
                case 2:
                    $query->whereIn('is_display_on', [2]);
                    break;
                default:
                    $query->whereIn('is_display_on', [0, 1, 2]);
                    break;
            }
        }

        // Filter by group_id if provided
        if ($request->filled('group_id')) {
            $query->where('group_id', $request->input('group_id'));
        }

        // Filter by category_id if provided
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        // Filter by region_name with a LIKE query
        if ($request->filled('region_name')) {
            $query->where('region_name', 'LIKE', '%' . $request->input('region_name') . '%');
        }

        // Filter by location_name with a LIKE query
        if ($request->filled('location_name')) {
            $query->where('location_name', 'LIKE', '%' . $request->input('location_name') . '%');
        }

        // Filter by product_name with a LIKE query
        if ($request->filled('product_name')) {
            $query->where('product_name', 'LIKE', '%' . $request->input('product_name') . '%');
        }

        // Filter by brand_name with a LIKE query
        if ($request->filled('brand_name')) {
            $query->where('brand_name', 'LIKE', '%' . $request->input('brand_name') . '%');
        }

        // Filter by puo_number with a LIKE query
        if ($request->filled('puo_number')) {
            $query->where('puo_number', 'LIKE', '%' . $request->input('puo_number') . '%');
        }

        // Filter by min_bid_price
        if ($request->filled('min_bid_price')) {
            $query->where('min_bid_price', (float) $request->input('min_bid_price'));
        }

        // Handle 'type' filtering with specific logic
        if ($request->filled('type')) {
            if ($request->input('type') == 0) {
                $query->whereIn('status', [0, 4]);
            } else {
                $query->where('status', $request->input('type'));
            }
        }

        // Retrieve paginated data with sorting
        $data = $query->orderBy('updated_at', 'DESC')->paginate(20);

        // Return the view with the necessary data
        return view('products.ajax.index', [
            'type' => (int) $request->input('type'),
            'data' => $data,
        ]);
    }


    public function create()
    {
        $data = array();

        $groups = new Groups();
        $groupsQuery = $groups->get();

        $categories = new Categories();
        $categoriesQuery = $categories
        ->where('status', '=', (int)$categories::STATUS_ACTIVE)
        ->get();

        $brandCar = new BrandCar();
        $brandForCar = $brandCar->getAll();

        $products = new Products();

        return view('products.create')
        ->with('groups', $groupsQuery)
        ->with('brand_for_car', $brandForCar)
        ->with('categories', $categoriesQuery)
        ->with('product', $products);
    }

    public function store(Request $request)
    {

        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";

        if((int)$request->product_status != 1){

        if($request->featured_image){
            $a0 = [
                'featured_image' => 'required|mimes:jpg,jpeg,gif,png',
            ];
        }else{
            $a0 = [];
        }

        $a1 = array(
            'product_name' => 'required|string|max:250',
            'product_identification_number' => 'required|integer',
            'unit_name' => 'required|string|max:250',
            'brand_name' => 'required|string|max:250',
            'latest_condition' => 'required|string|max:250',
            'document_status' => 'required|string|max:250',
            'inventory_price' => array('required','regex:'.$regex),
            'selling_price' => array('required','regex:'.$regex),
            'market_value' => array('required','regex:'.$regex),
            'product_status' => 'required|integer',
            'min_bid_price' => 'required|numeric|between:0,1',
        );

        $data_validate = array_merge($a0, $a1);

        $validator = Validator::make($request->all(), $data_validate);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
            exit();
        }

        }

        $products = new Products();

        $imageName = '';

        if($request->featured_image){
            $file = $request->featured_image;
            $imageName = $products->generateUniqueID() . '.' . $file->getClientOriginalExtension();

             // Save the file to the 'public/car_images' folder
            Storage::disk('public')->put('car_images/' . $imageName, file_get_contents($file));
        }

        $products->product_code = 0;
        $products->product_identification_number = $request->product_identification_number;
        $products->brand_id = (int)$request->brand_id;
        $products->product_name = (string)$request->product_name;
        $products->unit_name = (string)$request->unit_name;
        $products->brand_name = (string)$request->brand_name;
        $products->year_model = (int)$request->year_model;
        $products->descriptions = (string)$request->descriptions;
        $products->plate_number = (string)$request->plate_number;
        $products->mileage = (string)$request->mileage;
        $products->transmission = (string)$request->transmission;
        $products->fuel_type = (string)$request->fuel_type;
        $products->inventory_price = (float)$request->inventory_price;
        $products->selling_price = (float)$request->selling_price;
        $products->market_value = (float)$request->market_value;
        $products->is_sold = (string)$request->is_sold;
        $products->latest_condition = (string)$request->latest_condition;
        $products->classification = (string)$request->classification;
        $products->document_status = (string)$request->document_status;
        $products->status = (int)$request->product_status;
        $products->min_bid_price = $request->min_bid_price;
        $products->featured_video = $products->getYoutubeVideoId((string)$request->featured_video);
        $products->image = (string)$imageName;
        $products->save();

        $response = [
            'success' => true,
            'message' => "Product has been saved.",
        ];

        return response()->json($response, 200);
    }
}
