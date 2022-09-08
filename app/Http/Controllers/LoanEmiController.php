<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utility\LoanEmiBase;
use Carbon\Carbon;
use App\Http\Resources\LoanEmiResource;

use App\Models\LoanEmi;
use App\Models\LoanRequest;

use App\Http\Controllers\TransactionController;
use App\Http\Resources\SingleResourceCollection;
use App\Traits\ApiResponse;

use PDF;
use App\Http\Controllers\MailController;
use App\Mail\SendEMIMail;

class LoanEmiController extends Controller
{
    use ApiResponse;
 
    public function show($filterRequestsId){
        $data = LoanEmiBase::set()
        ->with(['loan_request','loan_request.user'])
        ->paginate(15);

        return LoanEmiResource::collection($data);
    }

    public function createEmis($loanRequest){
        $amount = $loanRequest->loan_amount;
        $rateOfInterest = 12;
        $rate = ($rateOfInterest/100) / 12; // Monthly interest rate
        $term = $loanRequest->num_of_emis; // Term in months

        $emi_amount = $amount * $rate * (pow(1 + $rate, $term) / (pow(1 + $rate, $term) - 1));

        $totalAmount = $emi_amount * $term;

        $emis = [];

        $currentDateTime = Carbon::now();

        LoanEmiBase::set()->havingRequestId($loanRequest->id)
        ->delete();
        for($i=0;$i<$loanRequest->num_of_emis;$i++){
            $emi_num = $i+1;
            $newDateTime = Carbon::now()->addMonths($emi_num)->format('Y-m-d');

            $remainingAmount = $totalAmount - ($emi_amount * $emi_num);
            $emis[] = [
                'loan_requests_id'          => $loanRequest->id,
                'emi_date'                  => $newDateTime,
                'emi_number'                => $emi_num,
                'emi_amount'                => $emi_amount,
                'rate_of_interest'          => $rateOfInterest,
                'remaining_amount'          => $remainingAmount,
                'status'                    => 0,
                'created_at'                => $currentDateTime->format('Y-m-d'),
                'updated_at'                => $currentDateTime->format('Y-m-d'),
            ];
        }

        LoanEmiBase::set()->insert($emis);

        $pdf = PDF::loadView('pdf.emi', ['emis'=>$emis])->save(public_path('pdf/emi_'.$loanRequest->id.'.pdf'));
       
        $email = 'test@gmail.com';
        $maildata = [
            'data' => [
            'title' => 'Congratulations! Your loan has been approved.',
            'body' => 'Congratulations! Your loan has been approved. Please find the attachment of Emis.',
        ],
        'pdf_file' => public_path('pdf/emi_'.$loanRequest->id.'.pdf')
        ];
        MailController::sendMail($email,new SendEMIMail($maildata));
        
        $message = "Dear ".$loanRequest->user->name.", You emi has been succussfully created.";
        return new SingleResourceCollection($this->successResponse($message));

    }

    public function payEmi(LoanEmi $emi,LoanRequest $loanRequest)
    {
        if(\Auth::user()->id==$loanRequest->user_id && $emi->loan_requests_id==$loanRequest->id)
        {
            $emi->status = 1;
            $emi->save();

            $result = (new TransactionController)->create($emi,$loanRequest);

            $response = $result;
            $message = "Dear ".$loanRequest->user->name.", You emi has been succussfully paid.";
            return new SingleResourceCollection($this->successResponse($message));

        }
        $message = "You are not authorized to pay this Emi.";
        return $this->errorResponse($message,$code=422);
    }
}
