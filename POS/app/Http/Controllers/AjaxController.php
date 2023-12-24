<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //return pizza list
    public function pizzaList(Request $request){
        if($request->status == 'asc' ){
            $data = Product::OrderBy('created_at', 'asc')->get();
        }else {
            $data = Product::OrderBy('created_at', 'desc')->get();
        }

        return $data;
    }

}
