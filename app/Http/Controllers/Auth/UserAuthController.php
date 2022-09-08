<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

use App\Http\Resources\SingleResourceCollection;
use App\Traits\ApiResponse;

use App\Http\Controllers\MailController;
use App\Mail\SendRegisterMail;

class UserAuthController extends ApiController
{
    use ApiResponse;

    public function register(RegisterRequest $request)
    {
        $data   =   $request->all();
        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        $token = $user->createToken('authToken')->accessToken;

        $response = [ 'user' => $user->name, 'token' => $token];
        $message = "Dear ".$user->name.", You are successfully registered"; 

        $email = 'test@gmail.com';
        $maildata = [
            'title' => 'Congratulations! You have successfully registered to '.config('app.name'),
            'url' => url('/')
        ];
        MailController::sendMail($email,new SendRegisterMail($maildata));

        return new SingleResourceCollection($this->successResponse($message,$response));
    }

    public function login(LoginRequest $request)
    {
        $data   =   $request->all();
        if (!auth()->attempt($data)) {
            return response(['error_message' => 'Incorrect Details. 
            Please try again']);
        }

        $token = auth()->user()->createToken('authToken')->accessToken;
        
        $response = ['user' => auth()->user()->name, 'token' => $token];
        $message = "Login successfull";
        return new SingleResourceCollection($this->successResponse($message,$response));
    }
}
