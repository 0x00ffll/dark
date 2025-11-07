<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StreamsTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Truncate table
        DB::table('streams_types')->truncate();

        $data = [
            [
                'type_id' => 1,
                'type_name' => 'Live Streams',
                'type_key' => 'live',
                'type_output' => 'live',
                'live' => 1,
            ],
            [
                'type_id' => 2,
                'type_name' => 'Movies',
                'type_key' => 'movie',
                'type_output' => 'movie',
                'live' => 0,
            ],
            [
                'type_id' => 3,
                'type_name' => 'Created Live Channels',
                'type_key' => 'created_live',
                'type_output' => 'live',
                'live' => 1,
            ],
            [
                'type_id' => 4,
                'type_name' => 'Radio',
                'type_key' => 'radio_streams',
                'type_output' => 'live',
                'live' => 1,
            ],
            [
                'type_id' => 5,
                'type_name' => 'TV Series',
                'type_key' => 'series',
                'type_output' => 'series',
                'live' => 0,
            ],
        ];

        // Insert data in chunks for better performance
        collect($data)->chunk(100)->each(function ($chunk) {
            DB::table('streams_types')->insert($chunk->toArray());
        });

        // Set AUTO_INCREMENT to next value
        // Reset AUTO_INCREMENT for next insertion
        $maxId = DB::table('streams_types')->max('id') ?? DB::table('streams_types')->max(DB::raw('ROWID')) ?? 0;
        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE streams_types AUTO_INCREMENT = ' . ($maxId + 1));
        }

        Schema::enableForeignKeyConstraints();
    }
}
