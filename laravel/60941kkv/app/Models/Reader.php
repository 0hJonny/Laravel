<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    use HasFactory;

    protected $table = 'readers';
    protected $primaryKey = 'reader_id';
    
    protected $fillable = [
        'reader_user_id',
        'reader_name',
        'reader_surname',
        'reader_middle_name',
    ];

    public function Loans()
    {
        return $this->hasMany(Loan::class, 'loan_reader_id', 'reader_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'reader_user_id', 'id');
    }
}
