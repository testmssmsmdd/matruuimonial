<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {

            $table->unsignedBigInteger('country_id')->nullable()->change();
            $table->unsignedBigInteger('state_id')->nullable()->change();
            $table->unsignedBigInteger('city_id')->nullable()->change();
            $table->renameColumn('user_id', 'created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            //
        });
    }
};
