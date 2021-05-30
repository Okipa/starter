<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarouselBrickSlidesTable extends Migration
{
    public function up(): void
    {
        Schema::create('carousel_brick_slides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brick_id');
            $table->foreign('brick_id')->references('id')->on('bricks')->onDelete('cascade');
            // ToDo: change column type if your app is not multilingual
            $table->json('label');
            // ToDo: change column type if your app is not multilingual
            $table->json('caption');
            $table->unsignedInteger('position');
            $table->boolean('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carousel_brick_slides');
    }
}
