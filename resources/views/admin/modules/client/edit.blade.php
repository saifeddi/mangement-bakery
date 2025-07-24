@extends('admin.layouts.master')

@section('page-title')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Edit Client</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('client.index') }}">Client</a></li>
                    <li class="breadcrumb-item active">Edit Client</li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section('button')
<div class="row pb-4 gy-3">
    <div class="col-sm-4">
        <a href="{{ route('client.index') }}" class="btn btn-warning"><i class="las la-times me-1"></i> Cancel</a>
    </div>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="p-2">

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('client.update', $client->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Client Name -->
                        <div class="mb-3">
                            <label class="form-label" for="clientname">Client Name</label>
                            <input
                                id="clientname"
                                name="name"
                                placeholder="Enter Client Name"
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $client->name) }}">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Matricule Fiscale -->
                        <div class="mb-3">
                            <label class="form-label" for="matricule_fiscale">Matricule Fiscale</label>
                            <input
                                id="matricule_fiscale"
                                name="matricule_fiscale"
                                placeholder="Enter Matricule Fiscale"
                                type="text"
                                class="form-control @error('matricule_fiscale') is-invalid @enderror"
                                value="{{ old('matricule_fiscale', $client->matricule_fiscale) }}">
                            @error('matricule_fiscale') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label class="form-label" for="address">Adresse</label>
                            <textarea
                                id="address"
                                name="address"
                                placeholder="Enter Address"
                                class="form-control @error('address') is-invalid @enderror"
                                rows="3">{{ old('address', $client->address) }}</textarea>
                            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input
                                id="email"
                                name="email"
                                placeholder="Enter Email"
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $client->email) }}">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label class="form-label" for="phone">Phone</label>
                            <input
                                id="phone"
                                name="phone"
                                placeholder="Enter Phone"
                                type="text"
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $client->phone) }}">
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Product Selection -->
                        <div class="mb-4">
                            <label class="form-label">Select Products & Prices</label>
                            <div class="row">
                                @foreach($products as $product)
                                @php
                                $checked = old('product_ids')
                                ? in_array($product->id, old('product_ids'))
                                :$client->clientProducts->contains('product_id', $product->id);

                                $price = old('prices.' . $product->id)
                                ?? optional($client->clientProducts->firstWhere('product_id', $product->id))->price;
                                @endphp
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input product-checkbox"
                                            type="checkbox"
                                            name="product_ids[]"
                                            value="{{ $product->id }}"
                                            id="product_{{ $product->id }}"
                                            {{ $checked ? 'checked' : '' }}>
                                        <label class="form-check-label" for="product_{{ $product->id }}">
                                            {{ $product->name }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <input
                                        type="number"
                                        step="0.01"
                                        name="prices[{{ $product->id }}]"
                                        class="form-control product-price"
                                        id="price_{{ $product->id }}"
                                        placeholder="Enter price in millimes for {{ $product->name }}"
                                        value="{{ $price }}"
                                        {{ !$checked ? 'disabled' : '' }}>
                                </div>
                                @endforeach
                            </div>
                            @error('product_ids') <div class="text-danger">{{ $message }}</div> @enderror
                            @error('product_ids.*') <div class="text-danger">{{ $message }}</div> @enderror
                            @error('prices') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="hstack gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('client.index') }}" class="btn btn-light">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.product-checkbox').forEach(checkbox => {
            console.log("yes", checkbox);
            
            checkbox.addEventListener('change', function() {
                const priceInput = document.getElementById('price_' + this.value);
                if (this.checked) {
                    priceInput.disabled = false;
                    priceInput.required = true;
                } else {
                    priceInput.disabled = true;
                    priceInput.required = false;
                    priceInput.value = '';
                }
            });
        });
    });
</script>
@endsection