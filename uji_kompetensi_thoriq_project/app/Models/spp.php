<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class spp extends Model
{
    use HasFactory;

    protected $table = 'spp_plans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'amount',
        'period',
    ];

    public $timestamps = true;

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'spp_id', 'id');
    }
}
