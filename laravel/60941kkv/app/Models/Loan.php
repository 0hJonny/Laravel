<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $table = 'loans';
    protected $primaryKey = 'loan_id';
    
    protected $fillable = [
        'loan_reader_id',
        'loan_copy_id',
        'loan_return_date',
    ];

    public function Reader()
    {
        return $this->belongsTo(Reader::class, 'loan_reader_id', 'reader_id');
    }

    public function Copy()
    {
        return $this->belongsTo(Copy::class, 'loan_copy_id', 'copy_id');
    }
}
