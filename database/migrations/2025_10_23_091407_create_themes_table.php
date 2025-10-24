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
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('display_name');
            $table->text('description')->nullable();

            // Color palette
            $table->string('primary_color', 7)->default('#1e3a5f'); // Navy blue from logo
            $table->string('secondary_color', 7)->default('#6c757d');
            $table->string('accent_color', 7)->default('#c9a961'); // Gold from logo
            $table->string('success_color', 7)->default('#198754');
            $table->string('warning_color', 7)->default('#ffc107');
            $table->string('danger_color', 7)->default('#dc3545');
            $table->string('info_color', 7)->default('#0dcaf0');
            $table->string('light_color', 7)->default('#f8fafc');
            $table->string('dark_color', 7)->default('#1e293b');

            // Typography
            $table->string('font_family')->default('system-ui');
            $table->string('heading_font_family')->nullable();

            // Additional settings
            $table->string('border_radius')->default('0.375rem');
            $table->string('box_shadow')->default('0 2px 10px rgba(0,0,0,0.1)');

            // Status
            $table->boolean('is_active')->default(false);
            $table->boolean('is_default')->default(false);
            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('themes');
    }
};
