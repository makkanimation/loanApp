<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function create($emiRequest,$loanrequest){

        $transaction = Transaction::create([
            'loan_emis_id'          =>  $emiRequest->id,
            'loan_requests_id'      =>  $loanrequest->id,
            'transaction_id'        =>  random_int(100000, 999999),
            'users_id'              =>  $loanrequest->user_id,
            'payment_method'        =>  "Credit Card",
            'payment_date'          =>  date("Y-m-d"),
        ]);
        return $transaction;
    }
}
