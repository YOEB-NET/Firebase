<?php

// 02.06.2023 | YOEB.NET X BERKAY.ME

namespace Yoeb\Firebase;

    class FBAuth {

        public static function user($idToken)
        {
            $data = Curl::post("https://identitytoolkit.googleapis.com/v1/accounts:lookup?key=".$_ENV["FB_API_KEY"],
            [
                "idToken"  => $idToken,
            ]);

            return $data;
        }

        public static function register($email, $password, $returnSecureToken = true)
        {
            $data = Curl::post("https://identitytoolkit.googleapis.com/v1/accounts:signUp?key=".$_ENV["FB_API_KEY"],
            [
                "email"     => $email,
                "password"  => $password,
                "returnSecureToken" => $returnSecureToken,
            ]);

            return $data;
        }

        public static function login($email, $password, $returnSecureToken = true)
        {
            $data = Curl::post("https://identitytoolkit.googleapis.com/v1/accounts:signInWithPassword?key=".$_ENV["FB_API_KEY"],
            [
                "email"     => $email,
                "password"  => $password,
                "returnSecureToken" => $returnSecureToken,
            ]);

            return $data;
        }

        public static function tokenRefresh($refreshToken)
        {
            $data = Curl::post("https://identitytoolkit.googleapis.com/v1/token?key=".$_ENV["FB_API_KEY"],
            [
                "refresh_token"     => $refreshToken,
                "grant_type"        => "refresh_token",
            ]);

            return $data;
        }

    }       

?>