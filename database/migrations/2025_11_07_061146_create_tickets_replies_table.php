<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets_replies', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('ticket_id');
            $table->integer('admin_reply');
            $table->mediumText('message');
            $table->integer('date');

            $table->index('ticket_id', 'tickets_replies_ticket_id');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets_replies');
    }
};

