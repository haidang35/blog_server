<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {
            if(!Schema::hasColumn('permissions', 'module')) {
                $table->string('module')->nullable()->after('guard_name');
            }
            if(!Schema::hasColumn('permissions', 'description')) {
                $table->text('description')->nullable()->after('module');
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
        Schema::table('permissions', function (Blueprint $table) {

        });
    }
};
