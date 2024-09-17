<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employer extends Model
{
    use HasFactory;

    //function to find jobs posted by an employer
    public function jobs()
    {
        //Employer has many job postings
        return $this->hasMany(Jobs::class);
    }

    public function user(): BelongsTo
    {
        //employer belongs to user
        return $this->belongsTo(User::class);
    }
}
