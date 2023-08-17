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
        Schema::table(ModelHasMedia::TABLE_NAME, function (Blueprint $table) {
            if(!Schema::hasColumn(ModelHasMedia::TABLE_NAME, ModelHasMedia::TYPE)) {
                $table->string(ModelHasMedia::TYPE)->nullable();
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
        Schema::table(ModelHasMedia::TABLE_NAME, function (Blueprint $table) {

        });
    }
};
