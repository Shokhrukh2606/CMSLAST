<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->nullable();
            $table->integer('category_id2')->nullable();
            $table->string('group', 255);
            $table->string('alias', 4000)->nullable();
            $table->json('title')->default('{"ru":"", "en":"", "oz":"", "uz":""}');
            $table->json('content')->default('{"ru":"", "en":"", "oz":"", "uz":""}');
            $table->json('content_html')->default('{"ru":"", "en":"", "oz":"", "uz":""}');
            $table->json('short_content')->default('{"ru":"", "en":"", "oz":"", "uz":""}');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->enum('option', ['yes', 'no'])->nullable();
            $table->text('options')->nullable();
            $table->integer('views')->nullable();
            $table->text('tags')->nullable();
            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();
            $table->json('meta_keywords')->nullable();
            $table->integer('sort_order')->nullable();
            $table->date('inserted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
