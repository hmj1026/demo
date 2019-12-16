<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->collation = 'utf8mb4_unicode_ci';
                $table->bigIncrements('id')->comment('流水號');
                $table->unsignedbigInteger('user_id')->index('orders_user_id')->comment('FK user id');
                $table->unsignedbigInteger('cashflow_id')->index('orders_cashflow_id')->comment('FK cashflow id');
                $table->boolean('is_applied')->default(false)->comment('是否活動碼 (0=否,1=是)');
                $table->boolean('is_charged')->default(false)->comment('是否已付費 (0=否,1=是)');
                $table->boolean('is_shipped')->default(false)->comment('是否已寄出 (0=否,1=是)');
                $table->boolean('is_user_detail_used')->default(false)->comment('是否收件人同會員資訊 (0=否,1=是)');
                $table->boolean('is_billing_address_used')->default(false)->comment('是否使用帳單地址配送 (0=否,1=是)');
                $table->float('origin_amount', 8, 2)->default(false)->comment('訂單原始總價');
                $table->float('retail_amount', 8, 2)->default(false)->comment('訂單最後總價');
                $table->unsignedbigInteger('event_id')->index('orders_event_id')->comment('FK event id');
                $table->text('event_content_backup')->nullable()->comment('活動碼內容');
                $table->string('comment')->nullable()->comment('備註');
                $table->boolean('valid')->default(true)->comment('有效狀態 (0=無效,1=有效)');
                $table->boolean('status')->default(true)->comment('啟用狀態 (0=禁用,1=啟用)');
                // $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->useCurrent();
                $table->timestamp('created_at')->useCurrent();
            });

            // DB::statement("ALTER TABLE `orders` comment'銷售訂單列表' ");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
