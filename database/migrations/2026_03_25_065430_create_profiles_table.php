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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->enum('gender', ['Male', 'Female']);
            $table->date('date_of_birth');
            $table->string('age');
            $table->string('birth_time');
            $table->string('birth_place');
            $table->string('height');
            $table->integer('Weight');
            $table->enum('marital_status', ['Never_Married', 'Divorced', 'Widowed', 'Mithi_Jibh_Cancel', 'Broken_Engagement']);
            $table->string('moother_tounge');
            $table->string('rashi');
            $table->string('caste')->nullable();
            $table->string('gotra')->nullable();
            $table->enum('manglik', ['Yes', 'No', "Don\'t Know"])->nullable();
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            $table->foreignId('state_id')->constrained()->onDelete('cascade');
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->text('current_address')->nullable();
            $table->string('education')->nullable();
            $table->string('occupation')->nullable();
            $table->string('company_name')->nullable();
            $table->string('annual_income')->nullable();
            $table->string('work_location')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->integer('no_of_brothers')->default(0);
            $table->integer('no_of_sisters')->default(0);
            $table->enum('family_type', ['Joint', 'Nuclear'])->nullable();
            $table->string('hobbies')->nullable();
            $table->text('about_me')->nullable();
            $table->boolean('profile_status')->default(0)->comment('0-Inactive, 1-Active');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('step_completed')->default(0);
            $table->boolean('profile_completed')->default(0)->comment('0-Incomplete, 1-Complete');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
