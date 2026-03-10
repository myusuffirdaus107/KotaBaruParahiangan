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
        Schema::table('launchings', function (Blueprint $table) {
            // Add new columns if they don't exist
            if (!Schema::hasColumn('launchings', 'slug')) {
                $table->string('slug')->unique()->nullable()->after('title');
            }
            if (!Schema::hasColumn('launchings', 'location')) {
                $table->string('location')->nullable()->after('description');
            }
            if (!Schema::hasColumn('launchings', 'developer')) {
                $table->string('developer')->nullable()->after('location');
            }
            if (!Schema::hasColumn('launchings', 'launch_date')) {
                $table->date('launch_date')->nullable()->after('developer');
            }
            if (!Schema::hasColumn('launchings', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('launchings', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn(['slug', 'location', 'developer', 'launch_date', 'is_active']);
        });
    }
};
