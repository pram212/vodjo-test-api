<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $today = date("Ymd");

        for ($i = 1; $i <= 5000; $i++) {
            $sequence = str_pad($i, 5, '0', STR_PAD_LEFT); // 0001, 0002, ...
            $invoiceNumber = 'INV' . $today . $sequence;

            Order::factory()
                ->hasOrderProducts(4) // Create 5 order products for each order
                ->create(['order_no' => $invoiceNumber]);
        }
    }
}
