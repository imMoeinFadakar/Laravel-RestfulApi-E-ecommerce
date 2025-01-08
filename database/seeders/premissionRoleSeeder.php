<?php

namespace Database\Seeders;

use App\Models\premissions_roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class premissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        premissions_roles::query()->create([

            'permissions_id' => '1',
            'rolls_id' => '1'

        ]);



    }
}
