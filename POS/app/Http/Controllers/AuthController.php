<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //direct login Page
    public function loginPage(){
        return view('login');
    }

    //direct register page
    public function regiserPage(){
        return view('register');
    }

    //admin direct dashboard Page
public function dashboard(){
   if(Auth::user()->role == 'admin'){
    return redirect()-> route('category#list');
   }else{
    return redirect()-> route('user#home');

   }

   }

   


}


