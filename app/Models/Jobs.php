<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;
    
    protected $table = 'jobs_listings';
    // protected $fillable = ['title', 'salary'];
    protected $guarded = [];

    // function for finding employer of the job
    public function employer() 
    {
        //Jobs belongs to an employer
        return $this->belongsTo(Employer::class);
    }

    // function for finding tags of the job
    // one tag can belong to one job or many jobs
    // so for both relations belongs to and has many
    // using beongsToMany()
    // Note: belongs to many relationship is 
    // same for both model classes
    public function tags() 
    {
        return $this->belongsToMany(Tag::class, foreignPivotKey: 'jobs_listing_id');
    }
}