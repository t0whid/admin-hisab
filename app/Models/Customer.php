<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name', 'address', 'father_name', 'phone', 'email', 'amount', 'image', 'status', 'age'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
