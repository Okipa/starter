<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogContactFormMessagesTable extends Migration
{
    public function up(): void
    {
        Schema::create('log_contact_form_messages', function (Blueprint $table) {
            $table->id();
            $table->json('data');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_contact_form_messages');
    }
}
