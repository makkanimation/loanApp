<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\LoanRequest;

class LoanEmi extends Model
{
    use HasFactory;
    
    protected $casts = [
        "emi_date" => "date",
    ];

    public function loan_request()
    {
        return $this->belongsTo(LoanRequest::class, 'loan_requests_id', 'id');
    }

    public function scopeJoinLoanRequest($query)
    {
        $query->leftJoin('loan_requests', function ($join) {
            $join->on('loan_requests.id', '=', 'loan_emis.loan_requests_id');
        });
    }

    public function scopeHavingUser($query,$id)
    {
        $query->where('loan_requests',$id);
    }

    public function scopeHavingId($query,$id)
    {
        $query->where('id',$id);
    }
    
    public function scopeHavingRequestId($query,$id)
    {
        $query->where('loan_requests_id',$id);
    }

}
