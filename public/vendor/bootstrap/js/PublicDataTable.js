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
                defaultContent: " <button  id='buy'  class='delete btn  btn-sm'>&#12872",

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

