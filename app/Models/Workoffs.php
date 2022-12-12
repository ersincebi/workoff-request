<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Workoffs extends Model
{
    use HasFactory;

    public function Employee(): BelongsTo
    {
        return $this->belongsTo(Employees::class, 'tc_no');
    }
}
