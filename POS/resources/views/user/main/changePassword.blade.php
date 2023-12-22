@extends('user.layout.master')
@section('title','Password Change Page');
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Your Password</h3>
                        </div>
                        <hr>
                        <form action="{{route('user#updatePassword')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group ">
                                <label  class="control-label mb-1">Old Password</label>
                                <input  name="oldpassword" type="password"  class=" form-control @error('oldpassword') is-invalid @enderror @if(session('notmatch')) is-invalid  @endif " aria-required="true" aria-invalid="false" placeholder="Enter Old Password...">


                                @error('oldpassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror

                                @if(session('notmatch'))
                                <div class="invalid-feedback">
                                    {{session('notmatch')}}
                                </div>
                                @endif

                            </div>

                            <div class="form-group">
                                <label  class="control-label mb-1">New Password</label>
                                <input  name="newpassword" type="password"  class=" form-control @error('newpassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Password...">
                                @error('newpassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label  class="control-label mb-1">Confirm Password</label>
                                <input  name="confirmpassword" type="password"  class=" form-control @error('confirmpassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Confirm password...">
                                @error('confirmpassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div>
                                <button  type="submit" class="btn btn-lg btn-info btn-block">
                                    <i class="fa-solid fa-key"></i>
                                    <span>Change Password</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}

                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
