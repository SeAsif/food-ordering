
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Twilio\Rest\Client;
 
class Test extends CI_Controller {
 
    public function index()
    {
        // $data = ['phone' => '+15005550006', 'text' => 'Hello, Please check dashboard new order recieve'];
        $data = ['phone' => '+923205511887', 'text' => 'Hello, Please check dashboard new order recieve'];
        echo '<pre>';
        print_r($this->sendSMS($data));
    }
 
    protected function sendSMS($data) {
        // Your Account SID and Auth Token from twilio.com/console
        // $sid = 'AC59101141aa28df747818b04fa85247a6';
        // $token = '805fff342d29dda47d97fb7594529981';
        $sid = 'AC23d5365eec206da935a09e287b97354c';
        $token = '4bc5465d45e43437682b9ec0d0d8432e';
        $twilio  = new Client($sid, $token);

        // Use the client to do fun stuff like send text messages!
         return $twilio->messages->create(
            // the number you'd like to send the message to
            $data['phone'],
            array(
                // A Twilio phone number you purchased at twilio.com/console
                // "from" => "+15005550006",
                "from" => "+14049498257",
                // the body of the text message you'd like to send
                'body' => $data['text']
            )
        );
    }
}