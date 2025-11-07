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
        Schema::create('stream_categories', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('category_type', 255);
            $table->string('category_name', 255);
            $table->integer('parent_id')->default('0');
            $table->integer('cat_order')->default('0');

            $table->index('category_type', 'stream_categories_category_type');
            $table->index('cat_order', 'stream_categories_cat_order');
            $table->index('parent_id', 'stream_categories_parent_id');
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
        Schema::dropIfExists('stream_categories');
    }
};

