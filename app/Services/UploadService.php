<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class UploadService
{
    /**
     * Simpan file ke private storage (tidak bisa diakses langsung via URL).
     * Nama file di-randomize untuk mencegah enumeration.
     */
    public function storePrivate(UploadedFile $file, string $folder): string
    {
        $extension = $file->guessExtension() ?? $file->getClientOriginalExtension();
        $filename  = Str::uuid() . '.' . $extension;

        return $file->storeAs($folder, $filename, 'local');
    }

    /**
     * Simpan file ke public storage (accessible via /storage URL).
     */
    public function storePublic(UploadedFile $file, string $folder): string
    {
        $extension = $file->guessExtension() ?? $file->getClientOriginalExtension();
        $filename  = Str::uuid() . '.' . $extension;

        return $file->storeAs($folder, $filename, 'public');
    }
}
