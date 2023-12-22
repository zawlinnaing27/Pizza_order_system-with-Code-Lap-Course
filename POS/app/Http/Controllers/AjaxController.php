<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //return pizza list
    public function pizzaList(Request $request){
        logger($request->status);
        if($request->status == 'desc' ){
            $data = Product::OrderBy('created_at', 'desc')->get();
        }else {
            $data = Product::OrderBy('created_at', 'asc')->get();
        }

        return $data;
    }

}
