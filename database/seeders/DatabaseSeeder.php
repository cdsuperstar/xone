<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * 系统
     * docker-compose exec postgres pg_dump -O -x -a --column-inserts xone -U default -t oauth_clients -t users -t z_modules -t z_userprofiles -t roles -t role_z_module -t z_units -t model_has_roles -t permissions -t model_has_permissions -t user_z_unit -t media >../xone/database/seeders/dump.sql
     * xapp1s1业务
     * ocker-compose exec postgres pg_dump -O -x -a --column-inserts xone -U default -t xapp1s1categs -t xapp1s1profiles -t xapp1s1profiles -t xapp1s1shops  >>../xone/database/seeders/dump.sql
     *
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $sql_file = base_path('database/seeders/dump.sql');

        DB::unprepared(file_get_contents($sql_file));

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
