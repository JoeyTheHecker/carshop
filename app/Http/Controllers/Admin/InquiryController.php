<?php

namespace App\Http\Controllers\Admin;
use App\Models\Inquiry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function indexSummary()
    {
        return view('inquiry.index');
    }

    public function inquiryAjaxSummary()
    {
        $inquiry = new Inquiry();

        $query = $inquiry->query();

        // if(isset($_GET['is_display_on'])  && strlen($_GET['is_display_on']) != ""){
        //     if($_GET['is_display_on'] == 1){
        //         $query->whereIn('is_display_on', [1]);
        //     }elseif($_GET['is_display_on'] == 2){
        //         $query->whereIn('is_display_on', [2]);
        //     }else{
        //         $query->whereIn('is_display_on', [0, 1, 2]);
        //     }
        // }

        // if(isset($_GET['search_name'])  && strlen($_GET['search_name']) != ""){
        //     $query->where('name', 'LIKE', '%'.(string)$_GET['search_name'].'%');
        // }

        // if(isset($_GET['start_date']) && strlen($_GET['start_date']) > 0 && isset($_GET['end_date']) && strlen($_GET['end_date']) > 0){
        //     $query->whereDate('created_at', '>=', ''.$_GET['start_date'].'');
        //     $query->whereDate('created_at', '<=', ''.$_GET['end_date'].'');
        // }

        $data = $query
        ->orderBy('updated_at', 'DESC')
        ->paginate(15);

        return view('inquiry.ajax.index')
        ->with('data', $data);
    }

    public function viewDetails($id)
    {
        $data = array();

        $inquiry = new Inquiry();

        $query = $inquiry->query();

        $query->where('id', '=', (int)$id);

        $data = $query->first();

        return view('inquiry.view')->with('data', $data);
    }
}
