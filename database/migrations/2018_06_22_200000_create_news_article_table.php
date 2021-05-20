<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsArticleTable extends Migration
{
    public function up(): void
    {
        Schema::create('news_articles', function (Blueprint $table) {
            $table->id();
            // ToDo: change column type with monolingual app
            $table->json('title');
            // ToDo: change column type with monolingual app
            $table->json('slug');
            // ToDo: change column type with monolingual app
            $table->json('description')->nullable();
            $table->boolean('active');
            $table->dateTime('published_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_articles');
    }
}
