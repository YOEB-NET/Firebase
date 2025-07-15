<?php

// 02.06.2023 | YOEB.NET X BERKAY.ME

namespace Yoeb\Firebase;

    class FBNotification {

        public static function info($token){

            $data = Curl::get("https://iid.googleapis.com/iid/info/$token", ["Authorization: key=".($_ENV["FB_API_KEY"] ?? config("firebase.api_key"))]);
            return $data;

        }


        public static function send(
            $tokens,
            $title,
            $message,
            $image = null,
            $extra = [],
            $priority = "HIGH",
            $restrictedPackageName = null,
            $channelId = null,
            $icon = null,
            $color = null,
            $sound = null,
            $tag = null,
            $localOnly = false,
            $notificationCount = 0,
            $link = null,
            $analyticsLabel = null,
        ){

            if(empty($extra)){
                $extra = (object) $extra;
            }

            $data = Curl::post("https://fcm.googleapis.com/fcm/send",
            [
                'priority'          => $priority,
                'registration_ids'  => $tokens,
                'notification'      => [
                    'title'         => $title,
                    'body'          => $message,
                    'image'         => $image,
                    'color'         => $color,
                    'tag'           => $tag,

                ],
                'data'              => $extra,
                'android'           => [
                    'restricted_package_name'   => $restrictedPackageName,
                    'channelId'                 => $channelId,
                    'local_only'                => $localOnly,
                    'icon'                      => $icon,
                    'sound'                     => $sound,
                    'notification_count'        => $notificationCount
                ],

                'webpush'   => [
                    'link'  => $link,
                ],

                'fcm_options' =>  [
                    'analytics_label'           => $analyticsLabel,
                ],
            ],
            ["Authorization: key=".($_ENV["FB_API_KEY"] ?? config("firebase.api_key")), "Content-Type: application/json"], true);
            return $data;

        }



        // --- Topic ---
        public static function batchAdd($topic, $tokens){

            $data = Curl::post("https://iid.googleapis.com/iid/v1:batchAdd", ["to" => "/topics/$topic", "registration_tokens" => $tokens], ["Authorization: key=".($_ENV["FB_API_KEY"] ?? config("firebase.api_key")), "Content-Type: application/json"], true);
            return $data;

        }


        public static function batchRemove($topic, $tokens){

            $data = Curl::post("https://iid.googleapis.com/iid/v1:batchRemove", ["to" => "/topics/$topic", "registration_tokens" => $tokens], ["Authorization: key=".($_ENV["FB_API_KEY"] ?? config("firebase.api_key")), "Content-Type: application/json"], true);
            return $data;

        }


        public static function relTopics($token, $topic){

            $data = Curl::post("https://iid.googleapis.com/iid/v1/$token/rel/topics/$topic", [], ["Authorization: key=".($_ENV["FB_API_KEY"] ?? config("firebase.api_key"))]);
            return $data;

        }

        public static function sendTopic($topic, $title, $message, $extra = [] ){

            if(empty($extra)){
                $extra = (object) $extra;
            }

            $data = Curl::post("https://fcm.googleapis.com/fcm/send",
            [
                'to'               => "/topics/$topic",
                'notification'     => ["title" => $title, "body" => $message],
                'data'             => $extra,
            ],
            ["Authorization: key=".($_ENV["FB_API_KEY"] ?? config("firebase.api_key")), "Content-Type: application/json"], true);
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

            ], ["Authorization: key=".($_ENV["FB_API_KEY"] ?? config("firebase.api_key")), "Content-Type: application/json", "project_id: 187731126505"], true);
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
            ["Authorization: key=".($_ENV["FB_API_KEY"] ?? config("firebase.api_key")), "Content-Type: application/json"], true);
            return $data;

        }



    }

?>
