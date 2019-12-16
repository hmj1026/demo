<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('permissions')) {
            Schema::create('permissions', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->collation = 'utf8mb4_unicode_ci';
                $table->bigIncrements('id')->comment('流水號');
                $table->string('target')->default('')->comment('對像');
                $table->string('action')->default('')->comment('動作');
                $table->string('authorize')->default('')->comment('授權');
                $table->tinyInteger('valid')->default(1)->comment('有效狀態 (0=無效,1=有效)');
                $table->tinyInteger('status')->default(1)->comment('啟用狀態 (0=禁用,1=啟用)');
                // $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->useCurrent();
                $table->timestamp('created_at')->useCurrent();
            });

            // DB::statement("ALTER TABLE `permissions` comment'權限列表' ");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
