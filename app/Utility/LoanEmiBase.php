<?php

namespace App\Utility;

use App\Models\LoanEmi;
use App\Models\User;

class LoanEmiBase
{
    public function set()
    {
        $base = LoanEmi::when(!User::isAdmin(),function($query){
            $query->JoinLoanRequest()
            ->havingUser(\Auth::user()->id);
        })
        ->when(request()->filterRequestsId,function($query){
            $query->havingRequestId(request()->filterRequestsId);
        });
        return $base;

    }
}
