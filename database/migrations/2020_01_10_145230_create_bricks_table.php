<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBricksTable extends Migration
{
    public function up(): void
    {
        Schema::create('bricks', function (Blueprint $table) {
            $table->id();
            $table->morphs('model');
            $table->string('brickable_type');
            $table->json('data');
            $table->unsignedInteger('position')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bricks');
    }
}
