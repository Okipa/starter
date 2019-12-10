<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimplePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simple_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique();
            // todo : uncomment if monolingual app
            // $table->string('url')->unique();
            // todo : uncomment if monolingual app
            // $table->string('title');
            // todo : uncomment if monolingual app
            // $table->longText('description')->nullable();
            // todo : remove if monolingual app
            $table->json('url');
            // todo : remove if monolingual app
            $table->json('title');
            // todo : remove if monolingual app
            $table->json('description')->nullable();
            $table->boolean('active');
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
        Schema::dropIfExists('simple_pages');
    }
}
