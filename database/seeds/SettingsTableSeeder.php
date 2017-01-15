<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'title' => 'Grupo Armar',
            'owner' => 'Armar',
            'email' => 'contacto@grupoarmar.com.mx',
            'phone' => '2 86-18-14',
            'address' => 'Calle 22 #220 entre 9 y 11 Col. Montevideo'
        ]);
    }
}
