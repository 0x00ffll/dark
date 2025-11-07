<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TranscodingProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Truncate table
        DB::table('transcoding_profiles')->truncate();

        $data = [
            [
                'profile_id' => 1,
                'profile_name' => 'Standard H264 AAC',
                'profile_options' => '{\"-vcodec\":\"h264\",\"-acodec\":\"aac\"}',
            ],
        ];

        // Insert data in chunks for better performance
        collect($data)->chunk(100)->each(function ($chunk) {
            DB::table('transcoding_profiles')->insert($chunk->toArray());
        });

        // Set AUTO_INCREMENT to next value
        // Reset AUTO_INCREMENT for next insertion
        $maxId = DB::table('transcoding_profiles')->max('id') ?? DB::table('transcoding_profiles')->max(DB::raw('ROWID')) ?? 0;
        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE transcoding_profiles AUTO_INCREMENT = ' . ($maxId + 1));
        }

        Schema::enableForeignKeyConstraints();
    }
}
