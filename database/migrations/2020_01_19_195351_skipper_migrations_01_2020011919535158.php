<?php
/*
 * Migrations generated by: Skipper (http://www.skipper18.com)
 * Migration id: 15a30084-7107-4af3-97ca-68b36a3aedb8-01
 * Migration datetime: 2020-01-19 19:53:51.587854
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->string('name');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable(true);
            $table->string('password');
            $table->string('remember_token', 100)->nullable(true);
            $table->boolean('banned')->default(false);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
        });
        Schema::create('guests', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->ipAddress('ip');
            $table->boolean('banned')->default(false);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
        });
        Schema::create('settings', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement()->unsigned();
            $table->uuid('user_id')->nullable(true);
            $table->string('key')->unique();
            $table->string('value');
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->timestamp('deleted_at')->nullable(true);
        });
        Schema::create('commentables', function (Blueprint $table) {
            $table->uuid('comment_id');
            $table->uuid('commentable_id');
            $table->string('commentable_type');
        });
        Schema::create('ratingables', function (Blueprint $table) {
            $table->uuid('rating_id');
            $table->uuid('ratingable_id');
            $table->string('ratingable_type');
        });
        Schema::create('relays', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('message_id');
            $table->uuid('relay_provider_id');
            $table->text('response')->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->timestamp('deleted_at')->nullable(true);
        });
        Schema::create('relay_providers', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('user_id');
            $table->string('name');
            $table->enum('type', ['Twitter', 'Discord'])->nullable(true);
            $table->text('details');
            $table->boolean('enabled')->nullable(true);
            $table->timestamp('circuit_closed_at')->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->timestamp('deleted_at')->nullable(true);
        });
        Schema::create('comments', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('userable_id');
            $table->string('userable_type');
            $table->uuid('parent_comment_id')->nullable(true);
            $table->text('message');
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->timestamp('deleted_at')->nullable(true);
        });
        Schema::create('messages', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('userable_id');
            $table->string('userable_type');
            $table->text('message');
            $table->enum('type', ['BACKEND', 'SKYKING', 'ALLSTATIONS', 'RADIOCHECK', 'SKYMASTER', 'SKYBIRD', 'DISREGARDED', 'OTHER']);
            $table->string('sender');
            $table->string('receiver')->nullable(true);
            $table->timestamp('broadcast_ts')->useCurrent();
            $table->boolean('visible')->default(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->timestamp('deleted_at')->nullable(true);
        });
        Schema::create('recordings', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('userable_id');
            $table->string('userable_type');
            $table->uuid('message_id')->nullable(true);
            $table->timestamp('broadcasted_at')->useCurrent();
            $table->integer('frequency')->unsigned();
            $table->string('receiver')->nullable(true);
            $table->boolean('automated')->default(false);
            $table->boolean('automated_reviewed')->nullable(true)->default(false);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->timestamp('deleted_at')->nullable(true);
        });
        Schema::create('ratings', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('userable_id');
            $table->string('userable_type');
            $table->tinyInteger('score');
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->timestamp('deleted_at')->nullable(true);
        });
        Schema::table('commentables', function (Blueprint $table) {
            $table->foreign('comment_id')->references('id')->on('comments');
        });
        Schema::table('ratingables', function (Blueprint $table) {
            $table->foreign('rating_id')->references('id')->on('ratings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ratingables', function (Blueprint $table) {
            $table->dropForeign('rating_id');
        });
        Schema::table('commentables', function (Blueprint $table) {
            $table->dropForeign('comment_id');
        });
        Schema::dropIfExists('ratings');
        Schema::dropIfExists('recordings');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('relay_providers');
        Schema::dropIfExists('relays');
        Schema::dropIfExists('ratingables');
        Schema::dropIfExists('commentables');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('guests');
        Schema::dropIfExists('users');
    }
};
