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
        Schema::create('user_activity_now', function (Blueprint $table) {
            $table->integer('activity_id')->autoIncrement();
            $table->integer('user_id');
            $table->integer('stream_id');
            $table->integer('server_id');
            $table->string('user_agent', 255)->nullable();
            $table->string('user_ip', 39);
            $table->string('container', 50);
            $table->integer('pid')->nullable();
            $table->integer('date_start');
            $table->integer('date_end')->nullable();
            $table->string('geoip_country_code', 22);
            $table->string('isp', 255);
            $table->string('external_device', 255);
            $table->integer('divergence')->nullable();
            $table->integer('hls_last_read')->nullable();
            $table->integer('hls_end')->default('0');

            $table->index('user_agent', 'user_activity_now_user_agent');
            $table->index('user_ip', 'user_activity_now_user_ip');
            $table->index('container', 'user_activity_now_container');
            $table->index('pid', 'user_activity_now_pid');
            $table->index('geoip_country_code', 'user_activity_now_geoip_country_code');
            $table->index('user_id', 'user_activity_now_user_id');
            $table->index('stream_id', 'user_activity_now_stream_id');
            $table->index('server_id', 'user_activity_now_server_id');
            $table->index('date_start', 'user_activity_now_date_start');
            $table->index('date_end', 'user_activity_now_date_end');
            $table->index('hls_end', 'user_activity_now_hls_end');
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
        Schema::dropIfExists('user_activity_now');
    }
};

