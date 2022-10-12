<?php

    class notifications {
        
        private static $authorization = "Authorization: key=<Server-Key>";


        public static function info($token){
            
            $data = curl::get("https://iid.googleapis.com/iid/info/$token", [self::$authorization]);
            return $data;

        }


        public static function send($tokens, $title, $message, $extra = [], $priority = "HIGH" ){

            if(empty($extra)){
                $extra = (object) $extra;
            }

            $data = curl::post("https://fcm.googleapis.com/fcm/send",
            [
                'priority' => $priority,
                'registration_ids' => $tokens,
                'notification'     => ["title" => $title, "body" => $message],
                'data'             => $extra,
            ], 
            [self::$authorization, "Content-Type: application/json"], true);
            return $data;

        }


        // --- Topic ---
        public static function batchAdd($topic, $tokens){

            $data = curl::post("https://iid.googleapis.com/iid/v1:batchAdd", ["to" => "/topics/$topic", "registration_tokens" => $tokens], [self::$authorization, "Content-Type: application/json"], true);
            return $data;

        }
        

        public static function batchRemove($topic, $tokens){

            $data = curl::post("https://iid.googleapis.com/iid/v1:batchRemove", ["to" => "/topics/$topic", "registration_tokens" => $tokens], [self::$authorization, "Content-Type: application/json"], true);
            return $data;

        }


        public static function relTopics($token, $topic){

            $data = curl::post("https://iid.googleapis.com/iid/v1/$token/rel/topics/$topic", [], [self::$authorization]);
            return $data;

        }

        public static function sendTopic($topic, $title, $message, $extra = [] ){

            if(empty($extra)){
                $extra = (object) $extra;
            }

            $data = curl::post("https://fcm.googleapis.com/fcm/send",
            [
                'to' => "/topics/$topic",
                'notification'     => ["title" => $title, "body" => $message],
                'data'             => $extra,
            ], 
            [self::$authorization, "Content-Type: application/json"], true);
            return $data;

        }


        // --- Group ---
        public static function group($operation, $groupName, $tokens, $notificationKey = "")
        {
            
            $data = curl::post("https://android.googleapis.com/gcm/notification", 
            [

                "operation" => $operation,
                "notification_key_name" => $groupName,
                "notification_key" => $notificationKey,
                "registration_ids" => $tokens

            ], [self::$authorization, "Content-Type: application/json", "project_id: 187731126505"], true);
            return $data;
        }

        public static function sendGroup($groupName, $title, $message, $extra = [] ){

            if(empty($extra)){
                $extra = (object) $extra;
            }

            $data = curl::post("https://fcm.googleapis.com/fcm/send",
            [
                'to' => $groupName,
                'notification'     => ["title" => $title, "body" => $message],
                'data'             => $extra,
            ], 
            [self::$authorization, "Content-Type: application/json"], true);
            return $data;

        }



    }       

?>