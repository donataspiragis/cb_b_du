<?php

namespace App\Services;
class MailChimp
{
    private $list_id,$api_key;

    public function __construct($api_key, $list_id){
        $this->list_id = $list_id;
        $this->api_key = $api_key;

    }
    public function create($email, $status, $merge_fields = array('FNAME' => '','LNAME' => '')){
echo 'HII';
        $data = array(
            'apikey'        => $this->api_key,
            'email_address' => $email,
            'status'        => $status,
            'merge_fields'  => $merge_fields
        );
        $mch_api = curl_init(); // initialize cURL connection

        curl_setopt($mch_api, CURLOPT_URL, 'https://' . substr($this->api_key,strpos($this->api_key,'-')+1) . '.api.mailchimp.com/3.0/lists/' . $this->list_id . '/members/' . md5(strtolower($data['email_address'])));
        curl_setopt($mch_api, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '.base64_encode( 'user:'.$this->api_key )));
        curl_setopt($mch_api, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
        curl_setopt($mch_api, CURLOPT_RETURNTRANSFER, true); // return the API response
        curl_setopt($mch_api, CURLOPT_CUSTOMREQUEST, 'PUT'); // method PUT
        curl_setopt($mch_api, CURLOPT_TIMEOUT, 10);
        curl_setopt($mch_api, CURLOPT_POST, true);
        curl_setopt($mch_api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($mch_api, CURLOPT_POSTFIELDS, json_encode($data) ); // send data in json

        $result = curl_exec($mch_api);
        return $result;

    }


}