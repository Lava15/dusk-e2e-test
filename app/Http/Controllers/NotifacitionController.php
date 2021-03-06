<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use ThibaudDauce\Mattermost\Mattermost;
use ThibaudDauce\Mattermost\Message;
use ThibaudDauce\Mattermost\Attachment;
use Illuminate\Http\Request;

class NotifacitionController extends Controller
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
//    public function messageToMatter()
//    {
//
//        $endpoint = "https://your-mattermost-server.com/hooks/xxx-generatedkey-xxx";
//        $header = [
//            'Content-Type: application/json',
//            'Content-Length: 63'
//        ];
//        $text = "Test message to test";
//
//        $client = new Client();
//
//        $result = $client->post($endpoint, [$header, $text]);
//        $statusCode = $result->getStatusCode();
//
//
//        return "message sent $statusCode";
//    }

    public function SendMessageToMatt()
    {
        $mattermost = new Mattermost(new Client);
        $message = (new Message)
            ->text('This is test message')
            ->channel('test-channel')
            ->username('@test')
            ->attachment(function (Attachment $attachment) {
                $attachment->fallback('This is the fallback test for the attachment.')
                    ->success()
                    ->authorName('Mattermost')
                    ->title('Example attachment', 'https://unsplash.com/photos/gKXKBY-C-Dk')
                    ->field('Long field', 'Testing with a very long piece of text that will take up the whole width of the table. And then some more text to make it extra long.', false)
                    ->field('Column one', 'Testing.', true)
                    ->field('Column two', 'Testing.', true)
                    ->field('Column one again', 'Testing.', true)
                    ->imageUrl('http://www.mattermost.org/wp-content/uploads/2016/03/logoHorizontal_WS.png')
                    ->action([
                        'name' => 'Some button text',
                        'integration' => [
                            'url' => 'https://my-post-api.example.org',
                            'context' => [
                                'user_id' => '123',
                                'secret_key' => 'b??po22',
                            ],
                        ]
                    ]);
            });

        $mattermost->send($message, env('WEB_HOOK'));
                  return "message sent";
    }
}
