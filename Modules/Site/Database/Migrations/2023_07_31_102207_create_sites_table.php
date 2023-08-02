<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Site\Entities\Site;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Site::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->uuid(Site::UUID)->unique();
            $table->string(Site::NAME);
            $table->string(Site::DOMAIN);
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
        Schema::dropIfExists(Site::TABLE_NAME);
    }
};
