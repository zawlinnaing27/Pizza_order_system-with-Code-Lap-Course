@extends('admin.layout.master')

@section('title', 'Category List Page')
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
                                    <h2 class="title-1">Category List</h2>

                                </div>
                            </div>
                            <div class="table-data__tool-right">
                                <a href="{{ route('category#createPage') }}">
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                        <i class="zmdi zmdi-plus"></i>add Category
                                    </button>
                                </a>
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    CSV download
                                </button>
                            </div>
                        </div>

                        @if (session('categorySuccess'))
                            <div class="col-4 offset-8">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-check"></i> {{ session('categorySuccess') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                        @if (session('complete'))
                            <div class="col-4 offset-8">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-check"></i> Password Change Success...
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-3">
                                <h4 class="text-secondary"> Search Key : <span class="text-danger">
                                        {{ Request('key') }}</span></h4>
                            </div>
                            <div class="col-4 offset-5">
                                <nav class="navbar bg-body-tertiary">
                                    <div class="container-fluid">
                                        <form class="d-flex" method="get" action="{{ route('category#list') }}">
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
                                <h4 class="">Total - ( {{ $categories->total()}} )</h4>
                            </div>
                        </div>

                        @if (session('categoryDelete'))
                            <div class="col-4 offset-8">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-xmark"></i> {{ session('categoryDelete') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        @endif


                        @if (count($categories) != 0)
                            <div class="table-responsive table-responsive-data2 text-center">
                                <table class="table table-data2 ">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Category Name</th>
                                            <th>Created Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    @foreach ($categories as $category)
                                        <tbody>
                                            <tr class="tr-shadow">
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->created_at->format('j-F-Y') }}</td>

                                                <td>
                                                    <div class="table-data-feature">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="View">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button>
                                                        <a href="{{ route('category#edit', $category->id) }}">
                                                            <button class="item" data-toggle="tooltip"
                                                                data-placement="top" title="Edit">
                                                                <i class="zmdi zmdi-edit"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ route('category#delete', $category->id) }}">
                                                            <button class="item" data-toggle="tooltip"
                                                                data-placement="top" title="Delete">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </a>

                                                    </div>

                                                </td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        @else
                            <h3 class="text-secondary text-center mt-5">There is no Category</h3>
                        @endif
                        <!-- END DATA TABLE -->
                        <div class="mt-3">
                            {{ $categories->links() }}
                            {{-- {{ $categories->appends(request()->query())->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
