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
        Schema::create('streams_options', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('stream_id');
            $table->integer('argument_id');
            $table->text('value')->nullable();

            $table->index('stream_id', 'streams_options_stream_id');
            $table->index('argument_id', 'streams_options_argument_id');
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
        Schema::dropIfExists('streams_options');
    }
};

