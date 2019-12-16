<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsAttachsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('products_attachs')) {
            // Schema::create('products_attachs', function (Blueprint $table) {
            //     $table->engine = 'InnoDB';
            //     $table->collation = 'utf8mb4_unicode_ci';
            //     $table->bigIncrements('id')->comment('流水號');
            //     $table->unsignedbigInteger('product_id')->index('product_id')->comment('FK product id');
            //     $table->string('attach_type')->default('image')->comment('附件類別 ex: video 或 image');
            //     $table->string('attach_kind')->default('file')->comment('附件種類 ex: file 或 link');
            //     $table->string('attach_flag')->default('')->comment('附件用途 ex: carousel 或 desc');
            //     $table->string('attach_src')->default('')->comment('檔案連結');
            //     $table->string('attach_name')->default('')->comment('檔案名稱');
            //     $table->tinyInteger('is_cover')->default(0)->comment('是否為產品封面照片');
            //     $table->string('comment')->default('')->comment('備註');
            //     $table->tinyInteger('valid')->default(1)->comment('有效狀態 (0=無效,1=有效)');
            //     $table->tinyInteger('status')->default(1)->comment('啟用狀態 (0=禁用,1=啟用)');
            //     $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            //     $table->timestamp('created_at')->useCurrent();
            // });

            // DB::statement("ALTER TABLE `products_attachs` comment '產品附件' ");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_attachs');
    }
}
