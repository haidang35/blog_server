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
        Schema::create(\Modules\Blog\Entities\Blog::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->json(Blog::TITLE);
            $table->json(Blog::CONTENT);
            $table->unsignedBigInteger(Blog::CREATED_BY)->default(0);
            $table->unsignedBigInteger(Blog::UPDATED_BY)->default(0);
            $table->unsignedBigInteger(Blog::DELETED_BY)->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\Modules\Blog\Entities\Blog::TABLE_NAME);
    }
};
