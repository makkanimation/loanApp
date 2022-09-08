<?php

namespace App\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;

trait ApiResponse
{
    public function validationResponse($validator,$code=422){
        throw new HttpResponseException(response()->json(
        [
         'success'   => false,
         'message'   => 'Validation errors',
         'data'      => $validator->errors()
       ], $code));
    }

    public function errorResponse($message,$code=422){
        throw new HttpResponseException(response()->json(
        [
         'success'   => false,
         'message'   => $message
       ], $code));
    }

    public function successResponse($message,$data=null,$code=201)
    {
        return ["data" => $this->unsetEmpty([
            'status'    => $code,
            'message'   => $message,
            "result"    => $data
            ])
        ];
    }

    public function unsetEmpty($response){
        if(empty($response['result'])){ unset($response['result']); }
        return $response;
    }
}
