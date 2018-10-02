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
###1.1 Using Composer
You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/PushManager
```
1.2. Manual Way 
- Download or clone this project. 
- Copy and Paste the entire folder to plugins folder. 

2. Loading This Plugin
- The easiest way to load this plugin is use this bake command: 
```

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
# PushNotifManagerCake3.x
