<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(WarehousesTableSeeder::class);
        $this->call(EquipmentsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
