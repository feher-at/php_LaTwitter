@extends('layout.layout')

@section('content')
    <div class="container">
        <form action="/order-summary" method="post">
            @csrf
            <div class="form-group">
                <label >First Name</label>
                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" id="first-name" value="{{$input['first_name'] ?? old('product_name')}}" >
                @error('first_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last-name" value="{{$input['last_name'] ??old('last_name')}}">
                @error('last_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Email</label>
                <input type="text"  name="customer_email" class="form-control @error('customer_email') is-invalid @enderror" id="customer-email" value="{{$input['customer_email'] ?? old('customer_email')}}">
                @error('customer_email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Billing Address</label>
                <input type="text" name="customer_billing_address" class="form-control @error('customer_billing_address') is-invalid @enderror" id="customer-billing-address" value="{{$input['customer_billing_address'] ??old('customer_billing_address')}}">
                @error('customer_billing_address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Shipping Address</label>
                <input type="text" name="customer_shipping_address" class="form-control @error('customer_shipping_address') is-invalid @enderror" id="customer-shipping-address" value="{{$input['customer_shipping_address'] ?? old('customer_shipping_address')}}">
                @error('customer_shipping_address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Quantity</label>
                <input type="text" name="product_quantity" class="form-control @error('product_quantity') is-invalid @enderror" id="product-quantity" value="{{$input['product_quantity'] ??old('product_quantity')}}">
                @error('product_quantity')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">

                <input type="hidden" name="id" id="product-id" value={{$input ?? ''}}>

            </div>
            <div id="Submit_button_div" class="text-center">
                <button class="btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>


@endsection
