<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\SeoMeta\Entities\SEOMeta;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(SEOMeta::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(SEOMeta::MODEL_ID)->index();
            $table->string(SEOMeta::MODEL_TYPE)->index();
            $table->json(SEOMeta::META_TITLE)->nullable();
            $table->json(SEOMeta::META_DESCRIPTION)->nullable();
            $table->json(SEOMeta::META_KEYWORDS)->nullable();
            $table->json(SEOMeta::META_ROBOTS)->nullable();
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
        Schema::dropIfExists(SEOMeta::TABLE_NAME);
    }
};
