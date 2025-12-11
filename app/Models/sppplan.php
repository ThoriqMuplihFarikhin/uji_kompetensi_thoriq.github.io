<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sppplan extends Model
{
    use HasFactory;
    protected $table = 'spp_plans';

    protected $fillable = [
        'amount',
        'period',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
