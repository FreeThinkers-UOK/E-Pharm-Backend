<?php

namespace Database\Seeders;
use App\Models\PaymentOption;

use Illuminate\Database\Seeder;

class PaymentOptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentOption::create([
            'type'        => 'Paid',

        ]);
        PaymentOption::create([
            'type'        => 'Pending',

        ]);
    }
}
