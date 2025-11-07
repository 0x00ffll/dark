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
        Schema::create('tickets', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('member_id');
            $table->string('title', 255);
            $table->integer('status')->default('1');
            $table->integer('admin_read');
            $table->integer('user_read');

            $table->index('member_id', 'tickets_member_id');
            $table->index('status', 'tickets_status');
            $table->index('admin_read', 'tickets_admin_read');
            $table->index('user_read', 'tickets_user_read');
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
        Schema::dropIfExists('tickets');
    }
};

