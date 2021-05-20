<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsArticleCategoryTable extends Migration
{
    public function up(): void
    {
        Schema::create('news_article_category', function (Blueprint $table) {
            $table->unsignedBigInteger('news_article_id');
            $table->foreign('news_article_id')->references('id')->on('news_articles')->onDelete('cascade');
            $table->unsignedBigInteger('news_category_id');
            $table->foreign('news_category_id')->references('id')->on('news_categories')->onDelete('cascade');
            $table->primary(['news_article_id', 'news_category_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_article_category');
    }
}
