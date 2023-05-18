<?php
require __DIR__ . '/vendor/autoload.php';

    // 18.06.2023 | YOEB.NET X BERKAY.ME

    $token = "<FCM-Token>";

    use Yoeb\Firebase\FBNotification;

    function info(){
        FBNotification::info($token);
    }

    function send(){
        FBNotification::send([$token], "Merhaba 👋", "Bu bir deneme mesajı.");
    }

    // --- Topic ---
    function batchAdd(){
        FBNotification::batchAdd("<Topic-Name>", [$token]);
    }

    function batchRemove(){
        FBNotification::batchRemove("<Topic-Name>", [$token]);
    }

    function relTopics(){
        FBNotification::relTopics($token, "<Topic-Name>");
    }

    function sendTopic(){
        $topicName = "test";
        FBNotification::sendTopic($topicName, "Merhaba 👋", "Bu bir topic deneme mesajı.");
    }


    // --- Group ---
    function createGroup()
    {
        FBNotification::group("create", "<Group-Name>", [$token]);
    }
    
    function addGroup()
    {
        FBNotification::group("add", "<Group-Name>", [$token], "<notification_key>");
    }

    function removeGroup()
    {   //If you remove all existing registration tokens from a device group, FCM deletes the device group.
        FBNotification::group("remove", "<Group-Name>", [$token], "<notification_key>");
    }

    function sendGroup(){
        FBNotification::sendGroup("<notification_key>", "Merhaba 👋", "Bu bir grup deneme mesajı.");
    }
    


?>