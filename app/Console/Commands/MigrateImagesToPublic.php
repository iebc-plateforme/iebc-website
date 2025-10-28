<?php

namespace App\Console\Commands;

use App\Helpers\ImageHelper;
use App\Models\Partner;
use App\Models\Team;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MigrateImagesToPublic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:migrate-to-public {--dry-run : Run without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate images from storage/app/public to public/uploads';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');

        if ($dryRun) {
            $this->warn('🔍 DRY RUN MODE - No changes will be made');
        } else {
            $this->info('🚀 Starting image migration...');
        }

        $this->newLine();

        $stats = [
            'partners' => $this->migratePartners($dryRun),
            'teams' => $this->migrateTeams($dryRun),
            'posts' => $this->migratePosts($dryRun),
            'galleries' => $this->migrateGalleries($dryRun),
            'services' => $this->migrateServices($dryRun),
            'settings' => $this->migrateSettings($dryRun),
        ];

        $this->newLine();
        $this->info('📊 Migration Summary:');
        $this->table(
            ['Model', 'Migrated', 'Skipped', 'Failed'],
            [
                ['Partners', $stats['partners']['success'], $stats['partners']['skipped'], $stats['partners']['failed']],
                ['Teams', $stats['teams']['success'], $stats['teams']['skipped'], $stats['teams']['failed']],
                ['Posts', $stats['posts']['success'], $stats['posts']['skipped'], $stats['posts']['failed']],
                ['Galleries', $stats['galleries']['success'], $stats['galleries']['skipped'], $stats['galleries']['failed']],
                ['Services', $stats['services']['success'], $stats['services']['skipped'], $stats['services']['failed']],
                ['Settings', $stats['settings']['success'], $stats['settings']['skipped'], $stats['settings']['failed']],
            ]
        );

        if ($dryRun) {
            $this->newLine();
            $this->info('💡 Run without --dry-run to apply changes');
        } else {
            $this->newLine();
            $this->info('✅ Migration completed!');
        }

        return 0;
    }

    private function migratePartners($dryRun)
    {
        $this->info('📦 Migrating Partners...');
        return $this->migrateModel(Partner::class, 'logo', 'partners', $dryRun);
    }

    private function migrateTeams($dryRun)
    {
        $this->info('👥 Migrating Teams...');
        return $this->migrateModel(Team::class, 'photo', 'teams', $dryRun);
    }

    private function migratePosts($dryRun)
    {
        $this->info('📝 Migrating Posts...');
        return $this->migrateModel(Post::class, 'image', 'posts', $dryRun);
    }

    private function migrateGalleries($dryRun)
    {
        $this->info('🖼️  Migrating Galleries...');
        return $this->migrateModel(Gallery::class, 'file_path', 'galleries', $dryRun);
    }

    private function migrateServices($dryRun)
    {
        $this->info('🛠️  Migrating Services...');
        return $this->migrateModel(Service::class, 'icon', 'icons', $dryRun);
    }

    private function migrateSettings($dryRun)
    {
        $this->info('⚙️  Migrating Settings...');
        $success = 0;
        $skipped = 0;
        $failed = 0;

        // Migrate company logo
        $logo = Setting::get('company_logo');
        if ($logo && Str::startsWith($logo, 'settings/')) {
            $result = $this->migrateSingleImage($logo, 'settings', $dryRun);
            if ($result['success']) {
                if (!$dryRun) {
                    Setting::set('company_logo', $result['newPath'], 'file');
                }
                $success++;
                $this->line("  ✓ Migrated company_logo");
            } elseif ($result['skipped']) {
                $skipped++;
            } else {
                $failed++;
                $this->error("  ✗ Failed to migrate company_logo");
            }
        } else {
            $skipped++;
        }

        // Migrate favicon
        $favicon = Setting::get('site_favicon');
        if ($favicon && Str::startsWith($favicon, 'settings/')) {
            $result = $this->migrateSingleImage($favicon, 'settings', $dryRun);
            if ($result['success']) {
                if (!$dryRun) {
                    Setting::set('site_favicon', $result['newPath'], 'file');
                }
                $success++;
                $this->line("  ✓ Migrated site_favicon");
            } elseif ($result['skipped']) {
                $skipped++;
            } else {
                $failed++;
                $this->error("  ✗ Failed to migrate site_favicon");
            }
        } else {
            $skipped++;
        }

        return compact('success', 'skipped', 'failed');
    }

    private function migrateModel($modelClass, $field, $directory, $dryRun)
    {
        $items = $modelClass::whereNotNull($field)->get();
        $success = 0;
        $skipped = 0;
        $failed = 0;

        foreach ($items as $item) {
            $oldPath = $item->$field;

            // Skip if already migrated (starts with uploads/)
            if (Str::startsWith($oldPath, 'uploads/')) {
                $skipped++;
                continue;
            }

            // Only migrate if it starts with the expected directory
            $expectedPrefix = $directory === 'icons' ? 'icons/' : $directory . '/';
            if (!Str::startsWith($oldPath, $expectedPrefix)) {
                $skipped++;
                continue;
            }

            $result = $this->migrateSingleImage($oldPath, $directory, $dryRun);

            if ($result['success']) {
                if (!$dryRun) {
                    $item->$field = $result['newPath'];
                    $item->save();
                }
                $success++;
                $this->line("  ✓ Migrated {$modelClass}#{$item->id}");
            } elseif ($result['skipped']) {
                $skipped++;
            } else {
                $failed++;
                $this->error("  ✗ Failed to migrate {$modelClass}#{$item->id}");
            }
        }

        return compact('success', 'skipped', 'failed');
    }

    private function migrateSingleImage($oldPath, $directory, $dryRun)
    {
        $sourcePath = storage_path('app/public/' . $oldPath);

        // Source doesn't exist
        if (!file_exists($sourcePath)) {
            return ['success' => false, 'skipped' => true, 'newPath' => null];
        }

        // Already in new location
        if (Str::startsWith($oldPath, 'uploads/')) {
            return ['success' => false, 'skipped' => true, 'newPath' => $oldPath];
        }

        if ($dryRun) {
            return ['success' => true, 'skipped' => false, 'newPath' => "uploads/{$directory}/" . basename($oldPath)];
        }

        // Perform migration
        $newPath = ImageHelper::migrateToPublic($oldPath, $directory);

        if ($newPath) {
            return ['success' => true, 'skipped' => false, 'newPath' => $newPath];
        }

        return ['success' => false, 'skipped' => false, 'newPath' => null];
    }
}
