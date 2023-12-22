@extends('admin.layout.master')

@section('title','Create Pizza List')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{route('product#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create Your Pizza</h3>
                        </div>
                        <hr>
                        <form action="{{route('product#create')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label  class="control-label mb-1">Pizza Name</label>
                                <input  name="pizzaName" type="text" value="{{old('pizzaName')}}" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name...">
                                @error('pizzaName')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label>Choose Your Category</label>
                                <select name="category" class="form-control  @error('category') is-invalid @enderror"  id="">
                                    <option value="">Choose your Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}" >{{$category->name}}</option>

                                    @endforeach
                                </select>
                                @error('category')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror


                            </div>
                            <div class="form-group">
                                <label  class="control-label mb-1">Description</label>
                                <textarea name="description" type="text" value="{{old('description')}}" style="height: 200px" class="form-control  @error('description') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter description..."></textarea>
                                @error('description')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label  class="control-label mb-1">Image</label>
                                <input  name="image" type="file" value="{{old('image')}}" class="form-control @error('image') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                @error('image')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label  class="control-label mb-1">Waiting Time</label>
                                <input  name="time" type="number" value="{{old('time')}}" class="form-control @error('time') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza waithing Time...">
                                @error('time')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label  class="control-label mb-1">Price</label>
                                <input  name="price" type="number" value="{{old('price')}}" class="form-control @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price...">
                                @error('price')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div>
                                <button  type="submit" class="btn btn-lg btn-info btn-block">
                                    <span>Create</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                    <i class="fa-solid fa-circle-right"></i>
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

