<?php

namespace App\Services;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Mandrill;

class MailChimp
{
    private $list_id,$api_key,$gmail_key;

    public function __construct($api_key, $list_id,$gmail_key){
	$this->api_key = $api_key;
        $this->list_id = $list_id;
        $this->gmail_key = $gmail_key;
	

    }
    public function create($email, $status, $merge_fields = array('FNAME' => '','LNAME' => '')){
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
        //return $result;

    }

public function send($email,$name,$link){
        
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";

        $mail->SMTPDebug  = 1;  
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "ugas.bugas@gmail.com";
        $mail->Password   = $this->gmail_key;

        $mail->IsHTML(true);
    $mail->AddAddress($email, $name);
    $mail->SetFrom("ugas.bugas@gmail.com", "CBDU");
    $mail->AddReplyTo("CBDU@codebaker.com", "reply-to-name");
    $mail->AddCC("cc-$email", "cc-$email");
    $mail->Subject = "Email remind";
    $content = "<b>$link.</b>";

    $mail->MsgHTML($content); 
    if(!$mail->Send()) {
      echo "Error while sending Email.";
    } else {
      echo "Email sent successfully";
    }
    }


}
