<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('report_title');
            $table->string('report_desc');
            $table->string('report_media')->nullable();
            $table->string('crime_category');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('location')->nullable();
            $table->timestamps();
        });

        // Schema::create('report', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('report_title');
        //     $table->string('report_desc')->nullable();
        //     $table->string('report_media')->nullable();
        //     $table->string('crime_category');
        //     $table->string('latitude');
        //     $table->string('longitude');
        //     $table->string('location')->nullable();
        //     $table->string('district')->nullable();; //kiv ()
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report');
    }
}
