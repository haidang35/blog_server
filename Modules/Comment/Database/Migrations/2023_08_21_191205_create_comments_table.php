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
        Schema::create(Comment::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(Comment::REPLY_ID)->default(0);
            $table->unsignedBigInteger(Comment::MODEL_ID);
            $table->string(Comment::MODEL_TYPE);
            $table->string(Comment::NAME);
            $table->string(Comment::EMAIL);
            $table->text(Comment::CONTENT);
            $table->string(Comment::WEBSITE)->nullable();
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
        Schema::dropIfExists(Comment::TABLE_NAME);
    }
};
