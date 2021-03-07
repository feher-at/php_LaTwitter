<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "CREATE TABLE products(
                id serial not null primary key,
                product_name text NOT NULL,
                product_price int NOT NULL,
                product_sale_price int NOT NULL,
                product_description text NOT NULL,
                created_at timestamptz DEFAULT now(),
                updated_at timestamptz



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
        $sql = "drop table products";

        DB::statement($sql);
    }
}
