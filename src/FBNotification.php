<?php

// 02.06.2023 | YOEB.NET X BERKAY.ME
namespace Yoeb\Firebase;

use Yoeb\Firebase\Enum\Priority;

    class FBNotification {

        public static function info($token){

            $data = Curl::get("https://iid.googleapis.com/iid/info/$token", ["Authorization: key=".$_ENV["FB_SERVER_KEY"]]);
            return $data;

        }


        public static function send(
            $tokens,
            $title,
            $message,
            $image = null,
            $extra = [],
            Priority $priority = Priority::HIGH,
            $name = null,
            $collapseKey = null,
            $ttl = null,
            $restrictedPackageName = null,
            $directBootOk = null,
            $androidTitle = null,
            $androidBody = null,
            $icon   = null,
            $color  = null,
            $sound  = null,
            $tag = null,
            $clickAction = null,
            $bodyLocKey = null,
            $bodyLocArgs = null,
            $titleLocKey = null,
            $titleLocArgs = null,
            $channelId = null,
            $ticker = null,
            $sticky = null,
            $eventTime = null,
            $localOnly = false,
            $defaultSound = false,

            $notificationCount = 0,
            $link = null,
            $analyticsLabel = null,
        ){

            if(empty($extra)){
                $extra = (object) $extra;
            }
            $bearerToken = Curl::googleGetAccessTonek();

            //$data = Curl::post("https://fcm.googleapis.com/fcm/send",
            $data = Curl::post("https://fcm.googleapis.com/v1/projects/golff-app/messages:send",
            [
                'message' => [
                    'name'              => $name,
                    'token'             => $tokens[0],
                    'notification'      => [
                        'title'         => $title,
                        'body'          => $message,
                        'image'         => $image,
                    ],
                    'data'              => $extra,
                    'android'           => [
                        'collapse_key'              => $collapseKey,
                        'priority'                  => $priority,
                        'ttl'                       => $ttl,
                        'restricted_package_name'   => $restrictedPackageName,
                        'direct_boot_ok'            => $directBootOk,
                        'notification'              => [
                            'title'         => $androidTitle,
                            'body'          => $androidBody,
                            'icon'          => $icon,
                            'color'         => $color,
                            'sound'         => $sound,
                            'tag'           => $tag,
                            'click_action'  => $clickAction,
                            'body_loc_key'  => $bodyLocKey,
                            'body_loc_args' => $bodyLocArgs,
                            'title_loc_key' => $titleLocKey,
                            'title_loc_args'=> $titleLocArgs,
                            'channel_id'    => $channelId,
                            'ticker'        => $ticker,
                            'sticky'        => $sticky,
                            'event_time'    => $eventTime,
                            'local_only'    => $localOnly,
                            'default_sound' => $defaultSound,
                        ]
                    ],

                    // 'webpush'   => [
                    //     'link'  => $link,
                    // ],

                    // 'fcm_options' =>  [
                    //     'analytics_label'           => $analyticsLabel,
                    // ],
                ],
            ],
            //"Authorization: key=".$_ENV["FB_SERVER_KEY"], "Content-Type: application/json"], true);
            ["Authorization: Bearer ".$bearerToken["access_token"], "Content-Type: application/json"], true);
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
                'to'               => "/topics/$topic",
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
