<?php

namespace Yoeb\Firebase;

    class FBNotification {

        public static function info($token){
            
            $data = Curl::get("https://iid.googleapis.com/iid/info/$token", ["Authorization: key=".$_ENV["FB_SERVER_KEY"]]);
            return $data;

        }


        public static function send($tokens, $title, $message, $extra = [], $priority = "HIGH" ){

            if(empty($extra)){
                $extra = (object) $extra;
            }

            $data = Curl::post("https://fcm.googleapis.com/fcm/send",
            [
                'priority' => $priority,
                'registration_ids' => $tokens,
                'notification'     => ["title" => $title, "body" => $message],
                'data'             => $extra,
            ], 
            ["Authorization: key=".$_ENV["FB_SERVER_KEY"], "Content-Type: application/json"], true);
            return $data;

        }


        // --- Topic ---
        public static function batchAdd($topic, $tokens){

            $data = Curl::post("https://iid.googleapis.com/iid/v1:batchAdd", ["to" => "/topics/$topic", "registration_tokens" => $tokens], ["Authorization: key=".$_ENV["FB_SERVER_KEY"], "Content-Type: application/json"], true);
            return $data;

        }
        

        public static function batchRemove($topic, $tokens){

            $data = Curl::post("https://iid.googleapis.com/iid/v1:batchRemove", ["to" => "/topics/$topic", "registration_tokens" => $tokens], ["Authorization: key=".$_ENV["FB_SERVER_KEY"], "Content-Type: application/json"], true);
            return $data;

        }


        public static function relTopics($token, $topic){

            $data = Curl::post("https://iid.googleapis.com/iid/v1/$token/rel/topics/$topic", [], ["Authorization: key=".$_ENV["FB_SERVER_KEY"]]);
            return $data;

        }

        public static function sendTopic($topic, $title, $message, $extra = [] ){

            if(empty($extra)){
                $extra = (object) $extra;
            }

            $data = Curl::post("https://fcm.googleapis.com/fcm/send",
            [
                'to' => "/topics/$topic",
                'notification'     => ["title" => $title, "body" => $message],
                'data'             => $extra,
            ], 
            ["Authorization: key=".$_ENV["FB_SERVER_KEY"], "Content-Type: application/json"], true);
            return $data;

        }


        // --- Group ---
        public static function group($operation, $groupName, $tokens, $notificationKey = "")
        {
            
            $data = Curl::post("https://android.googleapis.com/gcm/notification", 
            [

                "operation" => $operation,
                "notification_key_name" => $groupName,
                "notification_key" => $notificationKey,
                "registration_ids" => $tokens

            ], ["Authorization: key=".$_ENV["FB_SERVER_KEY"], "Content-Type: application/json", "project_id: 187731126505"], true);
            return $data;
        }

        public static function sendGroup($groupName, $title, $message, $extra = [] ){

            if(empty($extra)){
                $extra = (object) $extra;
            }

            $data = Curl::post("https://fcm.googleapis.com/fcm/send",
            [
                'to' => $groupName,
                'notification'     => ["title" => $title, "body" => $message],
                'data'             => $extra,
            ], 
            ["Authorization: key=".$_ENV["FB_SERVER_KEY"], "Content-Type: application/json"], true);
            return $data;

        }



    }       

?>