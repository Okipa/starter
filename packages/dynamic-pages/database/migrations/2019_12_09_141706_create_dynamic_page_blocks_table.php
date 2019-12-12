<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDynamicPageBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dynamic_page_blocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('position');
            $table->string('block_id');
            $table->unsignedBigInteger('dynamic_page_id');
            $table->unsignedBigInteger('blockable_id')->nullable();
            $table->string('blockable_type')->nullable();
            $table->timestamps();
            $table
                ->foreign('dynamic_page_id')
                ->on('dynamic_pages')
                ->references('id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dynamic_page_blocks');
    }
}
