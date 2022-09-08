<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanEmiResource extends JsonResource
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
            'emi_date'                  => $this->emi_date->format('d M Y'),
            'emi_number'                => $this->emi_number,
            'emi_amount'                => $this->emi_amount,
            'rate_of_interest'          => $this->rate_of_interest,
            'remaining_amount'          => $this->remaining_amount,
            'emi_status'                => $this->status==1 ? 'Paid' : 'Not-paid',
            'loan_amount'               => $this->loan_request->loan_amount,
            'loan_requested_date'       => $this->loan_request->created_at->format('d M Y'),
            'loan_approval_date'        => $this->created_at->format('d M Y'),
            'user_name'                 => $this->loan_request->user->name,
            'user_email'                => $this->loan_request->user->email,
            'user_id'                   => $this->loan_request->user->id,
        ];
    }
}
