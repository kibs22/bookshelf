<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostedCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posted_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('posted_id');
            $table->unsignedInteger('category_id');
            $table->foreign('posted_id')->references('id')->on('posted_books')->onDelete('cascade');
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
        Schema::dropIfExists('posted_categories');
    }
}
