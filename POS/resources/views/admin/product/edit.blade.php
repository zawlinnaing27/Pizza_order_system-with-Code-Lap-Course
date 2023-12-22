@extends('admin.layout.master')

@section('title','Update Pizza List')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{route('product#list', $product->id)}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="ms-3 ">
                            <i class="fa-solid fa-arrow-left " onclick="history.back()"></i>
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2">Update Your Pizza </h3>

                        </div>
                        <hr>
                        <form action="{{route('product#update',$product->id)}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-6 b-dark">
                                   <div>
                                    <img src="{{ asset('storage/' .$product->image)}}"  />
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Choose Your Image</label>
                                        <input  name="image" type="file"  class="form-control @error('image') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                        @error('image')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror

                                    </div>
                                   </div>


                                </div>
                                <div class="col-6">

                                        <div class="form-group">
                                            <label  class="control-label mb-1">Pizza Name</label>
                                            <input  name="pizzaName" type="text" value="{{$product->name,old('pizzaName')}}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name...">
                                            @error('pizzaName')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Pizza Price</label>
                                            <input  name="price" type="text" value="{{$product->price,old('price')}}" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name...">
                                            @error('price')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Description</label>
                                            <textarea name="description" type="text"  style="height: 200px" class="form-control  @error('description') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter description...">{{$product->description,old('description')}}</textarea>
                                            @error('description')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Waiting Time</label>
                                            <input  name="time" type="text" value="{{$product->waiting_time,old('time')}}" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name...">
                                            @error('time')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label  class="control-label mb-1">Category</label>
                                            <select class="form-control" name="category" id="">
                                                <option value="">Choose Pizza Category.....</option>
                                               @foreach ($categories as $category)
                                               <option value="{{$category->id}}" @if ($category->id == $product->category_id) selected @endif>{{$category->name}}</option>
                                               @endforeach

                                            </select>
                                            @error('category')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror

                                        </div>



                                </div>
                            </div>
                            <div class="row">
                                <div class="mt-3 col-4 offset-2 ">
                                    <button  type="submit" class="btn btn-lg btn-info btn-block">
                                        <span>Update</span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                        <i class="fa-solid fa-circle-right"></i>
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

