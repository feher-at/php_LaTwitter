@extends('layout.layout')

@section('content')
    <div class="container mt-5">
        <table id="orders" class="table table-bordered">
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Customer Shipping Address</th>
                <th>Customer Billing Address</th>
                <th>Product Id</th>
                <th>Product Quantity</th>
                <th>Final Price (FT)</th>
                <th>Status</th>
                <th id="myAction">Change status</th>
            </tr>
            </thead>

        </table>
    </div>
    {{Html::script("https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js")}}
    {{Html::script("https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js")}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

<script>

    $(document).ready(function() {


        let table = $('#orders').DataTable({

            processing: true,
            serverSide: true,
            orderable: true,
            stateSave: true,
            searchable: true,


            ajax: {
                url: '/ajax-get-orders',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            },


            columns: [
                {data: "id"},
                {data: "customer_name"},
                {data: "customer_email"},
                {data: "customer_shipping_address"},
                {data: "customer_billing_address"},
                {data: "product_id"},
                {data: "product_quantity"},
                {data: "final_price"},
                {data:"status"},
                {
                    name: "Change status",
                    searchable: false,
                    data: "Change status",
                    orderable: false,
                    defaultContent: " <button  id='delivery' title='Set order status to delivery' class='btn  btn-sm'>&#128666</button>\n" +
                                    "<button  id='delete' title='delete order' class='delete btn  btn-sm'>&#128465</button>\n" +
                                    "<button  id='arrived' title='Set order status to arrived ' class='btn  btn-sm'>&#10003</button>"

                },
            ],

            createdRow: function( row, data) {
                if ( data['status'] === "delivery" ) {
                    $(row).addClass( 'table-primary' );
                }
                else if ( data['status'] === "order arrived" ) {
                    $(row).addClass( 'table-success' );
                }
                else{
                    $(row).addClass( 'table-danger' )
                }
            }

        });

        $('input[type="search"]').on('keyup', function () {

        });

        $('#orders tbody').on( 'click', '#delete', function () {
            let data = table.row( $(this).parents('tr') ).data();

            alertify.confirm('Are you sure that you want to delete this item: ' + data['product_name'],
                function(){
                    $.ajax({
                        url: "/ajax-delete-order",
                        type:"GET",
                        data:{id:data['id']}
                    })
                    location.reload();
                },
                function(){
                    alertify.error('Cancel');
                });
        } );

        $('#orders tbody').on( 'click', '#arrived', function () {
            let data = table.row( $(this).parents('tr') ).data();
            console.log(data['status'])
            $.ajax({

                url: "/ajax-change-status",
                type: "GET",
                data: {id: data['id'], status: "order arrived"}
            })
            location.reload();
        });


        $('#orders tbody').on( 'click', '#delivery', function () {
            let data = table.row( $(this).parents('tr') ).data();

            $.ajax({

                url: "/ajax-change-status",
                type: "GET",
                data: {id: data['id'], status: "delivery"}
            })
            location.reload();
        });


    });

</script>
@endsection
