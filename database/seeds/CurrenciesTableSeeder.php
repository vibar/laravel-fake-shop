<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            [
                'code' => 'EUR',
                'symbol' => '€',
                'rate' => 1,
            ], [
                'code' => 'USD',
                'symbol' => '$',
                'rate' => 1,
            ], [
                'code' => 'BRL',
                'symbol' => 'R$',
                'rate' => 1,
            ],
        ]);
    }
}
