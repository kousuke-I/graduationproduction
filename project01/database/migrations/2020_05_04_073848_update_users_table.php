<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('userid')->unique()->after('email');
            $table->tinyInteger('role')->default(9)->after('password')->index('index_role')->comment('ロール');
            //$table->enum('role',['admin','user'])->default('user')->after('password')->index('index_role')->comment('ロール');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('userid');
            $table->dropColumn('role');
        });
    }
}
