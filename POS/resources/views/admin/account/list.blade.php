@extends('admin.layout.master')

@section('title', 'Admin List Page')
@section('content')
    <div class="Page-container">
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <!-- DATA TABLE -->
                        <div class="table-data__tool">
                            <div class="table-data__tool-left">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Admin List</h2>

                                </div>
                            </div>
                            <div class="table-data__tool-right">
                                <a href="{{ route('category#createPage') }}">
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                        <i class="zmdi zmdi-plus"></i>add Admin
                                    </button>
                                </a>
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    CSV download
                                </button>
                            </div>
                        </div>

                        @if (session('DeleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-xmark"></i> {{ session('DeleteSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif


                        <div class="row">
                            <div class="col-3">
                                <h4 class="text-secondary"> Search Name : <span class="text-danger">
                                        {{ Request('key') }}</span></h4>
                            </div>
                            <div class="col-4 offset-5">
                                <nav class="navbar bg-body-tertiary">
                                    <div class="container-fluid">
                                        <form class="d-flex" method="get" action="{{ route('admin#list') }}">
                                            @csrf
                                            <input class="form-control me-2" type="text" name="key"
                                                placeholder="Search" aria-label="Search" value="{{ request('key') }}">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="fa-solid fa-magnifying-glass"></i></button>
                                        </form>
                                    </div>
                                </nav>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end my-3">
                            <div class=" p-1 bg-white shadow-sm text-center rounded ">
                                <h4 class="">Total - {{$adminlists->total()}}</h4>
                            </div>
                        </div>

                            <div class="table-responsive table-responsive-data2 text-center">
                                <table class="table table-data2 ">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Phone</th>
                                            <th>Address</th>

                                            <th></th>
                                        </tr>
                                    </thead>
                                    @foreach ($adminlists as $list)
                                        <tbody>
                                            <tr class="tr-shadow">

                                                <td class="img-thumbnail shadow-sm col-2">
                                                    @if ($list->image == null)
                                                    <img src="{{asset('image/default-user.jpg')}}"  />


                                                @else
                                                    <img src="{{asset('storage/' . $list->image)}}" />


                                                @endif


                                                </td>
                                                <td>{{ $list->name }}</td>
                                                <td>{{ $list->role }}</td>
                                                <td>{{$list->email}}</td>
                                                <td>{{$list->gender}}</td>
                                                <td>{{$list->phone}}</td>
                                                <td>{{$list->address}}</td>


                                                <td>
                                                    <div class="table-data-feature">
                                                        @if(Auth::user()->id == $list->id)

                                                        @else
                                                        <a href="{{route('admin#changeRole',$list->id)}}">
                                                            <button class="item me-3" data-toggle="tooltip"
                                                                data-placement="top" title="Change Role">
                                                                <i class="fa-solid fa-user-slash"></i>
                                                        </a>
                                                        <a href="{{route('admin#delete',$list->id)}}">
                                                            <button class="item" data-toggle="tooltip"
                                                                data-placement="top" title="Delete">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </a>


                                                        @endif
                                                    </div>

                                                </td>
                                            </tr>
                                        </tbody>

                                    @endforeach
                                </table>

                            </div>

                        <div class="mt-3">
                            {{$adminlists->links()}}


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

