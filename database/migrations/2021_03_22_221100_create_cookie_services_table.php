<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCookieServicesTable extends Migration
{
    public function up(): void
    {
        Schema::create('cookie_services', function (Blueprint $table) {
            $table->id();
            $table->string('unique_key')->unique();
            // ToDo: change column type if your app is not multilingual
            $table->json('title');
            // ToDo: change column type if your app is not multilingual
            $table->json('description')->nullable();
            $table->json('cookies')->nullable();
            $table->boolean('required');
            $table->boolean('enabled_by_default');
            $table->boolean('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cookie_services');
    }
}
