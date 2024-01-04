<?php

// 28.09.2023 | YOEB.NET X BERKAY.ME

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

        public static function sendEmailVerify($token)
        {
            $data = Curl::post("https://identitytoolkit.googleapis.com/v1/accounts:sendOobCode?key=".$_ENV["FB_API_KEY"],
            [
                "idToken"           => $token,
                "requestType"       => "VERIFY_EMAIL",
            ]);

            return $data;
        }

        public static function confirmEmailVerify($oobCode)
        {
            $data = Curl::post("https://identitytoolkit.googleapis.com/v1/accounts:update?key=".$_ENV["FB_API_KEY"],
            [
                "oobCode"           => $oobCode,
            ]);

            return $data;
        }

        public static function passwordChange($token, $password, $returnSecureToken = true)
        {
            $data = Curl::post("https://identitytoolkit.googleapis.com/v1/accounts:update?key=".$_ENV["FB_API_KEY"],
            [
                "idToken"           => $token,
                "password"          => $password,
                "returnSecureToken" => $returnSecureToken,
            ]);

            return $data;
        }

        public static function passwordResetSendMail($email)
        {
            $data = Curl::post("https://identitytoolkit.googleapis.com/v1/accounts:sendOobCode?key=".$_ENV["FB_API_KEY"],
            [
                "email"             => $email,
                "requestType"       => "PASSWORD_RESET",
            ]);

            return $data;
        }

        public static function passwordOobCodeCheck($code)
        {
            $data = Curl::post("https://identitytoolkit.googleapis.com/v1/accounts:resetPassword?key=".$_ENV["FB_API_KEY"],
            [
                "oobCode"           => $code,
                "requestType"       => "PASSWORD_RESET",
            ]);

            return $data;
        }

        public static function passwordReset($code,$password)
        {
            $data = Curl::post("https://identitytoolkit.googleapis.com/v1/accounts:resetPassword?key=".$_ENV["FB_API_KEY"],
            [
                "oobCode"           => $code,
                "newPassword"       => $password,
                "requestType"       => "PASSWORD_RESET",
            ]);

            return $data;
        }
    }

?>
