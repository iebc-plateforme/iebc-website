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
        Schema::table('themes', function (Blueprint $table) {
            $table->string('category')->nullable()->after('description');
            $table->string('thumbnail')->nullable()->after('category');
            $table->string('button_style')->nullable()->after('box_shadow');
            $table->string('navbar_style')->nullable()->after('button_style');
            $table->string('card_style')->nullable()->after('navbar_style');
            $table->boolean('is_premium')->default(false)->after('is_default');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('themes', function (Blueprint $table) {
            $table->dropColumn([
                'category',
                'thumbnail',
                'button_style',
                'navbar_style',
                'card_style',
                'is_premium',
            ]);
        });
    }
};
