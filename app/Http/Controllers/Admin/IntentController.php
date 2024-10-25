<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerIntent;

class IntentController extends Controller
{
    public function loiSummary()
    {
        return view('loi.index');
    }

    public function loiAjaxSummary()
    {
        $customerIntent = new CustomerIntent();

        $query = $customerIntent->query();

        // if(isset($_GET['is_display_on'])  && strlen($_GET['is_display_on']) != ""){
        //     if($_GET['is_display_on'] == 1){
        //         $query->whereIn('is_display_on', [1]);
        //     }elseif($_GET['is_display_on'] == 2){
        //         $query->whereIn('is_display_on', [2]);
        //     }else{
        //         $query->whereIn('is_display_on', [0, 1, 2]);
        //     }
        // }

        // if(isset($_GET['start_date']) && strlen($_GET['start_date']) > 0 && isset($_GET['end_date']) && strlen($_GET['end_date']) > 0){
        //     $query->whereDate('created_at', '>=', ''.$_GET['start_date'].'');
        //     $query->whereDate('created_at', '<=', ''.$_GET['end_date'].'');
        // }

        // if(isset($_GET['search_name'])  && strlen($_GET['search_name']) != ""){
        //     $query->where('email', 'LIKE', '%'.(string)$_GET['search_name'].'%');
        // }

        // $query->where('type_id', '=', 1);

        $data = $query
        ->orderBy('updated_at', 'DESC')
        ->paginate(15);

        return view('loi.ajax.index')
        ->with('data', $data);
    }
}
