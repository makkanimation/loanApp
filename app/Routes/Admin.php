<?php

namespace App\Routes;

use Illuminate\Support\Facades\Route;

class Admin
{
    public static function routes()
    {
        Route::post('show-emis/{filterRequestsId}', 'LoanEmiController@show');
        
        Route::post('loan-request-decision/{loanRequest}/{loanStatus}', 'LoanController@decision');
        
        Route::post('loan-requested/{filterStatus?}', 'LoanController@index');

    }
}