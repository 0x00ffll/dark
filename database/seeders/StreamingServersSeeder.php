<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StreamingServersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Truncate table
        DB::table('streaming_servers')->truncate();

        $data = [
            [
                'id' => 1,
                'server_name' => 'Main Server',
                'domain_name' => '',
                'server_ip' => '127.0.0.1',
                'vpn_ip' => '',
                'ssh_password' => null,
                'ssh_port' => null,
                'diff_time_main' => 0,
                'http_broadcast_port' => 25461,
                'total_clients' => 1000,
                'system_os' => null,
                'network_interface' => 'eh0',
                'latency' => 0,
                'status' => 1,
                'enable_geoip' => 0,
                'geoip_countries' => '',
                'last_check_ago' => 0,
                'can_delete' => 0,
                'server_hardware' => '',
                'total_services' => 3,
                'persistent_connections' => 0,
                'rtmp_port' => 25462,
                'geoip_type' => 'low_priority',
                'isp_names' => '',
                'isp_type' => 'low_priority',
                'enable_isp' => 0,
                'boost_fpm' => 0,
                'http_ports_add' => '',
                'network_guaranteed_speed' => 0,
                'https_broadcast_port' => 25463,
                'https_ports_add' => '',
                'whitelist_ips' => '',
                'watchdog_data' => '',
                'timeshift_only' => 0,
            ],
        ];

        // Insert data in chunks for better performance
        collect($data)->chunk(100)->each(function ($chunk) {
            DB::table('streaming_servers')->insert($chunk->toArray());
        });

        // Set AUTO_INCREMENT to next value
        // Reset AUTO_INCREMENT for next insertion
        $maxId = DB::table('streaming_servers')->max('id') ?? DB::table('streaming_servers')->max(DB::raw('ROWID')) ?? 0;
        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE streaming_servers AUTO_INCREMENT = ' . ($maxId + 1));
        }

        Schema::enableForeignKeyConstraints();
    }
}
