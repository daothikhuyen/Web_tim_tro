<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Service\Contact\SendContact_Service;
use Illuminate\Http\Request;

class SendContact extends Controller
{
    protected $sendContact_Service;

    public function __construct(SendContact_Service $sendContact_Service)
    {
        $this->sendContact_Service = $sendContact_Service;
    }

    public function send_contact(Request $request){
        $response = $this->sendContact_Service->send_contact($request->email, $request->username, $request->content);

        return $response;
    }
}
