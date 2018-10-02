<?php
namespace PushManager\Controller;

use PushManager\Controller\AppController;

/**
 * Push Controller
 *
 *
 * @method \PushManager\Model\Entity\Push[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PushController extends AppController
{
    public $helpers = ['Form','Html'];

    public function index() {

        # Retrieving of Inputs
        if($this->request->is('post')) {
            $server_key = $this->request->data['server_api_key'];

            $will_generate_sw = $this->request->data['isSW'];

            $fb_config = $this->request->data['fb_config'];
            // $will_generate_sw =  $this->request->input('isSW');Y
            // $fb_config = $this->request->input('fb_config');
            if( !empty($server_key && $fb_config) && $will_generate_sw )
            {   

                $keyfile = WWW_ROOT."files/serverKey.txt";
                file_put_contents($keyfile,$server_key);
                
                $fbconfigFile = WWW_ROOT."files/fb_config.txt";
                file_put_contents($fbconfigFile,$fb_config);

                $this->create_service_worker($fb_config);

                $this->Flash->success(__('Success You Installed Push Panda Notification Plugin! You can close this tab now or just read the documentation page.'));    
            }
        } 
    }

    public function create_service_worker($sdk) {
        # service worker file configurations 
        # just attaching those strings to each other 

        $script = "importScripts(\"https://www.gstatic.com/firebasejs/5.0.4/firebase-app.js\");\n";
        $script .= "importScripts(\"https://www.gstatic.com/firebasejs/5.0.4/firebase-messaging.js\");\n";
        
        # Appending the inserted fcm sdk config
        # $config = file_get_contents(WWW_ROOT."files/sdkKey.txt");
        # $config = $sdk;
        $config = "var config = {\n"; 
        $config .= $sdk;            
        $config .= "\n};";
        $config .= "\nfirebase.initializeApp(config);";

        $script .= $config."\n";
        
        $script .= "const messaging = firebase.messaging();\n\n";

        $script .= "var target_url = '';\n\n";

        $script .= "messaging.setBackgroundMessageHandler( function(payload) {
                        
                       console.log('[SERVICE WORKER] : ',payload);
                        
                        var notificationTitle = payload.data.title;
                        
                        var notificationOption = {
                                                \"body\" : payload.data.body,
                                                \"icon\" : payload.data.icon,
                                                \"click_action\" : payload.data.click_action,
                                                \"image\" : payload.data.image
                        };
                    
                        target_url = payload.data.click_action;                
                                        
                        return self.registration.showNotification(notificationTitle,notificationOption);
                            
                   });\n\n";
                   
         $script .= "self.addEventListener('notificationclick',function(event) {
                        console.log('CLICK EVENT OCCURED!');
    
                        event.notification.close();
    
                        event.waitUntil( clients.openWindow(target_url) );
                    });";

        # Putting the final string to the webroot/js/sw.js file
        file_put_contents(WWW_ROOT."js/sw.js",$script);
    }
}
