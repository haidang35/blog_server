<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Blog\Entities\BlogCategory;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(BlogCategory::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->json(BlogCategory::NAME);
            $table->json(BlogCategory::DESCRIPTION)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(BlogCategory::TABLE_NAME);
    }
};
