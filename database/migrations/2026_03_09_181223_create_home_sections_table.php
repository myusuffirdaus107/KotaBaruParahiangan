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
        if (!Schema::hasTable('home_sections')) {
            Schema::create('home_sections', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('title_mobile')->nullable();
                $table->text('subtitle')->nullable();
                $table->string('image')->nullable();
                $table->string('image_mobile')->nullable();
                $table->string('button_text')->nullable();
                $table->string('button_link')->nullable();
                $table->integer('display_order')->default(0);
                $table->boolean('status')->default(true);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_sections');
    }
};
