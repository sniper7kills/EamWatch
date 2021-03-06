<?php
/*
 * Migrations generated by: Skipper (http://www.skipper18.com)
 * Migration id: 0434dde0-7ce3-4609-8a4d-ffc569a2663a
 * Migration datetime: 2020-06-14 00:53:07.124242
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SkipperMigrations2020061400530712 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->unique()->after('name')->change();
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
            $table->string('email')->after('name')->change();
        });
    }
}
