<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employees extends Model
{
    use HasFactory;

    public function Workoffs(): HasMany
    {
        return $this->hasMany(Workoffs::class, 'tc_no');
    }
}
