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
        Schema::create('stream_logs', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('stream_id');
            $table->integer('server_id');
            $table->integer('date');
            $table->string('error', 500);

            $table->index('stream_id', 'stream_logs_stream_id');
            $table->index('server_id', 'stream_logs_server_id');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stream_logs');
    }
};

