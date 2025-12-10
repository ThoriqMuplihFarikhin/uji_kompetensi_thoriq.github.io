<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{

    use HasFactory;

    protected $table = 'invoices';
    protected $primaryKey = 'id';
    protected $fillable = [
        'student_id',
        'spp_id',
        'period',
        'amount',
        'status',
    ];

    public $timestamps = true;

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function spp()
    {
        return $this->belongsTo(Spp::class, 'spp_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'invoice_id', 'id');
    }
}
