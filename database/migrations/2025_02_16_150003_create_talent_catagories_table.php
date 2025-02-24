<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTalentCatagoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talent_catagories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('catagory_image_path')->nullable();
            $table->text('catagory_desc')->nullable();
            $table->string('catagory_main_banner')->nullable();
            $table->string('catagory_banner')->nullable();
            $table->string('catagory_detailed_banner')->nullable();
            $table->string('catagory_detailed_icon_img')->nullable();
            $table->string('tarending_catagory_sidebar_icon')->nullable();
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
        Schema::dropIfExists('talent_catagories');
    }
}