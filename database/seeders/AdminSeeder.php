<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Check if admin user already exists
        $adminExists = DB::table('users')->where('email', 'admin@admin.com')->exists();
        
        if (!$adminExists) {
            DB::table('users')->insert([
                'name' => 'Administrator',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            echo "Admin user created successfully!\n";
            echo "Email: admin@admin.com\n";
            echo "Password: admin123\n";
        } else {
            echo "Admin user already exists.\n";
        }

        Schema::enableForeignKeyConstraints();
    }
}
