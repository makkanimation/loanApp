<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanStatus extends Model
{
    const APPROVED     = 'approved';
    const REJECTED     = 'rejected';
    const PENDING     = 'pending';

    use HasFactory;
    protected $table = 'loan_status';

    public function defaultStatus(){
        return self::havingStatus('pending')
        ->first();
    }

    public function getID(){
        return $this->id;
    }

    public function scopeHavingStatus($query,$slug)
    {
        $query->where('slug',$slug);
    }

    public function scopeHavingId($query,$id)
    {
        $query->where('id',$id);
    }
}
