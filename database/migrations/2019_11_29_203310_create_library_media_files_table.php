<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibraryMediaFilesTable extends Migration
{
    public function up(): void
    {
        Schema::create('library_media_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('library_media_categories')->onDelete('CASCADE');
            // ToDo: change column type if your app is not multilingual
            $table->json('name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('library_media_files');
    }
}
