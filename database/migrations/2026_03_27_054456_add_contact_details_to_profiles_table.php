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
            $table->string('contact_person_name');
            $table->string('contact_person_number');
            $table->string('contact_person_wp_number');
            $table->string('contact_person_email');
            $table->boolean('show_contact_publicly')->default(0)->comment('0 - Yes, 1 - No');
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
