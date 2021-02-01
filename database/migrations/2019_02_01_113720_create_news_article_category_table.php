<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsArticleCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_article_category');
    }
}
