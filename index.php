<?php

    // 12.10.2022 | YOEB.NET X BERKAY.ME

    require_once "curl.php";
    require_once "notifications.php";

    $token = "<FCM-Token>";

    function info(){
        $data = notifications::info($token);
        response::data(true, "", $data);
    }
    
    function send(){
        $data = notifications::send([$token], "Merhaba 👋", "Bu bir deneme mesajı.");
        response::data(true, "", $data);
    }


    // --- Topic ---
    function batchAdd(){
        $data = notifications::batchAdd("<Topic-Name>", [$token]);
        response::data(true, "", $data);
    }

    function batchRemove(){
        $data = notifications::batchRemove("<Topic-Name>", [$token]);
        response::data(true, "", $data);
    }

    function relTopics(){
        $data = notifications::relTopics($token, "<Topic-Name>");
        response::data(true, "", $data);
    }

    function sendTopic(){
        $topicName = "test";
        $data = notifications::sendTopic($topicName, "Merhaba 👋", "Bu bir topic deneme mesajı.");
        response::data(true, "", $data);
    }


    // --- Group ---
    function createGroup()
    {
        $data = notifications::group("create", "<Group-Name>", [$token]);
        response::data(true, "", $data);
    }
    
    function addGroup()
    {
        $data = notifications::group("add", "<Group-Name>", [$token], "<notification_key>");
        response::data(true, "", $data);
    }

    function removeGroup()
    {   //If you remove all existing registration tokens from a device group, FCM deletes the device group.
        $data = notifications::group("remove", "<Group-Name>", [$token], "<notification_key>");
        response::data(true, "", $data);
    }

    function sendGroup(){
        $data = notifications::sendGroup("<notification_key>", "Merhaba 👋", "Bu bir grup deneme mesajı.");
        response::data(true, "", $data);
    }
    


?>