<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('users_detail')) {
            Schema::create('users_detail', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->collation = 'utf8mb4_unicode_ci';
                $table->bigIncrements('id')->comment('流水號');
                $table->unsignedbigInteger('user_id')->index('user_id')->comment('FK user id');
                $table->string('gender')->default('')->comment('性別稱謂');
                $table->string('first_name')->default('')->comment('名字');
                $table->string('last_name')->default('')->comment('姓氏');
                $table->string('billing_address')->default('')->comment('帳單地址');
                // $table->string('billing_dist')->default('')->comment('帳單區域');
                $table->string('billing_city')->default('')->comment('帳單城市');
                $table->string('billing_postcode')->default('')->comment('帳單郵遞區號');
                $table->string('country_code')->default('TW')->comment('國碼');
                $table->string('phone_number')->default('')->comment('電話號碼');
                // $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->useCurrent();
                $table->timestamp('created_at')->useCurrent();
            });

            // DB::statement("ALTER TABLE `users_detail` comment'會員資料' ");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_detail');
    }
}
