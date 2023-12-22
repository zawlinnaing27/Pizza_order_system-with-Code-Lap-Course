<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\Facades\Validator;
use Illuminate\Broadcasting\PrivateChannel;

class ProductController extends Controller
{
    //direct Product List
    public function list()
    {


        $products = Product::select('products.*','categories.name as category_name')
             ->when(request('key'), function ($query) {
                $query->where('products.name', 'like', '%' . request('key') . '%');
        })
            ->leftjoin('categories','products.category_id','categories.id')
            ->OrderBY('products.created_at', 'desc')
            ->paginate(1);

            // dd($products->toarray());
        $products->appends(request()->all());
        return view('admin.product.pizzalist', compact('products'));
    }


    //direct product detail Page
    public function detail($id){
        $product = Product::select('products.*','categories.name as category_name')
                    ->leftjoin('categories','products.category_id','categories.id')
                    ->where('products.id',$id)->first();
        return view('admin.product.detail',compact('product'));
    }
    //direct Product Create page
    public function createPage()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.create', compact('categories'));
    }

    //Create product
    public function create(Request $request)
    {
        $this->productValidationCheck($request);
        $data = $this->getProductData($request);
        $fileName = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public', $fileName);
        $data['image'] = $fileName;


        Product::create($data);
        return redirect()->route('product#list',)->with(['success' => 'Product Create Success']);
    }

    //edit Product Page
    public function edit($id)

    {
        $product = Product::where('id', $id)->first();
        $categories = Category::get();
        return view('admin.product.edit', compact('product','categories'));
    }

    // Update Product Page
    public function update($id, Request $request)
    {


        $this->productValidationCheck($request);
        $data = $this->getProductData($request);



        if ($request->hasFile('image')) {

            $dbImage = Product::where('id', $id)->first();
            $dbImage = $dbImage->image;
            if ($dbImage !== null) {
                Storage::delete('public/' . $dbImage);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }




        Product::where('id', $id)->update($data);
        return redirect()->route('product#list')->with(['success' => 'Product Update Success']);
    }


    // delete Product
    public function delete(Product $product)
    {
        $product->delete();
        return back()->with(['success' => 'Product Delete Success']);
    }





    //   product validation Check
    private function productValidationCheck($request)
    {
        Validator::make($request->all(), [
            'pizzaName' => 'required|unique:products,name',
            'category' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,bmp,png|file',
            'time' => 'required',
            'price' => 'required',



        ])->validate();
    }


    //Request product data
    private function getProductData($request)
    {
        return ([
            'name' => $request->pizzaName,
            'category_id' => $request->category,
            'description' => $request->description,
            'waiting_time' => $request->time,
            'price' => $request->price,


        ]);
    }

    //Request


}
