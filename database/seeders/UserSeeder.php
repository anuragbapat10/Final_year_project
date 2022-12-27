<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::factory()->count(5)->create();
        
        DB::table('users_organizations')->updateOrInsert([
            'user_id' => 1,
            'organization_id' => 1,
        ]);
        DB::table('users_organizations')->updateOrInsert([
            'user_id' => 1,
            'organization_id' => 2,
        ]);
    }
}
