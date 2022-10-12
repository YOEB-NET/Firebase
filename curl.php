<?php

class curl {

    public static function get($url, $header = []){
       $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => $header,
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $jsonResponse = JSON_decode($response);
        if(empty($jsonResponse)){
            print_r($response);
        }
        return $jsonResponse;
        
    }
    
    public static function post($url , $parameters = [], $header = [], $postJSON = false){

        if($postJSON){
            $postData = JSON_encode($parameters);
        }else{
            $postData = http_build_query($parameters);
        }

        $curl = curl_init();
 
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);

        $jsonResponse = JSON_decode($response);
        if(empty($jsonResponse)){
            print_r($response);
        }
        return $jsonResponse;

    }

}

?>
