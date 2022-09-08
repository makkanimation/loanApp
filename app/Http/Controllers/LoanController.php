<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoanApplicationRequest;

use App\Models\LoanStatus;
use App\Http\Resources\SingleResourceCollection;
use App\Traits\ApiResponse;

use App\Utility\LoanRequestBase;
use App\Http\Resources\LoanRequestResource;
use App\Models\LoanRequest;

use App\Http\Controllers\LoanEmiController;

class LoanController extends Controller
{
    use ApiResponse;

    public function index(){
        $data = LoanRequestBase::set()
        ->with(['user','loan_status'])
        ->paginate(15);

        return LoanRequestResource::collection($data);
    }

    public function requested(LoanApplicationRequest $request)
    {
        $request->merge([
            'user_id' => auth()->user()->id,
            'status'  => LoanStatus::defaultStatus()->getID(),
        ]);
        $response = LoanRequestBase::set()->create($request->all());
        return new SingleResourceCollection($this->successResponse("Your loan request has been successfully filed. Your application number is ".$response->id));
    }

    public function decision(LoanRequest $loanRequest,LoanStatus $loanStatus){
        
        $oldStatus = LoanStatus::HavingId($loanRequest->status)->first();
        if($oldStatus->slug<>LoanStatus::APPROVED){
            $loanRequest->status    = $loanStatus->id;
            $loanRequest->save();
            if($loanStatus->slug==LoanStatus::APPROVED){
                return (new LoanEmiController)->createEmis($loanRequest);
            }
            elseif($loanStatus->slug==LoanStatus::REJECTED){
                return new SingleResourceCollection($this->successResponse("Your loan request number :".$response->id." has been rejected."));
            }
        }
    }

    
}
