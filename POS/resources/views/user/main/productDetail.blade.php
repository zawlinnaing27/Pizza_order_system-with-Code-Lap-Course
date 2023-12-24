@extends('user.layout.master')
@section('title', 'Pizza Family Detaile Page')
@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="ms-3 ">
                <i class="fa-solid fa-arrow-left " onclick="history.back()"> Back </i>
            </div>
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('storage/' . $product->image) }}" alt="Image">
                        </div>

                    </div>
                    {{-- <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a> --}}
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $product->name }}</h3>
                    <input type="hidden" value="{{ Auth::user()->id }}" id="userId">
                    <input type="hidden" value="{{ $product->id }}" id="pizzaId">
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            {{-- <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small> --}}
                        </div>
                        <small class="pt-1"> {{ $product->view_count }} <i class="fa-solid fa-eye"></i> </small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ $product->price }} Kyat</h3>
                    <p class="mb-4">{{ $product->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" id="orderCount" class="form-control bg-secondary border-0 text-center"
                                value="1">

                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                       <a href=""> <button type="button" class="btn btn-primary px-3" id="addCartBtn"><i
                        class="fa fa-shopping-cart mr-1"></i> Add To
                    Cart</button></a>
                    </div>
                    <div class="d-flex pt-2 mt-5">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also
                Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzaList as $p)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height: 210px" src="{{ asset('storage/' . $p->image) }}"
                                    alt="">
                                <div class="product-action">

                                    <a class="btn btn-outline-dark btn-square"
                                        href="{{ route('product#detail', $p->id) }}"><i class="fa-solid fa-info"></i></a>

                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $p->price }}</h5>
                                    <h6 class="text-muted ml-2"><del></del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small></small>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection
@section('jqueryAjaxSource')
    <script>
        $(document).ready(function() {

                    $('#addCartBtn').click(function() {

                        $source = {
                            'userId':  $('#userId').val(),
                            'pizzaId': $('#pizzaId').val(),
                            'count':  $('#orderCount').val()

                        };


                        $.ajax({
                            type : 'get' ,
                            url : 'http://127.0.0.1:8000/user/ajax/add/cart' ,
                            data : $source ,
                            dataType : 'json' ,
                            success : function(response){
                              if(response.status == 'success'){
                                  window.location.href = "http://127.0.0.1:8000/user/home";
                              }
                            }
                        })

                    })




                })
    </script>
@endsection
