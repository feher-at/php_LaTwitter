<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class phpAddEnumForOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sqlDropType = <<<SQL
        DROP TYPE IF EXISTS "status" CASCADE;
SQL;
        $sqlAndStatusType = <<<SQL
        CREATE TYPE status AS ENUM ( 'order arrived','under process','delivery');
SQL;
        $sqlAlterOrders = <<<SQL
        ALTER TABLE orders ADD COLUMN status status
SQL;
        DB::statement($sqlDropType);
        DB::statement($sqlAndStatusType);
        DB::statement($sqlAlterOrders);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
