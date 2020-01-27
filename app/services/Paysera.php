<?php
namespace App\Services;
class Paysera
{
    private $config;
//    public function __construct($config)
//    {
//        $this->config = $config;
//    }
    public function pay($email, $amount)
    {
        try {
            $request = WebToPay::redirectToPayment([
                'projectid'     => 146155,
                'sign_password' => 'ce28c97dcd8381b7d5a093ffd1deae38',
                'orderid'       => rand(1000000, 9999999),
                'amount'        => $amount,
                'currency'      => 'EUR',
                'country'       => 'LT',
                'accepturl'     => 'http://localhost/cb_b_du/public/course/answer',
                'cancelurl'     => 'http://localhost/cb_b_du/public/course/answer',
                'callbackurl'   => 'http://localhost/cb_b_du/public/course/answer',
                'p_email'       => $email,
                'test'          => 1,
            ]);
        } catch (WebToPayException $e) {
            die('BLOGAIddd');
        }
    }
    public function getPayment()
    {
        try {
            $response = WebToPay::checkResponse($_GET, array(
                'projectid'     => $this->config['projectid'],
                'sign_password' => $this->config['sign_password'],
            ));

            $orderId = $response['orderid'];
            $amount = $response['amount'];
            $currency = $response['currency'];
            $status = $response['status']; // gaunam 0, nepatvirtas
            //@todo: check, if order with $orderId is already approved (callback can be repeated several times)
            //@todo: check, if order amount and currency matches $amount and $currency
            //@todo: confirm order
            return [$orderId, $amount, $currency, $status];
        } catch (Exception $e) {
            echo get_class($e) . ': ' . $e->getMessage();
        }
    }
}