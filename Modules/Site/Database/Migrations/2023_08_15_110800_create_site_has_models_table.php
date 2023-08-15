<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Site\Entities\SiteHasModel;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(SiteHasModel::TABLE_NAME, function (Blueprint $table) {
            $table->primary([SiteHasModel::SITE_ID, SiteHasModel::MODEL_ID, SiteHasModel::MODEL_TYPE]);
            $table->unsignedBigInteger(SiteHasModel::SITE_ID);
            $table->unsignedBigInteger(SiteHasModel::MODEL_ID);
            $table->string(SiteHasModel::MODEL_TYPE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(SiteHasModel::TABLE_NAME);
    }
};
