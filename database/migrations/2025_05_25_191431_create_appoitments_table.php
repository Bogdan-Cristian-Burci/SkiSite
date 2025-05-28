<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->unsignedInteger('number_of_adults');
            $table->unsignedInteger('number_of_children');
            $table->unsignedInteger('hours_per_day');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('ski_instructor_id')->constrained('ski_instructors');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
