@extends('admin.layouts.master')

@section('page-title')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Add Product</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
                    <li class="breadcrumb-item active">Add Product</li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section('button')
<div class="row pb-4 gy-3">
    <div class="col-sm-4">
        <a href="{{route('product.index')}}" class="btn btn-warning addtax-modal"><i class="las la-times me-1"></i> cancel</a>
    </div>


</div>
@endsection

@section('content')



<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="p-2">
                    <form action="{{ route('product.store') }}" method="POST">
                        @csrf

                        <!-- Product Name -->
                        <div class="mb-3">
                            <label class="form-label" for="productname">Product Name</label>
                            <input
                                id="productname"
                                name="name"
                                placeholder="Enter Product Name"
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}">

                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="choices-single-category" class="form-label">Category</label>
                                    <select
                                        class="form-select @error('category_id') is-invalid @enderror"
                                        name="category_id"
                                        id="choices-single-category"
                                        data-trigger>

                                        <option value="">Select</option>
                                        @foreach($categories as $category)
                                        <option
                                            value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Product Description -->
                        <div class="mb-3">
                            <label class="form-label" for="productdesc">Product Description</label>
                            <textarea
                                class="form-control @error('description') is-invalid @enderror"
                                name="description"
                                id="productdesc"
                                placeholder="Enter Description"
                                rows="4">{{ old('description') }}</textarea>

                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="hstack gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                             <a href="{{ route('product.index') }}" class="btn btn-light">Discard</a>
                        </div>
                    </form>




                </div>
            </div>
        </div>



    </div>
</div>

@endsection