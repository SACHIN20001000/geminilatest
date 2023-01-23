<?php

namespace App\Traits;



trait WhatsappApi
{

    public function sendMessage($number, $message)
    {

        $data = rawurlencode(strip_tags($message));
        $url = 'https://bulkchatbot.co.in/api/send.php?number=' . $number . '&type=text&message=' . $data . '&instance_id=63B293D6D4019&access_token=d947472c111c73ec8b4187b3dad025a2';
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
        ));

        $response =  curl_exec($curl);

        curl_close($curl);
    }
}
