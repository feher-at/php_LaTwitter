<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "CREATE TABLE orders(

                id serial not null primary key,
                product_id int REFERENCES products(id) not null,
                product_price_at_order int NOT NULL,
                product_name text NOT NULL,
                customer_name text NOT NULL,
                customer_shipping_address text NOT NULL,
                customer_billing_address text NOT NULL,
                customer_email text NOT NULL,
                product_quantity int NOT NULL,
                final_price int NOT NULL,
                created_at timestamptz DEFAULT now(),
                updated_at timestamp DEFAULT now()



    )";
        DB::statement($sql);



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $sql = "drop table orders";

        DB::statement($sql);
    }
}
