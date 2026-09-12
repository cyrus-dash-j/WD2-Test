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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->string('lastname', 50);
            $table->string('firstname', 50);
            $table->string('province', 50);
            $table->string('country', 50);
            $table->string('school', 50);
            $table->string('program', 50);
            $table->unsignedTinyInteger('year')->comment('Year of study');
            $table->date('birthday');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
