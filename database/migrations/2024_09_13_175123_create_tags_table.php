<?php

use App\Models\Jobs;
use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // A pivot table that reflects one-to-many relationship
        // between job and tags.
        Schema::create('jobs_tag', function (Blueprint $table) {
            $table->id();
            //to avoid conflict with laravel buit in jobs table
            //specifying the column in 2nd parameter
            $table->foreignIdFor(Jobs::class, 'jobs_listing_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Tag::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('jobs_tag');
    }
};
