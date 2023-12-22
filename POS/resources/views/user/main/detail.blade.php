@extends('user.layout.master');

@section('title','Account Detail Page')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1 shadow-sm">
                <div class="card">
                    <div class="card-body">

                        <div class="card-title">
                            <h3 class="text-center title-2 mb-4">Account Info</h3>

                            @if(session('updateSuccess'))
                                  <div class="col-4 offset-8">
                                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="fa-solid fa-check"></i>{{session('updateSuccess')}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                         </div>
                                    </div>
                            @endif

                            <div class="row">
                                <div class="col-5 offset-1">
                                    @if (Auth::user()->image == null)
                                    <img src="{{asset('image/default-user.jpg')}}"  class="img-thumbnail" />


                                        @else
                                                <img src="{{asset('storage/' . Auth::user()->image)}}" alt="John Doe"  class="img-thumbnail" />


                                        @endif
                                    <div class="mt-2 ms-3">
                                         <div class="px-3">
                                             <a href="{{route('user#edit')}}">
                                             <button type="submit" class="btn btn-success"><i class="fa-solid fa-user-pen"></i>  Edit Your Profile</button></a>
                                          </div>
                                   </div>
                                </div>
                                <div class="col-3 ms-5 mt-3">
                                  <div>
                                    <div>
                                    <h4><i class="fa-solid fa-user"></i>  {{Auth::user()->name}}</h4><br>
                                    <h4><i class="fa-solid fa-envelope-circle-check"></i>  {{Auth::user()->email}}</h4> <br>
                                    <h4><i class="fa-solid fa-phone"></i>  {{Auth::user()->phone}}</h4> <br>
                                    <h4><i class="fa-solid fa-venus-mars"></i> {{Auth::user()->gender}}</h4><br>
                                    <h4><i class="fa-solid fa-address-book"></i>  {{Auth::user()->address}}</h4> <br>

                                  </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
