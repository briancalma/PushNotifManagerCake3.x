# Push Notification plugin for CakePHP 3.x 
This plugin is a  CakePHP 3.x Plugin that is intended to give an easy way of sending push messages to your FCM Server(Firebase Cloud Messaging). 
It sends push notification configured messages to your FCM server using CURL and allow clean flow with a minimal need of installation, with just few steps you can see your Push Notification up running. 

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites
1. Be sure that you have an FCM (Firebase Cloud Messaging App), If you dont have go to : https://console.firebase.google.com/
2. Install CURL https://curl.haxx.se/
3. Clone or download this project :).
4. CakePHP 3.x App 


## Installation
1. Manual Way 
- Download or clone this project. 
- Copy and Paste the entire folder to plugins folder. 
- Take note that the root folder of this plugin must be named 'PushManager'.

2. Loading This Plugin
- The easiest way to load this plugin is use this bake command: 
```
composer dumpautoload

cake plugin load PushManager
```

- Go to your config/bootstrap.php and paste this code:
```

Plugin::load('PushManager', ['bootstrap' => false, 'routes' => true]);

```
3. Test it out!
- Go to this url: 
```
yourhostname/push-manager/push 
```

## Setup 
1. You must create the following files : 
   - webroot/files/fb_config.txt
   - webroot/files/serverKey.txt
   - webroot/js/sw.js

2. Firebase Config TextArea Field 
   - Fb Config textarea will hold the Firebase Web SDK. Navigate to the console and copy paste your sdk setup: 

##Example
   ```
    apiKey: "YOUR-API-KEY",
    authDomain: "AUTH-DOMAIN",
    databaseURL: "DATABASE-URL",
    projectId: "PROJECT-ID",
    storageBucket: "STORAGE-BUCKET",
    messagingSenderId: "MESSAGING-SENDER-ID"
   ```

3. Server Key Text Area Field must hold your server key located in the Cloud message section in the console. Just copy paste your key.

4. Will Generate Service Worker radio button 
   - If you have a working service worker ignore this field but if you want to automatically generate a service worker for you then hit or select the radio button.

5. Hit Submit and a flash message will show that you successfully configured and installed the plugin!

6. You can then close the browser tab.


## Allow Push Notification Prompt
- The following steps will show how to use this plugin auto generated javascript file to make or to show a prompt to the client browser which when allowed will generate a token that is used to send push notifications.

1. Load the plugin's Push Component 
   - Just paste this code to your controller. 

   ```
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('PushManager.Push');
    }
   ```
   - This will load the Push component of the PushManager Plugin

2. Go to your desired page/template you want to show the Allow Push Notification Popup and paste this code. 
    ```
    <?php $this->element('PushManager.include_scr');?>
    ```
    
    - You can then configure PushManager/src/Template/Element/include_scr.ctp if you want to make some tweaks like sending the generated token in your database.

## Sending The Push Notification 
- To send a push notification just go to your desired controller and use the send() function. 

Example : 
```
    public function notifyUser() {

        $recievers = ['caBadasdasdklFvJCRx4:APA91bH3J7RfzywxpUj5mATLt3Amlv8i3NM6FL9yWFPKgW7IqJZBzV1A4HEdww2u_FA8DSdWi1ZT3hcE4y0-oIR4LOnBKoW8RVU72JHghpqgkuQ_Nndvz4QBfpeOJ03IsEcl5t1hn8GD'];
        $data = [
                    "title" => "BlackThornProd",
                    "body" =>  "Lets Build A Game!",
                    "icon" => "https://yt3.ggpht.com/a-/AN66SAx1jg3odi_z2-kAs-7LTnMZnVcHCv60mzKmkw=s900-mo-c-c0xffffffff-rj-k-no",
                    "click_action" => "https://www.youtube.com/channel/UC9Z1XWw1kmnvOOFsj6Bzy2g",
                    "image" => "https://img.itch.zone/aW1hZ2UvMTg5NDE4Lzk2MTAwNy5wbmc=/original/CmuH5g.png"
                ];


        $this->Push->send($recievers, $data);   
        exit();
    }
```

## send($recievers, $data) 
- This function will send the push notification message. 
- Parameters : 
    $recievers - an array which holds a group of tokens of type string. 
    $data - an array that will hold the message options. 


## Dont forget to Update your service worker in your browser panel.

# PushNotifManagerCake3.x
