<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
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

    //return pizza list
    public function addCart(Request $request){
        $data = $this->getOrderData($request);
        logger($data);
        Cart::create($data);

        $response = [
            'message' => 'Add to Cart Complete',
            'status' => 'success'
        ];

        return response()->json($response,200);

    }

    //get order data
    private function getOrderData($request){

        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()

        ];
    }



}
