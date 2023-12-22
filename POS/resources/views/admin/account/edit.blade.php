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
                            <h3 class="text-center title-2">Change Your Profile</h3>
                        </div>
                        <hr>
                        <form action="{{route('admin#Update',Auth::user()->id)}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                                <div class="row">
                                    <div class="col-9 offset-2">
                                     <div class="text-center">
                                        @if (Auth::user()->image == null)
                                    <img src="{{asset('image/default-user.jpg')}}"  />


                                @else
                                    <img src="{{asset('storage/' . Auth::user()->image)}}" alt="John Doe" />


                                @endif
                                     </div>

                                        <div class="form-group">
                                            <label  class="control-label mb-1">Name</label>
                                            <input  name="name" type="text" value="{{old('name',Auth::user()->name)}}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Email</label>
                                            <input  name="email" type="email" value="{{old('email',Auth::user()->email)}}" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Choose Your Image</label>
                                            <input  name="image" type="file"  class="form-control @error('image') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                            @error('image')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Phone</label>
                                            <input  name="phone" type="text" value="{{old('phone',Auth::user()->phone)}}" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                            @error('phone')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Gender</label>
                                            <select class="form-control" name="gender" id="">
                                                <option value="">Choose Gender</option>
                                                <option value="female" @if(Auth::user()->gender == 'female') selected  @endif >Female</option>
                                                <option value="male" @if(Auth::user()->gender == 'male') selected  @endif >Male</option>

                                            </select>
                                            @error('gender')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Address</label>
                                            <input  name="address" type="text" value="{{old('address',Auth::user()->address)}}" class="form-control @error('address') is-invalid @enderror" aria-required="true" aria-invalid="false" >
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
                                                <span>Update profile</span>

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
