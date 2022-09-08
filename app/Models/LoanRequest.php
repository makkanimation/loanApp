<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\LoanStatus;

class LoanRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'loan_amount',
        'num_of_emis',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function loan_status()
    {
        return $this->belongsTo(LoanStatus::class, 'status', 'id');
    }

    public function scopeHavingId($query,$id)
    {
        $query->where('id',$id);
    }

    public function scopeHavingUser($query,$userID)
    {
        $query->where('user_id',$userID);
    }

    public function scopeHavingStatus($query,$status)
    {
        $query->where('status',$status);
    }

}
