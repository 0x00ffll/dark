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
        Schema::create('stream_subcategories', function (Blueprint $table) {
            $table->integer('sub_id')->autoIncrement();
            $table->integer('parent_id');
            $table->string('subcategory_name', 255);

            $table->index('parent_id', 'stream_subcategories_parent_id');
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
        Schema::dropIfExists('stream_subcategories');
    }
};

