<?php

namespace App\Http\Controllers;

use App\Jobs\CheckDbExists;
use App\Jobs\SendEmailJob;

class SendMailController extends Controller
{
    public function SendMail ()
    {
        ignore_user_abort(true); //if page is closed its make it live
            for($i=0;$i<=10000;$i++)
            {
            SendEmailJob::dispatch()->delay(now()->addMinutes(1));
            CheckDbExists::dispatch()->delay(now()->addMinutes(2));
                sleep(120);
            }

    }
}
