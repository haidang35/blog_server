<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Media\Entities\ModelHasMedia;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(ModelHasMedia::TABLE_NAME, function (Blueprint $table) {
            $table->primary([ModelHasMedia::MODEL_TYPE, ModelHasMedia::MODEL_ID, ModelHasMedia::MEDIA_ID]);
            $table->string(ModelHasMedia::MODEL_TYPE);
            $table->unsignedBigInteger(ModelHasMedia::MODEL_ID);
            $table->unsignedBigInteger(ModelHasMedia::MEDIA_ID);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(ModelHasMedia::TABLE_NAME);
    }
};
