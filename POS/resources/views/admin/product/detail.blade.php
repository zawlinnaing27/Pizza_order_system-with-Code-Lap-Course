@extends('admin.layout.master');

@section('title','Product Detail Page')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{route('product#list', $product->id)}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-10 offset-1 shadow-sm">
                <div class="card">
                    <div class="card-body">
                        <div class="ms-3 ">
                            <i class="fa-solid fa-arrow-left " onclick="history.back()"></i>
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2 mb-4">Pizza Detail</h3>

                            <div class="row">
                                <div class="col-5 offset-1 mt-3">
                                    <img src="{{asset('storage/' . $product->image)}}" alt="John Doe" />



                                </div>
                                <div class="col-5  mt-3 ">
                                  <div>
                                    <div>
                                    <div class="my-2">Pizza Name : {{$product->name}}</div><br>
                                    <div class="my-2">Pizza Category : {{$product->category_name}}</div><br>
                                    <div class="my-2">Pizza Price : {{$product->price}}Kyats</div> <br>
                                    <div class="my-2">Waiting Time : {{$product->waiting_time}}mins</div> <br>
                                    <div class="my-2 ">Details : {{$product->description}}</div><br>
                                    <div class="my-2">Created Time : {{$product->created_at->format('j-F-Y')}}</div> <br>
                                    <div class="my-2">View Count : {{$product->view_count}}</div> <br>

                                  </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="mt-3 col-4 offset-2 ">
                                <div class="px-3">
                                    <a href="{{route('product#edit',$product->id)}}">
                                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-user-pen"></i>  Edit Your Pizza</button></a>
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
