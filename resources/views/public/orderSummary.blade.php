@extends('layout.layout')

@section('content')
    <div class="container">
        <div>
            <h3 >First Name: {{$orderSummaryInfo['customer_first_name']}}</h3>
        </div>
        <div>
            <h3>Last Name: {{$orderSummaryInfo['customer_last_name']}}</h3>
        </div>
        <div>
            <h3>Email: {{$orderSummaryInfo['customer_email']}}</h3>
        </div>
        <div>
            <h3>Billing Address: {{$orderSummaryInfo['customer_billing_address']}}</h3>
        </div>
        <div >
            <h3>Shipping Address: {{$orderSummaryInfo['customer_shipping_address']}}</h3>
        </div>
        <div >
            <h3>Product Name: {{$orderSummaryInfo['product_name']}}</h3>
        </div>
        <div >
            <h3>Product Price: {{$orderSummaryInfo['product_price_at_order']}} FT</h3>
        </div>
        <div >
            <h3>Quantity: {{$orderSummaryInfo['product_quantity']}} DB</h3>
        </div>
        <div >
            <h3>Final Price: {{$orderSummaryInfo['final_price']}} FT</h3>
        </div>
        <form action="/order-item" method="post">
            @csrf
                <input type="hidden" name="id" id="product-id" value="{{$orderSummaryInfo['product_id'] ?? ''}}">
                <input type="hidden" name="first_name" id="customer-first-name" value="{{$orderSummaryInfo['customer_first_name'] ?? ''}}">
                <input type="hidden" name="last_name" id="last-name-id" value="{{$orderSummaryInfo['customer_last_name'] ?? ''}}">
                <input type="hidden" name="customer_email" id="customer-email" value="{{$orderSummaryInfo['customer_email'] ?? ''}}">
                <input type="hidden" name="customer_billing_address" id="customer-billing-address" value="{{$orderSummaryInfo['customer_billing_address'] ?? ''}}">
                <input type="hidden" name="customer_shipping_address" id="customer-shipping-address" value="{{$orderSummaryInfo['customer_shipping_address'] ?? ''}}">
                <input type="hidden" name="product_quantity" id="product-quantity" value="{{$orderSummaryInfo['product_quantity'] ?? ''}}">
            <div id="Submit_button_div" class="text-center">
                <button class="btn-primary">
                    Submit
                </button>
            </div>
        </form>
        <form action="/back-to-order-page" method="post">
            @csrf
            <input type="hidden" name="id" id="product-id" value="{{$orderSummaryInfo['product_id'] ?? ''}}">
            <input type="hidden" name="first_name" id="customer-first-name" value="{{$orderSummaryInfo['customer_first_name'] ?? ''}}">
            <input type="hidden" name="last_name" id="last-name-id" value="{{$orderSummaryInfo['customer_last_name'] ?? ''}}">
            <input type="hidden" name="customer_email" id="customer-email" value="{{$orderSummaryInfo['customer_email'] ?? ''}}">
            <input type="hidden" name="customer_billing_address" id="customer-billing-address" value="{{$orderSummaryInfo['customer_billing_address'] ?? ''}}">
            <input type="hidden" name="customer_shipping_address" id="customer-shipping-address" value="{{$orderSummaryInfo['customer_shipping_address'] ?? ''}}">
            <input type="hidden" name="product_quantity" id="product-quantity" value="{{$orderSummaryInfo['product_quantity'] ?? ''}}">
            <div id="Submit_button_div" class="text-center">
                <button class="btn-primary">
                    Back
                </button>
            </div>
        </form>
    </div>

@endsection
