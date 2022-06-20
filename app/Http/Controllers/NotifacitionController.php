<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class NotifacitionController extends Controller
{
    public function messageToMatter()
    {

        $endpoint = "https://your-mattermost-server.com/hooks/xxx-generatedkey-xxx";
        $header = [
            'Content-Type: application/json',
            'Content-Length: 63'
        ];
        $text = "Test message to test";

        $client = new Client();

        $result = $client->post($endpoint, [$header, $text]);
        $statusCode = $result->getStatusCode();


             return "message sent $statusCode";
    }
}
