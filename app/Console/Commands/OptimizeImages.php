<?php

namespace App\Console\Commands;

use App\Support\ImageOptimizer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class OptimizeImages extends Command
{
    protected $signature = 'images:optimize
        {--dry-run : Only report what would be saved, change nothing}
        {--min-kb=300 : Skip files smaller than this}';

    protected $description = 'Shrink existing JPEG/PNG uploads in the public disk (originals are backed up first)';

    public function handle(): int
    {
        // Decoding big photos with GD needs far more RAM than the CLI default.
        @ini_set('memory_limit', '1G');

        $public = Storage::disk('public');
        $backup = Storage::disk('local'); // storage/app/private or storage/app, per config
        $dry = $this->option('dry-run');
        $min = (int) $this->option('min-kb') * 1024;
        $rows = [];
        $saved = 0;

        foreach ($public->allFiles() as $file) {
            if (! preg_match('/\.(jpe?g|png)$/i', $file) || $public->size($file) < $min) {
                continue;
            }

            $path = $public->path($file);
            $before = filesize($path);

            // Dry run works on a temp copy so the real file is never touched.
            $tmp = $dry ? tempnam(sys_get_temp_dir(), 'opt') : null;
            $target = $dry ? $tmp . '.' . pathinfo($file, PATHINFO_EXTENSION) : $path;

            if ($dry) {
                copy($path, $target);
            } else {
                $backup->put("image-backup/{$file}", $public->get($file));
            }

            try {
                ImageOptimizer::optimize($target);
            } catch (\Throwable $e) {
                $this->warn("Skipped {$file}: {$e->getMessage()}");
            }

            clearstatcache(true, $target);
            $after = filesize($target);

            // Wider than the limit yet untouched means GD silently failed (usually memory).
            if ($after === $before && (@getimagesize($target)[0] ?? 0) > 1920) {
                $this->warn("Unchanged but wider than 1920px: {$file} (memory_limit? try -d memory_limit=2G)");
            }

            if ($dry) {
                unlink($target);
                unlink($tmp);
            }

            $saved += $before - $after;
            $rows[] = [$file, round($before / 1024) . ' kB', round($after / 1024) . ' kB'];
        }

        $this->table(['File', 'Before', 'After'], $rows);
        $this->info(($dry ? '[dry-run] Would save ' : 'Saved ') . round($saved / 1048576, 2) . ' MB across ' . count($rows) . ' files.');

        if (! $dry && $rows) {
            $this->line('Originals backed up under the local disk at image-backup/.');
        }

        return self::SUCCESS;
    }
}
