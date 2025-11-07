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
        Schema::create('streams_sys', function (Blueprint $table) {
            $table->integer('server_stream_id')->autoIncrement();
            $table->integer('stream_id');
            $table->integer('server_id');
            $table->integer('parent_id')->nullable();
            $table->integer('pid')->nullable();
            $table->integer('to_analyze')->default('0');
            $table->integer('stream_status')->default('0');
            $table->integer('stream_started')->nullable();
            $table->mediumText('stream_info');
            $table->integer('monitor_pid')->nullable();
            $table->mediumText('current_source')->nullable();
            $table->integer('bitrate')->nullable();
            $table->text('progress_info');
            $table->integer('on_demand')->default('0');
            $table->integer('delay_pid')->nullable();
            $table->integer('delay_available_at')->nullable();

            $table->index('stream_id', 'streams_sys_stream_id');
            $table->index('pid', 'streams_sys_pid');
            $table->index('server_id', 'streams_sys_server_id');
            $table->index('stream_status', 'streams_sys_stream_status');
            $table->index('stream_started', 'streams_sys_stream_started');
            $table->index('parent_id', 'streams_sys_parent_id');
            $table->index('to_analyze', 'streams_sys_to_analyze');
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
        Schema::dropIfExists('streams_sys');
    }
};

