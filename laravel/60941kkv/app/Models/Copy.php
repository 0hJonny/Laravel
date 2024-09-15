<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copy extends Model
{
    use HasFactory;

    protected $table = 'copies';
    protected $primaryKey = 'copy_id';
    
    protected $fillable = [
        'copy_inventory_number',
        'copy_publication_id',
        'copy_condition_id',
    ];

    public function Publication()
    {
        return $this->belongsTo(Publication::class, 'copy_publication_id', 'publication_id');
    }

    public function Condition()
    {
        return $this->belongsTo(BookCondition::class, 'copy_condition_id', 'condition_id');
    }

    public function Reader()
    {
        return $this->belongsTo(Reader::class, 'copy_reader_id', 'reader_id');
    }

    public function Loan()
    {
        return $this->hasMany(Loan::class, 'loan_copy_id', 'copy_id');
    }
}
