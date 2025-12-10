<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    protected $fillable = [
        'payment_id',
        'amount',
        'date',
        'type',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

}
