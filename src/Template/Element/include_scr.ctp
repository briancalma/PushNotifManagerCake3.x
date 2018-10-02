<script src="https://www.gstatic.com/firebasejs/5.5.2/firebase.js"></script>
<script>
  // Initialize Firebase
    

  var config = {
    // Copy and paste your configuration files 
    <?php 
        $txt = file_get_contents(WWW_ROOT."files/fb_config.txt");
        echo $txt;
    ?>
  };
  firebase.initializeApp(config);

  const messaging = firebase.messaging();

 
   
    // Defining my own service worker
   
  
    // console.log(swDir);
    navigator.serviceWorker.register("<?= $this->Url->script('/js/sw'); ?>")
        .then((registration) => {
            messaging.useServiceWorker(registration);
            console.log("SW REGISTERED :", registration);
            
            // Asking Permision and Generation of User Token
            messaging.requestPermission()
                .then(function() {
                    console.log('Permission Approved!');
                    return messaging.getToken();
                })
                .then(function(token){
                    console.log(token);
                    // You can put your ajax call here to save the token in the database
                })
                .catch(function(err) {
                    console.log('Error Occured!', err);
                });
        })
        .catch((err) => {
            console.error("Error in registering your own sw", err);
        });

    messaging.onMessage(function(payload) {
        console.log('onMessage:', payload);
    });
    
</script>