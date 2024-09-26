<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCondition extends Model
{
    use HasFactory;

    protected $table = 'book_conditions';
    protected $primaryKey = 'book_condition_id';
    
    protected $fillable = [
        'book_condition_name',
        'book_condition_description',
    ];

    public function Name()
    {
        return $this->belongsTo(BookWearCoefficient::class, 'book_condition_name', 'book_wear_coefficient_id');
    }

    public function Copies()
    {
        return $this->hasMany(Copy::class, 'copy_condition_id', 'book_condition_id');
    }
}
