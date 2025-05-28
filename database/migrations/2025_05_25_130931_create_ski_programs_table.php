<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('ski_programs', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->string('image_path');
            $table->string('description');
            $table->decimal('price')->nullable();
            $table->string('price_label')->nullable();
            $table->json('details')->nullable();
            $table->json('included_services')->nullable();
            $table->text('how_we_work')->nullable();
            $table->json('gallery')->nullable();
            $table->json('slug');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ski_programs');
    }
};
