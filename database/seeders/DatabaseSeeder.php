<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            AccessOutputSeeder::class,
            DevicesSeeder::class,
            MemberGroupsSeeder::class,
            StreamingServersSeeder::class,
            StreamsArgumentsSeeder::class,
            StreamsTypesSeeder::class,
            StreamLogsSeeder::class,
            TranscodingProfilesSeeder::class,
        ]);
    }
}
