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
        Schema::create('streams_types', function (Blueprint $table) {
            $table->integer('type_id')->autoIncrement();
            $table->string('type_name', 255);
            $table->string('type_key', 255);
            $table->string('type_output', 255);
            $table->integer('live');

            $table->index('type_key', 'streams_types_type_key');
            $table->index('type_output', 'streams_types_type_output');
            $table->index('live', 'streams_types_live');
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
        Schema::dropIfExists('streams_types');
    }
};

