<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ski_instructors', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->json('position');
            $table->string('image_path');
            $table->json('bio');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ski_instructors');
    }
};
