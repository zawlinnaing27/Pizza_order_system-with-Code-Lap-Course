@extends('user.layout.master')
@section('title', 'Pizza Family Home Page')
@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">

                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        Category</span></h5>
                <div class="bg-light p-4 mb-30 shadow-sm">
                    <form>

                        <div class=" d-flex align-items-center justify-content-between mb-3 bg-dark text-white px-3 py-1">
                            <label class="mt-2" for="price-all">Categories</label>
                            <span class="badge border font-weight-normal">{{ count($categories) }}</span>
                        </div>
                        <hr>
                        <div class=" d-flex align-items-center justify-content-between mb-3 pt-2">
                            <a href="{{ route('user#home',) }}" class="text-dark"> <label class="" for="price-1">All</label></a>
                         </div>
                        @foreach ($categories as $category)
                            <div class=" d-flex align-items-center justify-content-between mb-3 pt-2">
                               <a href="{{ route('user#filter',$category->id) }}" class="text-dark"> <label class="" for="price-1">{{ $category->name }}</label></a>
                            </div>
                            <hr>
                        @endforeach



                    </form>
                </div>
                <!-- Price End -->
                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{route('user#cart',)}}" class="btn px-0 ml-3">
                                <button type="button" class="btn btn-primary position-relative">
                                    <i class="fas fa-shopping-cart "></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{count($cart)}}
                                    </span>
                                  </button>
                                </a>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" id="sortingOption" class="form-control">
                                        <option value="">Choose Option....</option>
                                        <option value="asc" id="">Ascending</option>
                                        <option value="desc" id="">Descending</option>
                                    </select>
                                </div>
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (session('updateSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-xmark"></i> {{ session('updateSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session('complete'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-xmark"></i> {{ session('complete') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <span class="row" id="dataList">
                      @if(count($product) !=0 )
                      @foreach ($product as $p)
                      <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                          <div class="product-item bg-light mb-4" id="myForm">
                              <div class="product-img position-relative overflow-hidden">
                                  <img class="img-fluid w-100" style="height: 210px"
                                      src="{{ asset('storage/' . $p->image) }}" alt="">
                                  <div class="product-action">

                                      <a class="btn btn-outline-dark btn-square" href="{{route('product#detail',$p->id)}}"><i
                                              class="fa-solid fa-info"></i></a>

                                  </div>
                              </div>
                              <div class="text-center py-4">
                                  <a class="h6 text-decoration-none text-truncate"
                                      href="">{{ $p->name }}</a>
                                  <div class="d-flex align-items-center justify-content-center mt-2">
                                      <h5>{{ $p->price }}</h5>
                                  </div>
                                  <div class="d-flex align-items-center justify-content-center mb-1">
                                      <small class="fa fa-star text-primary mr-1"></small>
                                      <small class="fa fa-star text-primary mr-1"></small>
                                      <small class="fa fa-star text-primary mr-1"></small>
                                      <small class="fa fa-star text-primary mr-1"></small>
                                      <small class="fa fa-star text-primary mr-1"></small>
                                  </div>
                              </div>
                          </div>
                      </div>
                  @endforeach
                  @else
                    <p class="text-center bg-primary fs-1 col-6 offset-3 text-dark py-5 "> There is no Pizza</p>
                    @endif

                    </span>
                </div>
                <!-- Shop Product End -->
            </div>
        </div>
    @endsection
    @section('jqueryAjaxSource')
        <script>
            $(document).ready(function() {

                $('#sortingOption').change(function() {
                    $eventOption = $('#sortingOption').val();
                    if ($eventOption == 'asc') {
                        $.ajax({
                            type: 'get',
                            url: 'http://127.0.0.1:8000/user/ajax/pizza/list',
                            data: {
                                'status': 'asc'
                            },
                            dataType: 'json',
                            success: function(response) {
                                $list = '';
                                for ($i=0;$i<response.length;$i++) {
                                    $list += `
                   <div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                    <div class="product-item bg-light mb-4" id="myForm">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" style="height: 210px" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                             <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-info"></i></a>

                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>${response[$i].price}</h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                            </div>
                        </div>
                    </div>
                </div>
                   `;
                                }
                                $(`#dataList`).html($list);
                            }
                        })

                    } else if ($eventOption == 'desc') {
                        $.ajax({
                            type: 'get',
                            url: 'http://127.0.0.1:8000/user/ajax/pizza/list',
                            data: {
                                'status': 'desc'
                            },
                            dataType : 'json',
                            success : function(response) {
                                $list = '';
                                for ($i=0;$i<response.length;$i++) {
                                    $list += `
                   <div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                    <div class="product-item bg-light mb-4" id="myForm">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" style="height: 210px" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                             <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-info"></i></a>

                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>${response[$i].price}}</h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                            </div>
                        </div>
                    </div>
                </div>
                   `;
                                }
                                $(`#dataList`).html($list);
                            }
                        })

                    }
                });


            });
        </script>
    @endsection
