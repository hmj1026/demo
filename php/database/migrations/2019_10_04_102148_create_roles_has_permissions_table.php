<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesHasPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('roles_has_permissions')) {
            Schema::create('roles_has_permissions', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->collation = 'utf8mb4_unicode_ci';
                $table->bigIncrements('id')->comment('流水號');
                $table->unsignedMediumInteger('role_id')->default(0)->comment('管理員身分 ID');
                $table->unsignedMediumInteger('permission_id')->default(0)->comment('權限 ID');
            });

            // DB::statement("ALTER TABLE `roles_has_permissions` comment'管理員種類權限列表' ");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_has_permissions');
    }
}
