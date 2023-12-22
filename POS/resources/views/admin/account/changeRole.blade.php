@extends('admin.layout.master');

@section('title','Change Profile')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="ms-3 ">
                                <i class="fa-solid fa-arrow-left " onclick="history.back()"></i>
                            </div>
                            <h3 class="text-center title-2">Change Role</h3>
                        </div>
                        <hr>
                        <form action="{{route('admin#change',$account->id)}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                                <div class="row">
                                    <div class="col-9 offset-2">
                                     <div class="text-center">
                                        @if ($account->image == null)
                                    <img src="{{asset('image/default-user.jpg')}}"  />


                                @else
                                    <img src="{{asset('storage/' . $account->image)}}" alt="John Doe" />


                                @endif
                                     </div>
                                     <div class="form-group">
                                        <label  class="control-label mb-1">Role</label>
                                        <select class="form-control" name="role"  id="">
                                            <option value="">Choose Role</option>
                                            <option value="admin" @if($account->role == 'admin') selected  @endif >Admin</option>
                                            <option value="user" @if($account->role == 'user') selected  @endif >User</option>

                                        </select>
                                        @error('role')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror

                                    </div>

                                        <div class="form-group ">
                                            <label  class="control-label mb-1">Name</label>
                                            <input  name="name"  disabled type="text" value="{{old('name',$account->name)}}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Email</label>
                                            <input  name="email" disabled type="email" value="{{old('email',$account->email)}}" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Phone</label>
                                            <input  name="phone" disabled type="text" value="{{old('phone',$account->phone)}}" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                            @error('phone')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label  class="control-label mb-1">Gender</label>
                                            <select class="form-control" name="gender" disabled id="">
                                                <option value="">Choose Gender</option>
                                                <option value="female" @if($account->gender == 'female') selected  @endif >Female</option>
                                                <option value="male" @if($account->gender == 'male') selected  @endif >Male</option>

                                            </select>
                                            @error('gender')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Address</label>
                                            <input  name="address" type="text" disabled value="{{old('address',$account->address)}}" class="form-control @error('address') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                            @error('address')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror

                                        </div>

                                        </div>

                                </div>
                                    <div class="row">
                                         <div class="col-2 offset-5 me-3">
                                            <button  type="submit" class="btn btn-sm btn-success">
                                                <i class="fa-solid fa-upload"></i>
                                                <span>Change Role</span>

                                            </button>
                                         </div>
                                    </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
