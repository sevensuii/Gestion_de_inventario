<?php

namespace Database\Seeders;

use App\Models\Aula;
use App\Models\Departamento;
use App\Models\Objeto;
use App\Models\Replica;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Departamento::factory(10)->create();
        User::factory(100)->create();
        Aula::factory(40)->create();
        Objeto::factory(1000)->create();
        Replica::factory(10000)->create();
    }
}
