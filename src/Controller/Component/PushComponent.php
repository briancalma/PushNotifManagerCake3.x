<?php
namespace PushManager\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Push component
 */
class PushComponent extends Component
{

    protected $_defaultConfig = [];

    public function setUpConstVariables() {
        $server_key = file_get_contents(WWW_ROOT."files/serverKey.txt");
        
        if($server_key != "")
            define('SERVER_API_KEY',$server_key);
        
        define('TITLE','Notification');
        define('BODY','For those who beleive there is no need of Proof for those who don\'t there is no reason to beleive!');
        define('ICON','http://icons.iconarchive.com/icons/thehoth/seo/256/seo-panda-icon.png'); 
        define('CLICK_ACTION','https://google.com');
        define('IMAGE','');
    }

    public function messageConfig($data) {

        return $message = [
                "title" => $data["title"] != "" ? $data["title"] : TITLE,
                "body" =>  $data["body"] != "" ? $data["body"] : BODY,
                "icon" => $data["icon"] != "" ? $data["icon"] : ICON,
                "click_action" => $data["click_action"] != "" ? $data["click_action"] : CLICK_ACTION,
                "image" => $data["image"] != "" ? $data["image"] : IMAGE
               ];
    }

    public function getHeader() {
        return [ 'Authorization : Key='.SERVER_API_KEY, 'Content-Type: application/json'];
    }

    public function send($recievers, $data) {

        # Dummy Data 
        // $recievers = ['cLZWppg1MaQ:APA91bGmlhkDHLFPX3q_ToLgdwqETFx1M5iEWO6x8lIyhWThJFqiLuw80xGH-zCabLodGsZ0265HSUv4ApFUNh2WqK4998DkAe0k6ku_aBtOQ4SYjG7poBLf8ZPCzNwW4LmyfAVrc8Hn'];
        // $data = [
        //             "title" => "",
        //             "body" =>  "",
        //             "icon" => "",
        //             "click_action" => "",
        //             "image" => ""
        //         ];

        # SETUP
        $this->setUpConstVariables(); 

        # MESSAGE AND PAYLOAD CONFIGURATION
	    $message = $this->messageConfig($data);
        $payload = [ 'registration_ids' => $recievers, 'data' => $message ];                    
        
        # EXECUTING OF CURL COMMAND
        $this->triggerPushCommand( $this->getHeader(), $payload );
        
        exit();
    }

    public function triggerPushCommand( $headers, $payload ) {
        # Send CURL Command
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        
         # CURL Output	   	
	    if ($err) {
            echo "cURL Error #:" . $err;
        } 
    }
}
