<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Publication extends Model
{
    use HasFactory;

    protected $table = 'publications';
    protected $primaryKey = 'publication_id';
    
    protected $fillable = [
        'publication_title',
        'publication_author',
        'publication_publisher',
        'publication_date',
        'publication_page',
        'publication_ISBN',
        'publication_publication_language',
        'publication_cover',
    ];

    protected $casts = [
        'publication_date' => 'date',
        'publication_page' => 'integer',
        'publication_publication_language' => 'integer',
    ];

    protected $appends = ['cover_url'];

    public function getCoverUrlAttribute()
    {
        if ($this->publication_cover) {
            return Storage::disk('s3')->url($this->publication_cover);
        }
        return Storage::disk('s3')->url('covers/default.png');
    }

    public function Language()
    {
        return $this->belongsTo(Language::class, 'publication_publication_language', 'language_id');
    }

    public function Copies()
    {
        return $this->hasMany(Copy::class, 'copy_publication_id', 'publication_id');
    }
}
