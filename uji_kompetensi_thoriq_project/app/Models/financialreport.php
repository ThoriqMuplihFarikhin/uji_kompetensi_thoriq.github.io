<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'income',
        'expenses',
        'amount',
        'description',
    ];
     protected $casts = [
        'date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(student::class);
    }
    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
