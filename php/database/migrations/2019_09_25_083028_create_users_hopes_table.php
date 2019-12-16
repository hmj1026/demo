<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersHopesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('users_hopes')) {
            Schema::create('users_hopes', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->collation = 'utf8mb4_unicode_ci';
                $table->bigIncrements('id')->comment('流水號');
                $table->unsignedbigInteger('user_id')->index('users_hopes_user_id')->comment('FK user id');
                $table->unsignedbigInteger('product_id')->comment('FK product id');
                $table->timestamp('created_at')->useCurrent();
            });

            // DB::statement("ALTER TABLE `users_hopes` comment'會員收藏產品' ");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_hopes');
    }
}
