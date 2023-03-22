<?php
/*
 * Migrations generated by: Skipper (http://www.skipper18.com)
 * Migration id: 15a30084-7107-4af3-97ca-68b36a3aedb8-02
 * Migration datetime: 2020-01-19 19:53:51.587854
 */

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
    public function up(): void
    {
        Schema::table('relays', function (Blueprint $table) {
            $table->foreign('message_id')->references('id')->on('messages');
        });
        Schema::table('relays', function (Blueprint $table) {
            $table->foreign('relay_provider_id')->references('id')->on('relay_providers');
        });
        Schema::table('relay_providers', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('parent_comment_id')->references('id')->on('comments');
        });
        Schema::table('recordings', function (Blueprint $table) {
            $table->foreign('message_id')->references('id')->on('messages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        if (Schema::hasTable('recordings')) {
            Schema::table('recordings', function (Blueprint $table) {
                $table->dropForeign(['message_id']);
            });
        }
        if (Schema::hasTable('comments')) {
            Schema::table('comments', function (Blueprint $table) {
                $table->dropForeign(['parent_comment_id']);
            });
        }
        if (Schema::hasTable('relay_providers')) {
            Schema::table('relay_providers', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }
        if (Schema::hasTable('relays')) {
            Schema::table('relays', function (Blueprint $table) {
                $table->dropForeign(['relay_provider_id']);
            });
        }
        if (Schema::hasTable('relays')) {
            Schema::table('relays', function (Blueprint $table) {
                $table->dropForeign(['message_id']);
            });
        }
    }
};
