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
            $table->json('title');
            $table->json('description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cookie_categories');
    }
}
