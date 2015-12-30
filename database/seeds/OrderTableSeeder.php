<?php

use BenditaFome\Models\OrderItem;
use Illuminate\Database\Seeder;
use BenditaFome\Models\Order;

/**
 * Class OrderTableSeeder
 */
class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 10)
            ->create()
            ->each(function ($o) {
                for($i = 0; $i < 2; $i++){
                    $o->items()->save(factory(OrderItem::class)->make());
                }
            });
    }
}
