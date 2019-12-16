<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('users_equipments')) {
            Schema::create('users_equipments', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->collation = 'utf8mb4_unicode_ci';
                $table->bigIncrements('id')->comment('流水號');
                $table->unsignedbigInteger('user_id')->index('users_equipments__user_id')->comment('FK user id');
                $table->unsignedbigInteger('product_id')->comment('FK product id');
                $table->string('serial_number')->default('')->comment('序號');
                $table->timestamp('warranty_valid_to')->nullable()->comment('保固到期');
                $table->tinyInteger('valid')->default(1)->comment('有效狀態 (0=無效,1=有效)');
                $table->tinyInteger('status')->default(1)->comment('啟用狀態 (0=禁用,1=啟用)');
                // $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->useCurrent();
                $table->timestamp('created_at')->useCurrent();
            });

            // DB::statement("ALTER TABLE `users_equipments` comment'會員擁有產品' ");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_products');
    }
}
