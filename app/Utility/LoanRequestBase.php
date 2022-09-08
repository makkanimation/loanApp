<?php

namespace App\Utility;

use App\Models\LoanRequest;
use App\Models\User;

class LoanRequestBase
{
    public function set()
    {
        $base = LoanRequest::when(!User::isAdmin(),function($query){
            $query->havingUser(\Auth::user()->id);
        })
        ->when(request()->filterStatus,function($query){
            $query->havingStatus(request()->filterStatus);
        });
        return $base;

    }
}
