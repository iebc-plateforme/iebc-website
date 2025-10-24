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
        Schema::table('teams', function (Blueprint $table) {
            $table->string('linkedin_url')->nullable()->after('bio');
            $table->string('twitter_url')->nullable()->after('linkedin_url');
            $table->string('facebook_url')->nullable()->after('twitter_url');
            $table->string('instagram_url')->nullable()->after('facebook_url');
            $table->string('github_url')->nullable()->after('instagram_url');
            $table->string('website_url')->nullable()->after('github_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn([
                'linkedin_url',
                'twitter_url',
                'facebook_url',
                'instagram_url',
                'github_url',
                'website_url'
            ]);
        });
    }
};
