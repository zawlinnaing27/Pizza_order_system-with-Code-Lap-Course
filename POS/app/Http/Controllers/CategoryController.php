<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct admin category list Page
    public function list(){
        //search category name//
        $categories = Category::when(request('key'),function($query){
                      $query->where('name','like','%' . request('key') . '%');
        })
                      ->OrderBy('id','desc')
                      ->paginate(5);
        $categories->appends(request()->all());
        return view('admin.category.list',compact('categories'));
    }

    //direct category create page
        public function createPage(){
            return view('admin.category.create');
        }


        //Create Category List
        public function create(Request $request){
            //validation check
            $this->categoryValidationCheck($request);
            //change array type
            $data = $this->requestCategoryData($request);
            Category::create($data);
            return redirect()->route('category#list')->with(['categorySuccess'=> 'Category Created....']);

        }

        //Delete Category
        public function delete($id){
           Category::where('id',$id)->delete();
           return back()->with(['categoryDelete'=>'Category Deleted....']);
        }

        // edit Category
        Public function edit($id){
            $category = Category::where('id',$id)->first();
            return view('admin.category.edit',compact('category'));
        }

        //update Category
        Public function update(Request $request){
            $this->categoryValidationCheck($request);
            $data=$this->requestCategoryData($request);
            Category::where('id',$request->categoryId)->update($data);
            return redirect()->route('category#list');

        }








// category validation check
private function categoryValidationCheck($request){
    Validator::make($request->all(),[
        'categoryName' => 'required|unique:categories,name,'.$request->categoryId
    ])->validate();
}

//request Category data
private function requestCategoryData($request){
    return[
        'name' => $request->categoryName

    ];

}

}
