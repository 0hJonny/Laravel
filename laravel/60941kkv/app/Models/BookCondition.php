<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCondition extends Model
{
    use HasFactory;

    protected $table = 'book_conditions';
    protected $primaryKey = 'condition_id';
    
    protected $fillable = [
        'boook_condition_name',
        'book_condition_description',
    ];

    public function Name()
    {
        return $this->belongsTo(BookWearCoefficient::class, 'boook_condition_name', 'book_wear_coefficient_id');
    }

    public function Copies()
    {
        return $this->hasMany(Copy::class, 'copy_condition_id', 'condition_id');
    }
}
