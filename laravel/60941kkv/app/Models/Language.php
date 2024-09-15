<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $table = 'languages';
    protected $primaryKey = 'language_id';
    
    protected $fillable = [
        'language_name',
        'language_code',
    ];
    

    public function Publications()
    {
        return $this->hasMany(Publication::class, 'publication_language_id', 'language_id');
    }
}
