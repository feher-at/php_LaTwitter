@extends('layout.layout')

@section('content')
    <div class="container mt-5">
        <table id="public-product" class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Description</th>
                <th id="myAction">action</th>
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


        let table = $('#public-product').DataTable({

            processing: true,
            serverSide: true,
            orderable: true,
            stateSave: true,
            searchable: true,



            ajax: {url: '/ajax-get-data-for-public-table', headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},},


            columns: [
                {data: "id"},
                {data: "product_name"},
                {data: "product_price"},
                {data: "product_description"},
                {
                    name: "action",
                    searchable: false,
                    data: "action",
                    orderable: false,
                    defaultContent: " <button  id='buy'  class='delete btn  btn-sm'>&#128722</button>",

                },


            ]


        });

        $('input[type="search"]').on('keyup', function () {

        });
        $('#public-product tbody').on( 'click', '#buy', function () {
            let data = table.row( $(this).parents('tr') ).data();
            window.location= '/order-item?id='+data['id'];
        });
    })
</script>
@endsection
