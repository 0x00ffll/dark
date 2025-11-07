<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AccessOutputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Truncate table
        DB::table('access_output')->truncate();

        $data = [
            [
                'access_output_id' => 1,
                'output_name' => 'HLS',
                'output_key' => 'm3u8',
                'output_ext' => 'm3u8',
            ],
            [
                'access_output_id' => 2,
                'output_name' => 'MPEGTS',
                'output_key' => 'ts',
                'output_ext' => 'ts',
            ],
            [
                'access_output_id' => 3,
                'output_name' => 'RTMP',
                'output_key' => 'rtmp',
                'output_ext' => '',
            ],
        ];

        // Insert data in chunks for better performance
        collect($data)->chunk(100)->each(function ($chunk) {
            DB::table('access_output')->insert($chunk->toArray());
        });

        // Set AUTO_INCREMENT to next value
        // Reset AUTO_INCREMENT for next insertion
        $maxId = DB::table('access_output')->max('id') ?? DB::table('access_output')->max(DB::raw('ROWID')) ?? 0;
        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE access_output AUTO_INCREMENT = ' . ($maxId + 1));
        }

        Schema::enableForeignKeyConstraints();
    }
}
