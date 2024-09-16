<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // function to find all jobs with a tag
    public function jobs() 
    {
        return $this->belongsToMany(Jobs::class, relatedPivotKey: 'jobs_listing_id');
    }
}
