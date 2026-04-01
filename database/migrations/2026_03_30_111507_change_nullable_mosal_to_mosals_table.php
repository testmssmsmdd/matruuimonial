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
        Schema::table('mosals', function (Blueprint $table) {
            $table->string('person_name')->nullable()->change();
            $table->string('contact_number')->nullable()->change();
            $table->dropColumn('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mosals', function (Blueprint $table) {
            //
        });
    }
};
