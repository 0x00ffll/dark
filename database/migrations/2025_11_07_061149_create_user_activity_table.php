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
        Schema::create('user_activity', function (Blueprint $table) {
            $table->integer('activity_id')->autoIncrement();
            $table->integer('user_id');
            $table->integer('stream_id');
            $table->integer('server_id');
            $table->string('user_agent', 255)->nullable();
            $table->string('user_ip', 39);
            $table->string('container', 50);
            $table->integer('date_start');
            $table->integer('date_end')->nullable();
            $table->string('geoip_country_code', 22);
            $table->string('isp', 255);
            $table->string('external_device', 255);
            $table->integer('divergence')->nullable();

            $table->index('user_id', 'user_activity_user_id');
            $table->index('stream_id', 'user_activity_stream_id');
            $table->index('server_id', 'user_activity_server_id');
            $table->index('date_end', 'user_activity_date_end');
            $table->index('container', 'user_activity_container');
            $table->index('geoip_country_code', 'user_activity_geoip_country_code');
            $table->index('date_start', 'user_activity_date_start');
            $table->index('user_ip', 'user_activity_user_ip');
            $table->index('user_agent', 'user_activity_user_agent');
            $table->index('isp', 'user_activity_isp');
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
        Schema::dropIfExists('user_activity');
    }
};

