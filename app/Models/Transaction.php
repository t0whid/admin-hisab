<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'type',
        'amount',
        'description',
        'updated_by',
        'total_amount',
        'last_transaction',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
