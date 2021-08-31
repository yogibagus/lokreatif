<?php

class Webhook extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payment/M_payment');
        // set default time
        date_default_timezone_set("Asia/Bangkok");
    }
    public function index()
    {
        redirect();
    }

    public function callback()
    {
        // $json_result = file_get_contents('php://input');
        // $result = json_decode($json_result, true);
        // if ($result['event'] == "payment.completed") {
        //     $order_id = $result['data']['order_id'];
        //     $payment = $this->M_payment->get_payment_by_order_id($order_id);

        //     $data_pay['STAT_PAY'] = 3; //payment success 
        //     $data_pay['LOG_TIME'] = date('Y-m-d H:i:s');; //payment success 
        //     $update_payment =  $this->M_payment->update_pay_by_order_id($order_id, $data_pay);
        //     if ($update_payment == true) {
        //         $data_trans['STAT_BAYAR'] = 3; //order complete
        //         $this->M_payment->update_transaksi($payment->KODE_TRANS, $data_trans);
        //     }
        // } else if ($result['event'] == "payment.failed") {
        //     $order_id = $result['data']['order_id'];
        //     $data_pay['STAT_PAY'] = 4; //payment failed
        //     $update_payment =  $this->M_payment->update_pay_by_order_id($order_id, $data_pay);
        // } else {
        //     redirect();
        // }

        // save log
        $datas['CONTENT_LOG'] = "work";
        $datas['ORDER_ID'] = 'work';
        $this->M_payment->insert_log_webhook($datas);

        // // save log
        // $datas['CONTENT_LOG'] = $json_result;
        // $datas['ORDER_ID'] = $result['data']['order_id'];
        // $this->M_payment->insert_log_webhook($datas);
        echo "work";
    }
}
