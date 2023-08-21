<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Comment\Entities\Comment;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(Comment::TABLE_NAME, function (Blueprint $table) {
            if(!Schema::hasColumn(Comment::TABLE_NAME, Comment::PARENT_ID)) {
                $table->unsignedBigInteger(Comment::PARENT_ID)
                    ->after(Comment::ID)
                    ->default(0);
            }
            if(!Schema::hasColumn(Comment::TABLE_NAME, Comment::TOTAL_LIKE)) {
                $table->integer(Comment::TOTAL_LIKE)
                    ->after(Comment::REPLY_ID)
                    ->default(0);
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
        Schema::table(Comment::TABLE_NAME, function (Blueprint $table) {

        });
    }
};
