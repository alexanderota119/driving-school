<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payment_types = [
            'cash',
            'card',
            'manual',
        ];

        foreach ($payment_types as $payment_type) {
            $find = ['name' => $payment_type];
            PaymentType::firstOrCreate($find, $find);
        }
    }
}
