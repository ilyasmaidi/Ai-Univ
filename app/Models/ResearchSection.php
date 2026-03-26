<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResearchSection extends Model
{
    protected $fillable = [
        'research_id',
        'title',
        'content',
        'order',
        'type',
    ];

    /**
     * Get the research that owns the section.
     */
    public function research()
    {
        return $this->belongsTo(Research::class);
    }
}
