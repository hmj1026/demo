<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('products_detail')) {
            Schema::create('products_detail', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->collation = 'utf8mb4_unicode_ci';
                $table->bigIncrements('id')->comment('流水號');
                $table->unsignedbigInteger('product_id')->index('products_detail_product_id')->comment('FK product id');
                $table->string('type')->default('intro')->comment('屬性(intro:產品介紹 event:特殊活動)');
                $table->text('content')->nullable()->comment('內容');
                $table->string('comment')->nullable()->comment('備註');
                $table->tinyInteger('valid')->default(1)->comment('有效狀態 (0=無效,1=有效)');
                $table->tinyInteger('status')->default(1)->comment('啟用狀態 (0=禁用,1=啟用)');
                // $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->useCurrent();
                $table->timestamp('created_at')->useCurrent();
            });

            // DB::statement("ALTER TABLE `products_detail` comment'產品細項資料描述表' ");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_detail');
    }
}