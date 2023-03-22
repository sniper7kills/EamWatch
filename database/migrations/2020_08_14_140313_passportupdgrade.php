<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('oauth_clients', function (Blueprint $table) {
        //     $table->string('provider')->after('secret')->nullable();
        // });
        // DB::statement('ALTER TABLE oauth_clients CHANGE user_id user_id CHAR(36)');
        // DB::statement('ALTER TABLE oauth_auth_codes CHANGE user_id user_id CHAR(36)');
        // DB::statement('ALTER TABLE oauth_access_tokens CHANGE user_id user_id CHAR(36)');
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
};
