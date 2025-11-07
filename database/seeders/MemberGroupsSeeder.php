<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MemberGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Truncate table
        DB::table('member_groups')->truncate();

        $data = [
            [
                'group_id' => 1,
                'group_name' => 'Channel Admin',
                'group_color' => '#FF0000',
                'is_banned' => 0,
                'is_admin' => 1,
                'is_reseller' => 0,
                'total_allowed_gen_trials' => 0,
                'total_allowed_gen_in' => 'day',
                'delete_users' => 0,
                'allowed_pages' => '[\"add_stream\",\"edit_stream\",\"streams\",\"archive\",\"add_movie\",\"edit_movie\",\"import_movies\",\"filexplorer\",\"movies\",\"add_series\",\"series_list\",\"edit_series\",\"add_episode\",\"edit_episode\",\"import_episodes\",\"series\",\"add_radio\",\"edit_radio\",\"radio\",\"create_channel\",\"edit_cchannel\",\"manage_cchannels\",\"mass_sedits\",\"mass_sedits_vod\",\"epg\",\"epg_edit\",\"tprofiles\",\"categories\",\"edit_cat\",\"stream_tools\",\"add_bouquet\",\"edit_bouquet\",\"bouquets\"]',
                'can_delete' => 0,
                'reseller_force_server' => 0,
                'create_sub_resellers_price' => 0,
                'create_sub_resellers' => 0,
                'alter_packages_ids' => 0,
                'alter_packages_prices' => 0,
                'reseller_client_connection_logs' => 0,
                'reseller_assign_pass' => 0,
                'allow_change_pass' => 0,
                'allow_import' => 0,
                'allow_export' => 0,
                'reseller_trial_credit_allow' => 0,
                'edit_mac' => 0,
                'edit_isplock' => 0,
                'reset_stb_data' => 0,
                'reseller_bonus_package_inc' => 0,
                'allow_download' => 1,
            ],
            [
                'group_id' => 2,
                'group_name' => 'Registered Users',
                'group_color' => '#66FF66',
                'is_banned' => 0,
                'is_admin' => 0,
                'is_reseller' => 0,
                'total_allowed_gen_trials' => 0,
                'total_allowed_gen_in' => '',
                'delete_users' => 0,
                'allowed_pages' => '',
                'can_delete' => 0,
                'reseller_force_server' => 0,
                'create_sub_resellers_price' => 0,
                'create_sub_resellers' => 0,
                'alter_packages_ids' => 0,
                'alter_packages_prices' => 0,
                'reseller_client_connection_logs' => 0,
                'reseller_assign_pass' => 0,
                'allow_change_pass' => 0,
                'allow_import' => 0,
                'allow_export' => 0,
                'reseller_trial_credit_allow' => 0,
                'edit_mac' => 0,
                'edit_isplock' => 0,
                'reset_stb_data' => 0,
                'reseller_bonus_package_inc' => 0,
                'allow_download' => 1,
            ],
            [
                'group_id' => 3,
                'group_name' => 'Banned',
                'group_color' => '#194775',
                'is_banned' => 1,
                'is_admin' => 0,
                'is_reseller' => 0,
                'total_allowed_gen_trials' => 0,
                'total_allowed_gen_in' => '',
                'delete_users' => 0,
                'allowed_pages' => '',
                'can_delete' => 0,
                'reseller_force_server' => 0,
                'create_sub_resellers_price' => 0,
                'create_sub_resellers' => 0,
                'alter_packages_ids' => 0,
                'alter_packages_prices' => 0,
                'reseller_client_connection_logs' => 0,
                'reseller_assign_pass' => 0,
                'allow_change_pass' => 0,
                'allow_import' => 0,
                'allow_export' => 0,
                'reseller_trial_credit_allow' => 0,
                'edit_mac' => 0,
                'edit_isplock' => 0,
                'reset_stb_data' => 0,
                'reseller_bonus_package_inc' => 0,
                'allow_download' => 1,
            ],
            [
                'group_id' => 4,
                'group_name' => 'Resellers',
                'group_color' => '#FF9933',
                'is_banned' => 0,
                'is_admin' => 0,
                'is_reseller' => 1,
                'total_allowed_gen_trials' => 100000,
                'total_allowed_gen_in' => 'month',
                'delete_users' => 0,
                'allowed_pages' => '[]',
                'can_delete' => 0,
                'reseller_force_server' => 0,
                'create_sub_resellers_price' => 0,
                'create_sub_resellers' => 1,
                'alter_packages_ids' => 1,
                'alter_packages_prices' => 0,
                'reseller_client_connection_logs' => 1,
                'reseller_assign_pass' => 1,
                'allow_change_pass' => 1,
                'allow_import' => 1,
                'allow_export' => 0,
                'reseller_trial_credit_allow' => 1,
                'edit_mac' => 1,
                'edit_isplock' => 1,
                'reset_stb_data' => 1,
                'reseller_bonus_package_inc' => 0,
                'allow_download' => 1,
            ],
        ];

        // Insert data in chunks for better performance
        collect($data)->chunk(100)->each(function ($chunk) {
            DB::table('member_groups')->insert($chunk->toArray());
        });

        // Set AUTO_INCREMENT to next value
        // Reset AUTO_INCREMENT for next insertion
        $maxId = DB::table('member_groups')->max('id') ?? DB::table('member_groups')->max(DB::raw('ROWID')) ?? 0;
        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE member_groups AUTO_INCREMENT = ' . ($maxId + 1));
        }

        Schema::enableForeignKeyConstraints();
    }
}
