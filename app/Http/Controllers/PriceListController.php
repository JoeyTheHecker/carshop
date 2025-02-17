<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PriceListController extends Controller
{
    /**
     * Generate and download the price list PDF.
     */
    public function download()
    {
        // Fetch products
        $products = Products::select('image','product_name', 'year_model', 'selling_price', 'mileage', 'transmission', 'fuel_type', 'seating_capacity', 'latest_condition')
            ->where('status', 0) // Fetch only active products
            ->get();

        // Generate PDF
        $pdf = Pdf::loadView('pricelist', compact('products'));

        // Download the PDF
        return $pdf->download('price_list.pdf');
    }
}
