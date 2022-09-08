<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanRequestResource extends JsonResource
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
            'loan_amount'       => $this->loan_amount,
            'num_of_emis'       => $this->num_of_emis,
            'loan_status'       => $this->loan_status->display_name,
            'user_id'           => $this->user->id,
            'user_name'         => $this->user->name,
            'user_email'        => $this->user->email,
            'creation_date'     => $this->created_at->format('d M Y'),
        ];
    }
}
