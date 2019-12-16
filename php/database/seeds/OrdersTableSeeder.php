<?php

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderShippingDetail;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->truncate();
        DB::table('orders_products')->truncate();
        DB::table('orders_shipping_detail')->truncate();

        factory(Order::class, 10)->states(['applied', 'user_detail_used', 'billing_address_used'])
            ->create()
            ->each(function($order) {

                for ($i=1; $i<3; $i++) {
                    $order->products()->save(factory(OrderProduct::class)->make([
                        'order_id' => $order->id,
                        'product_id' => $i,
                    ]));
                }
                
                $order->detail()->save(factory(OrderShippingDetail::class)->make(['order_id' => $order->id]));
            });
    }
}
