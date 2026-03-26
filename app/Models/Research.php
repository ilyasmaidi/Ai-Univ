<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Research extends Model
{
    use HasSlug;

    protected $table = 'researches';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'university',
        'faculty',
        'subject',
        'student_name',
        'teacher_name',
        'language',
        'status',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the sections for the research.
     */
    public function sections()
    {
        return $this->hasMany(ResearchSection::class)->orderBy('order');
    }

    /**
     * Get the references for the research.
     */
    public function references()
    {
        return $this->hasMany(Reference::class);
    }

    /**
     * Get the user that owns the research.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
