<?php

function sendNotification($message) {

    $notificationServiceEndpoint = 'https://your-push-notification-service.com/api/send';
    $postData = array('message' => $message);

    $ch = curl_init($notificationServiceEndpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    
    $response = curl_exec($ch);
    curl_close($ch);

   

    return $response;
}


//if (1) {
    $notificationMessage = "Congratulations!! You have won a reward"; 
    sendNotification($notificationMessage);
//}
?>
