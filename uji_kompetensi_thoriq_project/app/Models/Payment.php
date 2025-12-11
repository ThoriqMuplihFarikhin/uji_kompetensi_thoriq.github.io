<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'student_id',
        'amount',
        'payment_date',
        'method',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'payment_id');
    }

    public function invoice()
    {
        return $this->belongsTo(invoice::class, 'invoice_id');
    }
}
