<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Http\Resources\TransactionResource;

class TransactionController extends Controller
{
    public function index(){
        $data = Transaction::when(!User::isAdmin(),function($query){
            $query->havingUser(\Auth::user()->id);
        })
        ->with(['loan_request','loan_emi','loan_request.user'])
        ->paginate(15);
        
        return TransactionResource::collection($data);
    } 

    public function byUser(User $user){
        $data = Transaction::havingUser($user->id)
        ->with(['loan_request','loan_emi','loan_request.user'])
        ->paginate(15);
        
        return TransactionResource::collection($data);
    } 

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
