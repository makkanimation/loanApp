<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_emis_id',
        'loan_requests_id',
        'transaction_id',
        'users_id',
        'payment_method',
        'payment_date',
    ];

}
