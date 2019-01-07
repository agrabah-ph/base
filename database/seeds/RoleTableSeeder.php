<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'owner']);
        Role::create(['name' => 'client']);
        Role::create(['name' => 'vendor']);
        Role::create(['name' => 'mod']);
    }
}
