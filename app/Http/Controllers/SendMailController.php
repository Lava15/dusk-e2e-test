<?php

namespace App\Http\Controllers;

use App\Jobs\CheckDbExists;
use App\Jobs\SendEmailJob;

class SendMailController extends Controller
{
    public function SendMail ()
    {
        SendEmailJob::dispatch()->delay(1);
        CheckDbExists::dispatch()->delay(now()->addMinutes(2));
        dd("Sent successfully");
    }
}
