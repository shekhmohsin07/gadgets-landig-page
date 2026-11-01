<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * Saves uploaded images straight into public/uploads so no "storage:link" is needed
 * (works on shared hosting too). Paths are stored relative to /public.
 */
class Upload
{
    public static function image(UploadedFile $file, string $dir): string
    {
        $ext = strtolower($file->guessExtension() ?: $file->getClientOriginalExtension() ?: 'jpg');
        $name = now()->format('ymd-His') . '-' . Str::lower(Str::random(8)) . '.' . $ext;
        $target = public_path('uploads/' . $dir);
        if (! is_dir($target)) {
            mkdir($target, 0755, true);
        }
        $file->move($target, $name);

        return 'uploads/' . $dir . '/' . $name;
    }

    /** @param UploadedFile[] $files */
    public static function images(array $files, string $dir): array
    {
        $out = [];
        foreach ($files as $file) {
            if ($file instanceof UploadedFile && $file->isValid()) {
                $out[] = self::image($file, $dir);
            }
        }

        return $out;
    }

    /** Only ever deletes files that live inside public/uploads. */
    public static function delete(?string $path): void
    {
        if ($path && str_starts_with($path, 'uploads/') && ! str_contains($path, '..')) {
            $full = public_path($path);
            if (is_file($full)) {
                @unlink($full);
            }
        }
    }
}
