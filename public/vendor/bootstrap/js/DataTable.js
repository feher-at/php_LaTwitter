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






