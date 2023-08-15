<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Blog\Entities\BlogHasCategory;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(BlogHasCategory::TABLE_NAME, function (Blueprint $table) {
            $table->primary([BlogHasCategory::BLOG_ID, BlogHasCategory::BLOG_CATEGORY_ID]);
            $table->unsignedBigInteger(BlogHasCategory::BLOG_ID);
            $table->unsignedBigInteger(BlogHasCategory::BLOG_CATEGORY_ID);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(BlogHasCategory::TABLE_NAME);
    }
};
