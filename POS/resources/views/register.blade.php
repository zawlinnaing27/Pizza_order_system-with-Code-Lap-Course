@extends('layout.master')

@section('title','Register Page')

@section('content')
<div class="login-form">
    <form action="{{route('register')}}" method="post" enctype="multipart/form-data">
        @csrf

        @error('terms')
            <small class="text-danger">{{$message}}</small>
        @enderror

        <div class="form-group">

            <label>Username</label>
            <input class="au-input au-input--full" type="text" name="name" placeholder="Username">
        </div>
        @error('name')
        <small class="text-danger">{{$message}}</small>
        @enderror

        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
        </div>

        @error('email')
        <small class="text-danger">{{$message}}</small>
        @enderror

        <div class="form-group">
            <label>Phone</label>
            <input class="au-input au-input--full" type="text" name="phone" placeholder="09XXXXXXX">
        </div>

        <div class="form-group mt-2">
            <label>Gender</label>
            <select class="form-control" name="gender" id="">
                <option value="">Choose Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            @error('gender')
                <small class="text-danger">{{$message}}</small>
            @enderror


        </div>

        @error('phone')
        <small class="text-danger">{{$message}}</small>
        @enderror

        <div class="form-group">
            <label>Address</label>
            <input class="au-input au-input--full" type="text" name="address" placeholder="Address">
        </div>

        @error('address')
        <small class="text-danger">{{$message}}</small>
        @enderror

        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
        </div>

        @error('password')
        <small class="text-danger">{{$message}}</small>
        @enderror
        <div class="form-group">
            <label>Confirm Password</label>
            <input class="au-input au-input--full" type="password" name="password_confirmation" placeholder="Confirm Password">
        </div>

        @error('password')
        <small class="text-danger">{{$message}}</small>
        @enderror


        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

    </form>
    <div class="register-link">
        <p>
            Already have account?
            <a href="{{route('admin#loginPage')}}">Sign In</a>
        </p>
    </div>
</div>
@endsection
