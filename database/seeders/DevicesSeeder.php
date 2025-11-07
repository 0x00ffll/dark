<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DevicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Truncate table
        DB::table('devices')->truncate();

        $data = [
            [
                'device_id' => 1,
                'device_name' => 'GigaBlue',
                'device_key' => 'gigablue',
                'device_filename' => 'userbouquet.favourites.tv',
                'device_header' => '#NAME {BOUQUET_NAME}',
                'device_conf' => '#SERVICE 4097:0:1:0:0:0:0:0:0:0:{URL#:}\\r\\n#DESCRIPTION {CHANNEL_NAME}',
                'device_footer' => '',
                'default_output' => 2,
                'copy_text' => null,
            ],
            [
                'device_id' => 2,
                'device_name' => 'Enigma 2 OE 1.6',
                'device_key' => 'enigma16',
                'device_filename' => 'userbouquet.favourites.tv',
                'device_header' => '#NAME {BOUQUET_NAME}',
                'device_conf' => '#SERVICE 4097{SID}{URL#:}\\r\\n#DESCRIPTION {CHANNEL_NAME}',
                'device_footer' => '',
                'default_output' => 2,
                'copy_text' => null,
            ],
            [
                'device_id' => 3,
                'device_name' => 'DreamBox OE 2.0',
                'device_key' => 'dreambox',
                'device_filename' => 'userbouquet.favourites.tv',
                'device_header' => '#NAME {BOUQUET_NAME}',
                'device_conf' => '#SERVICE {ESR_ID}{SID}{URL#:}\\r\\n#DESCRIPTION {CHANNEL_NAME}',
                'device_footer' => '',
                'default_output' => 2,
                'copy_text' => null,
            ],
            [
                'device_id' => 4,
                'device_name' => 'm3u',
                'device_key' => 'm3u',
                'device_filename' => 'tv_channels_{USERNAME}.m3u',
                'device_header' => '#EXTM3U',
                'device_conf' => '#EXTINF:-1,{CHANNEL_NAME}\\r\\n{URL}',
                'device_footer' => '',
                'default_output' => 2,
                'copy_text' => null,
            ],
            [
                'device_id' => 5,
                'device_name' => 'Simple List',
                'device_key' => 'simple',
                'device_filename' => 'simple_{USERNAME}.txt',
                'device_header' => '',
                'device_conf' => '{URL} #Name: {CHANNEL_NAME}',
                'device_footer' => '',
                'default_output' => 2,
                'copy_text' => null,
            ],
            [
                'device_id' => 6,
                'device_name' => 'Octagon',
                'device_key' => 'octagon',
                'device_filename' => 'internettv.feed',
                'device_header' => '',
                'device_conf' => '[TITLE]\\r\\n{CHANNEL_NAME}\\r\\n[URL]\\r\\n{URL}\\r\\n[DESCRIPTION]\\r\\nIPTV\\r\\n[TYPE]\\r\\nLive',
                'device_footer' => '',
                'default_output' => 2,
                'copy_text' => null,
            ],
            [
                'device_id' => 7,
                'device_name' => 'Starlive v3/StarSat HD6060/AZclass',
                'device_key' => 'starlivev3',
                'device_filename' => 'iptvlist.txt',
                'device_header' => '',
                'device_conf' => '{CHANNEL_NAME},{URL}',
                'device_footer' => '',
                'default_output' => 2,
                'copy_text' => null,
            ],
            [
                'device_id' => 8,
                'device_name' => 'MediaStar / StarLive v4',
                'device_key' => 'mediastar',
                'device_filename' => 'tvlist.txt',
                'device_header' => '',
                'device_conf' => '{CHANNEL_NAME} {URL}',
                'device_footer' => '',
                'default_output' => 2,
                'copy_text' => null,
            ],
        ];

        // Insert data in chunks for better performance
        collect($data)->chunk(100)->each(function ($chunk) {
            DB::table('devices')->insert($chunk->toArray());
        });

        // Set AUTO_INCREMENT to next value
        // Reset AUTO_INCREMENT for next insertion
        $maxId = DB::table('devices')->max('id') ?? DB::table('devices')->max(DB::raw('ROWID')) ?? 0;
        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE devices AUTO_INCREMENT = ' . ($maxId + 1));
        }

        Schema::enableForeignKeyConstraints();
    }
}
