<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //direct change password page
   Public function changePasswordPage(){
    return view('admin.account.change');
   }

      //admin change password
      public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $CurrentUserId=Auth::user()->id;
        $user = User::select('password')->where('id',$CurrentUserId)->first();
        $dbPassword = $user->password;
        if(Hash::check($request->oldpassword,$dbPassword)){
             User::where('id',Auth::user()->id)->update([
            'password' => Hash::make($request->newpassword)
          ]);
        //   Auth::logout();
          return redirect()->route('category#list')->with(['complete'=>'Password Change Success...']);

        }
        return back()->with(['notmatch'=> 'The Old Password not match.Try Again!']);
      }

      //direct Account detail Page
      Public function accountPage(){
        return view('admin.account.detail');
      }

      //direct Account Edit Page
      Public function editaccountPage(){
        return view('admin.account.edit');
      }

      //Update Account Profile
      Public function update($id,Request $request){
        $this->accountValidationCheck($request);
       $data = $this->getUserData($request);

       //for image
       if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;
                if($dbImage !== null){
                    Storage::delete('public/'. $dbImage);
                }

                $fileName = uniqid() . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public', $fileName);
                $data['image'] = $fileName;
       }
       User::where('id',$id)->update($data);
            return redirect()->route('admin#accountPage')->with(['updateSuccess'=>'Admin Account Updated']);

      }


      //Admin List
      public function list(){
        $adminlists = User::when(request('key'),function($query){
            $query->orwhere('name','like','%'.request('key').'%')
                    ->orwhere('email','like','%'.request('key').'%')
                    ->orwhere('address','like','%'.request('key').'%')
                    ->orwhere('phone','like','%'.request('key').'%')
                    ->orwhere('gender','like','%'.request('key').'%');
        })
                        ->where('role','admin')
                        ->paginate(2);
        $adminlists->appends(request()->all());

        return view('admin.account.list',compact('adminlists'));
      }

      //delete admin account
      public function delete($id){
            user::where('id',$id)->delete();
        return back()->with(['DeleteSuccess'=>'Admin Account Deleted']);
      }


      //Change Role
      public function changeRole($id){
        $account = User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
      }

      //Change Role
      public function change($id,Request $request){
            $data = $this->requestUserData($request);
            User::where('id',$id)->update($data);
            return redirect()->route('admin#list');
      }








      //requestUserdata
      private function requestUserData($request){
        return([
            'role' => $request->role
        ]);
      }







      //Request user data
      private function getUserData($request){
        return([
            'name' => $request->name,
            'email'=>$request->email,
            'gender'=>$request->gender,
            'phone'=>$request->phone,
            'address'=>$request->address
        ]);

      }

      //Account Validation Check
      Private function accountValidationCheck($request){
        validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'phone'=>'required',
            'address' => 'required',
            'image'=>'mimes:jpg,bmp,png|file',

        ])->validate();

      }

      //Password Validation Check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldpassword' =>'required|min:6',
            'newpassword' =>'required|min:6|same:confirmpassword',
            'confirmpassword'=>'required|min:6|same:newpassword',

        ])->validated();
    }
}
