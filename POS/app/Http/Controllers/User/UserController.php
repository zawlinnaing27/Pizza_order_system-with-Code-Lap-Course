<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //direct home Page
    public function home(){
        $product = Product::orderBy('created_at','desc')->get();
        $categories = Category::get();
        return view('user.main.home',compact('product','categories'));
    }

    //filter Pizza
    public function filter($categoryId){
        $product = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $categories = Category::get();
        return view('user.main.home',compact('product','categories'));

    }



    //direct user detail page
    public function detail(){
        return view('user.main.detail');
    }

    //direst user edit page
    public function edit(){
        return view('user.main.edit');
    }

    //update User Page
    Public function update($id,Request $request){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);
        //For Image
        if($request->hasfile('image')){
            $dbImage = User::where('id' , $id)->first();
            $dbImage = $dbImage->image;
            if($dbImage !== null){
                Storage::delete('public/' . $dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/' , $fileName);
            $data['image'] = $fileName;

            User::where('id', $id)->update($data);
            return redirect()->route('user#detail')->with(['updateSuccess'=>'User Account Updated']);
        }
    }


    //Direct password Change Page
    public function changePasswordPage(){
        return view('user.main.changePassword');
    }

    //Update password Page
    public function updatePassword(Request $request){
        $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbpassword = $user->password;
        if(Hash::check($request->oldpassword, $dbpassword)){
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->newpassword)
            ]);

        return redirect()->route('user#home')->with(['complete'=>'Password Change Success...']);
        }
        return back()->with(['notmatch'=> 'The Old Password not match.Try Again!']);



    }






   //Account Validation Check
   Private function accountValidationCheck($request){
    validator::make($request->all(),[
        'name' => 'required',
        'email' => 'required',
        'gender' => 'required',
        'phone'=>'required',
        'address' => 'required',
        'image'=>'mimes:jpg,bmp,png|file|required',
    ])->validate();

  }

   //Get User Data
   private function getUserData($request){
    return([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'gender'=> $request->gender,
        'address'=>$request->address,
    ]);

   }


   //Password Validation Check
   private function passwordValidationCheck($request){
    validator::make($request->all(),[
        'oldpassword' => 'required',
        'newpassword' =>'required|min:6|same:confirmpassword',
        'confirmpassword'=> 'required|min:6|same:newpassword',
            ])->validate();


   }


}
