<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCookieCategoriesTable extends Migration
{
    public function up(): void
    {
        Schema::create('cookie_categories', function (Blueprint $table) {
            $table->id();
            $table->string('unique_key')->unique();
            // ToDo: change column type with monolingual app
            $table->json('title');
            // ToDo: change column type with monolingual app
            $table->json('description')->nullable();
            $table->unsignedInteger('position');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cookie_categories');
    }
}
