@extends('admin.layouts.master')

@section('page-title')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Product List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
                    <li class="breadcrumb-item active">Product List</li>
                </ol>
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection

@section('button')
<div class="row pb-4 gy-3">
    <div class="col-sm-4">
        <a href="{{route('product.create')}}" class="btn btn-primary addtax-modal"><i class="las la-plus me-1"></i> Add Product</a>
    </div>


</div>
@endsection

@section('content')



<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table table-nowrap align-middle mb-0">
                        <thead>
                            <tr class="text-muted text-uppercase">

                                <th scope="col" style="width: 500px;">Product Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Category</th>

                                <th scope="col" style="width: 6%;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($products as $product)
                            <tr>


                                <td>{{$product->name}}</td>
                                <td>{{$product->description}}</td>
                                <td>{{$product->category->name}}</td>

                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="las la-ellipsis-h align-middle fs-18"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">

                                            <li>
                                                <a class="dropdown-item" href="{{route('product.edit',$product)}}"><i class="las la-pen fs-18 align-middle me-2 text-muted"></i>
                                                    Edit</a>
                                            </li>

                                            <li class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item remove-item-btn" href="#">
                                                    <i class="las la-trash-alt fs-18 align-middle me-2 text-muted"></i>
                                                    Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>

                            </tr>
                            @endforeach


                        </tbody><!-- end tbody -->
                    </table><!-- end table -->
                </div><!-- end table responsive -->
            </div>
        </div>

        <div class="row align-items-center mb-2 gy-3">
            <div class="col-md-5">
                <p class="mb-0 text-muted">
                    Showing <b>{{ $products->firstItem() }}</b> to <b>{{ $products->lastItem() }}</b> of <b>{{ $products->total() }}</b> results
                </p>
            </div>

            <div class="col-sm-auto ms-auto">
                <nav aria-label="Pagination">
                    {{ $products->links() }} {{-- Bootstrap-styled pagination --}}
                </nav>
            </div>
        </div>

    </div>
</div>

@endsection