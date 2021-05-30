<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCookieServiceCategoryTable extends Migration
{
    public function up(): void
    {
        Schema::create('cookie_service_category', function (Blueprint $table) {
            $table->unsignedBigInteger('cookie_service_id');
            $table->foreign('cookie_service_id')->references('id')->on('cookie_services')->onDelete('cascade');
            $table->unsignedBigInteger('cookie_category_id');
            $table->foreign('cookie_category_id')->references('id')->on('cookie_categories')->onDelete('cascade');
            $table->primary(['cookie_service_id', 'cookie_category_id'], 'cookie_service_id_category_id_primary');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cookie_service_category');
    }
}
