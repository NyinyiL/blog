<?php

namespace App\Http\Controllers;

use App\Mail\HelloMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail() {
        $fromEmail = "nlwin1098@gmail.com" ;
        Mail::to($fromEmail)->send(new HelloMail) ;
        // if (Mail::failures() != 0) {
        // }
        // return "Oops! There was some error sending the email.";
        return "Email has been sent successfully.";

    }
}
