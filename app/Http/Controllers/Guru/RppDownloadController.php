<?php

namespace App\Http\Controllers\Guru;

use App\Models\Rpp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RppDownloadController
{
    public function download(Request $request, int $rpp): BinaryFileResponse
    {
        $rppModel = Rpp::forUser(Auth::id())->findOrFail($rpp);

        return response()->download(
            Storage::disk('public')->path($rppModel->file_path),
            $rppModel->original_filename,
        );
    }
}
