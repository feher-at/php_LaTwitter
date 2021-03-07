@extends('layout.layout')

@section('content')
    <div class="container mt-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Sale Price</th>
                        <th>Product Description</th>
                        <th>Created At</th>
                        <th>Updated At</th>
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
        $(document).ready(function(){


            let table = $('.table').DataTable({

                processing:true,
                serverSide:true,
                orderable:true,
                stateSave:true,
                searchable: true,



                ajax:{url:'/get-data-for-table',headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},},


                columns:[
                    {data: "id"},
                    {data:"product_name"},
                    {data:"product_price"},
                    {data:"product_sale_price"},
                    {data:"product_description"},
                    {data:"created_at"},
                    {data:"updated_at"},
                    {
                        name: "action",
                        searchable:false,
                        data:"action",
                        orderable:false,
                        defaultContent: " <button  id='update'  class='delete btn  btn-sm'>&#9998</button>\n" +
                            "<button  id='delete' class='delete btn  btn-sm'>&#128465</button>"},


                ]


            });

            $('input[type="search"]').on( 'keyup', function (){

            });



            $('.table tbody').on( 'click', '#delete', function () {
                let data = table.row( $(this).parents('tr') ).data();
                alertify.confirm('Are you sure that you want to delete this item: ' + data['product_name'],
                    function(){
                        $.ajax({
                            url: "/delete-item",
                            type:"GET",
                            data:{id:data['id']}
                        })
                        location.reload();
                    },
                    function(){
                        alertify.error('Cancel');
                    });
            } );

            $('.table tbody').on( 'click', '#update', function () {
                let data = table.row( $(this).parents('tr') ).data();
                window.location= '/new-item?id='+data['id'];
            });
        });

    </script>
@endsection
