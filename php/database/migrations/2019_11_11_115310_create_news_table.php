<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('news')) {
            Schema::create('news', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->collation = 'utf8mb4_unicode_ci';
                $table->bigIncrements('id')->comment('流水號');
                $table->string('type')->default('news')->comment('屬性(news:最新消息 event:活動訊息 article:推薦文章)');
                $table->string('title')->default('')->comment('標題');
                $table->string('sub_title')->nullable()->comment('副標題');
                $table->text('content')->nullable()->comment('內容');
                $table->string('comment')->nullable()->comment('備註');
                $table->tinyInteger('valid')->default(1)->comment('有效狀態 (0=無效,1=有效)');
                $table->tinyInteger('status')->default(1)->comment('啟用狀態 (0=禁用,1=啟用)');
                // $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->useCurrent();
                $table->timestamp('created_at')->useCurrent();
            });

            // DB::statement("ALTER TABLE `news` comment'新聞公告列表' ");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
