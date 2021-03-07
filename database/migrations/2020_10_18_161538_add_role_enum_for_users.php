<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleEnumForUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sqlDropType = <<<SQL
        DROP TYPE IF EXISTS "roles" CASCADE;
SQL;

        $sqlAndRoleType = <<<SQL
        CREATE TYPE roles AS ENUM ( 'User','Admin');
SQL;
        $sqlAlterUsers = <<<SQL
        ALTER TABLE users ADD COLUMN role roles Default 'User';
SQL;
        DB::statement($sqlDropType);
        DB::statement($sqlAndRoleType);
        DB::statement($sqlAlterUsers);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
