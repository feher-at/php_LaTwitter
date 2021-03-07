@extends('layout.layout')

@section('content')
    <div class="container">
        <form action="/new-item" method="post">
            @csrf
            <div class="form-group">
                <label >Product Name</label>
                <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" id="product-name" value="{{$product->product_name ?? old('product_name')}}">
                @error('product_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Product Price</label>
                <input type="text" name="product_price" class="form-control @error('product_price') is-invalid @enderror" id="product-price" value={{$product->product_price ?? old('product_price')}}>
                @error('product_price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Product Sale Price</label>
                <input type="text"  name="product_sale_price" class="form-control @error('product_sale_price') is-invalid @enderror" id="product-sale-price"  value={{$product->product_sale_price ?? old('product_sale_price')}}>
                @error('product_sale_price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Product Description</label>
                <input type="text" name="product_description" class="form-control @error('product_description') is-invalid @enderror" id="product-description" value="{{$product->product_description ?? old('product_description')}}">
                @error('product_description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">

                <input type="hidden" name="id" id="product-id" value={{$product->id ?? ''}}>

            </div>
            <div id="Submit_button_div" class="text-center">
                <button class="btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>

@endsection
