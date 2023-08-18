<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Blog\Entities\Blog;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(Blog::TABLE_NAME, function (Blueprint $table) {
            if(!Schema::hasColumn(Blog::TABLE_NAME, Blog::SLUG)) {
                $table->string(Blog::SLUG)->after(Blog::TITLE);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Blog::TABLE_NAME, function (Blueprint $table) {

        });
    }
};
