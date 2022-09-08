<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'loan_application_id'       => $this->loan_requests_id,
            'transaction_number'        => $this->transaction_id,
            'payment_method'            => $this->payment_method,
            'payment_date'              => $this->payment_date->format('d M Y'),
            'emi_date'                  => $this->loan_emi->emi_date->format('d M Y'),
            'emi_number'                => $this->loan_emi->emi_number,
            'emi_amount'                => $this->loan_emi->emi_amount,
            'rate_of_interest'          => $this->loan_emi->rate_of_interest,
            'remaining_amount'          => $this->loan_emi->remaining_amount,
            'emi_status'                => $this->loan_emi->status==1 ? 'Paid' : 'Not-paid',
            'loan_amount'               => $this->loan_request->loan_amount,
            'loan_requested_date'       => $this->loan_request->created_at->format('d M Y'),
            'loan_approval_date'        => $this->created_at->format('d M Y'),
            'user_name'                 => $this->loan_request->user->name,
            'user_email'                => $this->loan_request->user->email,
            'user_id'                   => $this->loan_request->user->id,
        ];
    }
}
