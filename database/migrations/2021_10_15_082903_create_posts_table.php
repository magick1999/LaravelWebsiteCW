<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        // Schema::dropIfExists('posts');
        Schema::create('posts', function (Blueprint $table) {

            $table->id();
            $table->mediumText('text');
            $table->text('title');
            $table->string('image_url')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->
                on('users')->onDelete('cascade')->
                onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('posts');
    }
}
