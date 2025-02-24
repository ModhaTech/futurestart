<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogLinksTable extends Migration
{
    /*** Run the migrations.** @return void*/
    public function up()
    {
        Schema::create('blog_links', function (Blueprint $table) 
        {
            $table->id();
            $table->unsignedBigInteger('blog_id');
            $table->unsignedBigInteger('user_id');
            $table->string('anchor')->nullable();
            $table->string('website')->nullable();
            $table->string('link')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /*** Reverse the migrations.** @return void*/
    public function down()
    {
        Schema::dropIfExists('blog_links');
    }
}
