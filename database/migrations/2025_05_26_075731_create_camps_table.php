<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('camps', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('slug');
            $table->date('start_date');
            $table->date('end_date');
            $table->json('age_condition');
            $table->json('location');
            $table->string('image_path');
            $table->decimal('latitude');
            $table->decimal('longitude');
            $table->json('price_info');
            $table->json('transport_info');
            $table->json('meal_info');
            $table->json('accommodation_info');
            $table->json('article_content');
            $table->integer('capacity')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('camps');
    }
};
