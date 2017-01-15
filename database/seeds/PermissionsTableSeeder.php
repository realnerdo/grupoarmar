<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'servicios',
            'clientes',
            'equipos',
            'marcas',
            'almacenes',
            'mantenimiento',
            'reportes',
            'usuarios',
            'ajustes'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['title' => $permission]);
        }
    }
}
