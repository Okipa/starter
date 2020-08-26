<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarouselBrickSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carousel_brick_slides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brick_id');
            $table->foreign('brick_id')->references('id')->on('bricks')->onDelete('cascade');
            // todo: change column type with monolingual app
            $table->json('label');
            // todo: change column type with monolingual app
            $table->json('caption');
            $table->unsignedInteger('position');
            $table->boolean('active');
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
        Schema::dropIfExists('carousel_brick_slides');
    }
}
