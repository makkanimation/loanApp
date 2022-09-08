<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
class MailController extends Controller
{
    public static function sendMail($mailTo,$mailTemplate){
        Mail::to($mailTo)->send($mailTemplate);
    }
}
