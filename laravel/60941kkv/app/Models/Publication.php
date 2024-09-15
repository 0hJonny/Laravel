<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $table = 'publications';
    protected $primaryKey = 'publication_id';
    
    protected $fillable = [
        'publication_title',
        'publication_author',
        'publication_publisher',
        'publication_publication_date',
        'publication_publication_language',
        'publication_publication_pages',
        'publication_ISBN',
    ];

    public function Language()
    {
        return $this->belongsTo(Language::class, 'publication_publication_language', 'language_id');
    }

    public function Copies()
    {
        return $this->hasMany(Copy::class, 'copy_publication_id', 'publication_id');
    }
}
