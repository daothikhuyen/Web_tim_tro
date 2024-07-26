<?php

namespace App\Http\Service\Contact;

use App\Jobs\SendMail_Contact;

class SendContact_Service {

    public function send_contact($email,$username,$content){
        SendMail_Contact::dispatch($email,$username,$content);

        return true;
    }
}
