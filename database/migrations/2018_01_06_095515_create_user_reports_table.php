<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('reported_by');
            $table->unsignedInteger('reported_to');
            $table->unsignedInteger('report_id');
            $table->unsignedInteger('book_id');
            $table->string('others')->default(null);
            $table->foreign('reported_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reported_to')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('posted_books')->onDelete('cascade');
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
        Schema::dropIfExists('user_reports');
    }
}
