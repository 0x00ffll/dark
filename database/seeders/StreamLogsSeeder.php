<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StreamLogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Truncate table
        DB::table('stream_logs')->truncate();

        $data = [
            [
                'id' => 1,
                'stream_id' => 309255,
                'server_id' => 16,
                'date' => 1570285389,
                'error' => '[tcp @ 0x520c540] Connection to tcp://127.0.0.1:83 failed: Connection refused',
            ],
            [
                'id' => 2,
                'stream_id' => 309255,
                'server_id' => 16,
                'date' => 1570285389,
                'error' => 'Failed to open progress URL \"http://127.0.0.1:83/progress.php?stream_id=309255\": Connection refused',
            ],
            [
                'id' => 3,
                'stream_id' => 309255,
                'server_id' => 16,
                'date' => 1570285389,
                'error' => '[tcp @ 0x5212600] Connection to tcp://127.0.0.1:83 failed: Connection refused',
            ],
            [
                'id' => 4,
                'stream_id' => 309255,
                'server_id' => 16,
                'date' => 1570285389,
                'error' => '[tcp @ 0x522b2c0] Connection to tcp://127.0.0.1:83 failed: Connection refused',
            ],
            [
                'id' => 5,
                'stream_id' => 21112,
                'server_id' => 16,
                'date' => 1570285389,
                'error' => '[tcp @ 0x554a940] Connection to tcp://127.0.0.1:83 failed: Connection refused',
            ],
            [
                'id' => 6,
                'stream_id' => 21112,
                'server_id' => 16,
                'date' => 1570285389,
                'error' => 'Failed to open progress URL \"http://127.0.0.1:83/progress.php?stream_id=21112\": Connection refused',
            ],
            [
                'id' => 7,
                'stream_id' => 21112,
                'server_id' => 16,
                'date' => 1570285389,
                'error' => '[http @ 0x55162c0] HTTP error 403 Forbidden',
            ],
            [
                'id' => 8,
                'stream_id' => 21112,
                'server_id' => 16,
                'date' => 1570285389,
                'error' => '[hls,applehttp @ 0x5510c00] keepalive request failed for \'http://50.7.198.106:80/uk_bbc_2_hd/tracks-v1a1/mono.m3u8?token=djIubG9jYWwuQzJlS2o5ck0xcEJaTF8tOGhHcnJqbkV3RWZsS28tSm9vSWt5V1g4bkJSSGMwYU5hLUR5SThCZ0twbDhnbXZYNlZ0S1gwLVc3NWFfc2I5RkNTYnpQR1RmZHI4QW1xN3VNZDlEaF9xenFUQlVLRG5wOVhmZ0JVc0c0YnUyamktbHVSaWM%3D\', retrying with new connection: Server returned 403 Forbidden (access denied',
            ],
            [
                'id' => 9,
                'stream_id' => 21112,
                'server_id' => 16,
                'date' => 1570285389,
                'error' => '[http @ 0x567a300] HTTP error 403 Forbidden',
            ],
            [
                'id' => 10,
                'stream_id' => 21112,
                'server_id' => 16,
                'date' => 1570285389,
                'error' => '[hls,applehttp @ 0x5510c00] Failed to reload playlist 0',
            ],
            [
                'id' => 11,
                'stream_id' => 21112,
                'server_id' => 16,
                'date' => 1570285389,
                'error' => '[http @ 0x5679bc0] HTTP error 403 Forbidden',
            ],
            [
                'id' => 12,
                'stream_id' => 321974,
                'server_id' => 16,
                'date' => 1570285389,
                'error' => '[tcp @ 0x429a7c0] Connection to tcp://127.0.0.1:83 failed: Connection refused',
            ],
            [
                'id' => 13,
                'stream_id' => 321974,
                'server_id' => 16,
                'date' => 1570285389,
                'error' => 'Failed to open progress URL \"http://127.0.0.1:83/progress.php?stream_id=321974\": Connection refused',
            ],
            [
                'id' => 14,
                'stream_id' => 321974,
                'server_id' => 16,
                'date' => 1570285389,
                'error' => '[http @ 0x4282080] HTTP error 403 Forbidden',
            ],
            [
                'id' => 15,
                'stream_id' => 321974,
                'server_id' => 16,
                'date' => 1570285389,
                'error' => '[hls,applehttp @ 0x427cb40] keepalive request failed for \'http://50.7.198.106:80/uk_virgin_media_1_hd/tracks-v1a1/mono.m3u8?token=djIubG9jYWwub3FDYktRRFo0Zzl3TjBtZFFzTmNqdDBxNEhnSzlEa2N3M0EycDN4ZFNEeUplSVJwU2FJaWw2c3VOMWtBcFBtb2VNWXVmSWVGY1VXNmd3THlVQXZVa2FRaVBkbzV6d1cwVFVKNWh6VGhYVFlIRnktUnpuaGwwSUlWalR4Zk94ZEZ6U2c%3D\', retrying with new connection: Server returned 403 Forbidden (access denied',
            ],
            [
                'id' => 16,
                'stream_id' => 321974,
                'server_id' => 16,
                'date' => 1570285390,
                'error' => '[http @ 0x44cf880] HTTP error 403 Forbidden',
            ],
            [
                'id' => 17,
                'stream_id' => 321974,
                'server_id' => 16,
                'date' => 1570285390,
                'error' => '[hls,applehttp @ 0x427cb40] Failed to reload playlist 0',
            ],
            [
                'id' => 18,
                'stream_id' => 321974,
                'server_id' => 16,
                'date' => 1570285390,
                'error' => '[http @ 0x42fed40] HTTP error 403 Forbidden',
            ],
        ];

        // Insert data in chunks for better performance
        collect($data)->chunk(100)->each(function ($chunk) {
            DB::table('stream_logs')->insert($chunk->toArray());
        });

        // Set AUTO_INCREMENT to next value
        // Reset AUTO_INCREMENT for next insertion
        $maxId = DB::table('stream_logs')->max('id') ?? DB::table('stream_logs')->max(DB::raw('ROWID')) ?? 0;
        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE stream_logs AUTO_INCREMENT = ' . ($maxId + 1));
        }

        Schema::enableForeignKeyConstraints();
    }
}
