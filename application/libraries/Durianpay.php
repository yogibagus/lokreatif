<?php

class Durianpay
{
    public $endpoint, $apiKey;

    public function __construct()
    {
        $this->endpoint = "https://api.durianpay.id/v1";
        $this->apikey = base64_encode("dp_live_4SHCqxnY2Yn517EK:");
    }

    private function durianPost($url, $payload)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => array(
                "authorization: $this->apikey",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $data = json_decode($response, false);
        return $data;
    }

    private function durianGet($url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: $this->apikey",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $data = json_decode($response, false);
        return $data;
    }

    private function durianPut($url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_HTTPHEADER => array(
                "authorization: $this->apikey",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $data = json_decode($response, false);
        return $data;
    }

    public function createOrder($payload)
    {
        $url = $this->endpoint;
        $url = $url . '/orders';
        $result = $this->durianPost($url, $payload);

        return $result;
    }

    public function createEwalletPayment($orderid, $amount, $mobile, $walletType)
    {
        $url = $this->endpoint;
        $url = $url . '/payments/charge';

        $payload = array(
            'type' => 'EWALLET',
            'request' =>
            array(
                'order_id' => $orderid,
                'amount' => "$amount",
                'mobile' => $mobile,
                'wallet_type' => $walletType
            ),
        );

        $payload = json_encode($payload);

        $result = $this->durianPost($url, $payload);

        return $result;
    }

    public function createVAPayment($orderid, $amount, $bankCode, $name)
    {
        $url = $this->endpoint;
        $url = $url . '/payments/charge';

        $payload = array(
            'type' => 'VA',
            'request' =>
            array(
                'order_id' => $orderid,
                'bank_code' => $bankCode,
                'name' => $name,
                'amount' => "$amount",
            ),
        );

        $payload = json_encode($payload);

        $result = $this->durianPost($url, $payload);

        return $result;
    }

    public function checkPayment($payment_id)
    {
        $url = $this->endpoint;
        $url = $url . "/payments/" . $payment_id . "/status";

        $result = $this->durianGet($url);

        return $result;
    }

    public function verifyPayment($payment_id, $signature)
    {
        $url = $this->endpoint;
        $url = $url . "/payments/" . $payment_id . "/verify";

        $payload = array('verification_signature' => $signature);
        $payload = json_encode($payload);

        $result = $this->durianPost($url, $payload);

        return $result;
    }

    public function cancelPayment($payment_id)
    {
        $url = $this->endpoint;
        $url = $url . "/payments/" . $payment_id . "/cancel";

        $result = $this->durianPut($url);

        return $result;
    }

    public function getOrderId($order)
    {
        $orderid = $order['data']['id'];

        return $orderid;
    }

    public function getOrderData($order, $param = null)
    {
        $data = $order['data'];

        if ($param == null) {
            return $data;
        } else {
            return $data['param'];
        }
    }

    public function getPaymentId($paymentResponses)
    {
        return $paymentResponses['response']['payment_id'];
    }

    public function getPaymentExpiration($paymentResponses)
    {
        return $paymentResponses['response']['expiration_time'];
    }

    public function getVANumber($paymentResponses)
    {
        return $paymentResponses['response']['account_number'];
    }
}
