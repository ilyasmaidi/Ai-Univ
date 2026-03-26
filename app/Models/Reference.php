<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $fillable = [
        'research_id',
        'author',
        'title',
        'year',
        'link',
        'source',
        'citation_style',
    ];

    /**
     * Get the research that owns the reference.
     */
    public function research()
    {
        return $this->belongsTo(Research::class);
    }
}
