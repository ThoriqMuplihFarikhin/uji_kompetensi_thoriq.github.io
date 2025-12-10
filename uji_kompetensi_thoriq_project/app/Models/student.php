<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $fillable = [
        'nis',
        'name',
        'class',
        'status',
    ];

    public $timestamps = true;

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'student_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'student_id', 'id');
    }
}
