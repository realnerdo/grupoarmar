<?php

use Illuminate\Database\Seeder;
use App\Client;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
            'name' => 'Juan Pérez',
            'phone' => '9999999999',
            'email' => 'juan@mail.com',
            'company' => 'Empresa de Juan',
            'trade_name' => 'Juan Inc.',
            'rfc' => 'CUPU800825569',
            'address' => 'Calle 3C #284 por 20A Residencial Galerías',
            'zipcode' => '97204'
        ]);
    }
}
