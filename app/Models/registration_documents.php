<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['registration_id', 'type', 'path', 'original_filename'])]

class registration_documents extends Model
{
    public function registration(): BelongsTo
    {
        return $this->belongsTo(registrations::class);
    }
}
