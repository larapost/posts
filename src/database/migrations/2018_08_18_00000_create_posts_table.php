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
        Schema::create('larapost_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_author')->unsigned();
            $table->string('title');
            $table->text('content');
            $table->text('excerpt')->nullable();
            $table->string('type')->default('post');
            $table->enum('status', ['publish', 'draft', 'delete'])->default('draft');
            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('larapost_posts');
    }
}
