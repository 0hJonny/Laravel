<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookWearCoefficient extends Model
{
    use HasFactory;

    protected $table = 'book_wear_coefficients';
    protected $primaryKey = 'book_wear_coefficient_id';
    
    protected $fillable = [
        'book_wear_coefficient_name',
        'book_wear_coefficient_order',
    ];

    public function BookConditions()
    {
        return $this->hasMany(BookCondition::class, 'book_condition_name', 'book_wear_coefficient_id');
    }
}
