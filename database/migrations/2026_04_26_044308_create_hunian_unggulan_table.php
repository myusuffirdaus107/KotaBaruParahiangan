<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hunian_unggulan', function (Blueprint $table) {
            $table->id();
            $table->string('property_name');
            $table->string('tatar_name')->nullable();
            $table->string('location')->nullable();
            $table->string('image')->nullable();
            $table->string('badge_label')->default('New Launching');
            $table->decimal('cicilan_harga', 8, 1)->nullable(); // dalam juta, contoh: 16.0
            $table->string('cicilan_unit')->default('Juta / bulan');
            $table->string('price_note')->nullable()->default('*Harga dapat berubah sewaktu-waktu');
            $table->json('benefits')->nullable(); // array of {title, value}, max 4
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hunian_unggulan');
    }
};