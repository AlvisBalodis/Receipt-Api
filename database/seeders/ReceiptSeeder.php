<?php

namespace Database\Seeders;

use App\Models\Receipt;
use Illuminate\Database\Seeder;

class ReceiptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Receipt::factory()
            ->count(5)
            ->hasProducts(5)
            ->create();
    }
}
