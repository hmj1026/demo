<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersShippingDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('orders_shipping_detail')) {
            Schema::create('orders_shipping_detail', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->collation = 'utf8mb4_unicode_ci';
                $table->bigIncrements('id')->comment('流水號');
                $table->unsignedbigInteger('order_id')->index('orders_shipping_detail_order_id')->comment('FK order id');
                $table->string('gender')->default('')->comment('性別稱謂');
                $table->string('phone_number')->nullable()->comment('電話號碼');
                $table->string('first_name')->nullable()->comment('收件者名字');
                $table->string('last_name')->nullable()->comment('收件者姓氏');
                $table->string('address')->nullable()->comment('寄送地址');
                $table->string('city')->nullable()->comment('寄送城市');
                $table->string('postcode')->nullable()->comment('寄送郵遞區號');
                $table->string('comment')->nullable()->comment('備註');
                // $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->useCurrent();
                $table->timestamp('created_at')->useCurrent();
            });

            // DB::statement("ALTER TABLE `orders_shipping_detail` comment'銷售訂單寄件細節列表' ");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_shipping_detail');
    }
}
