<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('statuses')->insert([
          'name' => 'Open'
        ]);
        DB::table('statuses')->insert([
          'name' => 'Closed'
        ]);
        DB::table('statuses')->insert([
          'name' => 'Archived'
        ]);
    }
}
