<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('peserta/M_peserta');
        $this->load->model('General');
        $this->load->model('M_payment');
        // set default time
        date_default_timezone_set("Asia/Bangkok");
        $this->load->library('Durianpay');
        $this->load->library('Generatepay');
        // get session
        $this->kode_user = $this->session->userdata('kode_user');
        $this->email = $this->session->userdata('email');
        $this->nama = $this->session->userdata('nama');
        $this->role = $this->session->userdata('role');
        $this->logged_in = $this->session->userdata('logged_in');
    }

    public function index()
    {
        redirect();
    }

    // param kode_trans
    public function checkout($param = "")
    {
        $transaksi = $this->M_payment->get_transaksi_by_id($param);
        if ($transaksi != false) {
            $data['kode_trans'] = $transaksi->KODE_TRANS;
            $data['total_bayar'] = $this->M_payment->get_total_bayar($transaksi->KODE_TRANS);
            $data['total_team'] = $this->M_payment->get_total_team_and_biaya($transaksi->KODE_TRANS);
            $data['dataPendaftaran'] = $this->General->get_detailDaftarKompetisi($this->session->userdata("kode_user"));
            $data['tim']        = $this->M_payment->get_tim($transaksi->KODE_TRANS);
            $data['CI']                = $this;
            $data['module']         = "payment";
            $data['fileview']         = "checkout_page";

            if ($this->role == "1") {
                echo Modules::run('template/frontend_auth', $data);
            } else if ($this->role == "3") {
                echo Modules::run('template/frontend_auth', $data);
            }


            $this->session->set_flashdata('success', "Selesaikan pembayaran anda!");
        } else {
            $this->session->set_flashdata('error', "Transaction ID Not Found");
            redirect($this->agent->referrer());
        }
    }

    //param kode_pay
    public function details($param = "")
    {
        $payment = $this->M_payment->get_payment_by_id($param);
        if ($payment != false) {
            if ($payment->CHECKOUT_URL != null || $payment->CHECKOUT_URL != "") {
                // redirect payment ewallet
                redirect($payment->CHECKOUT_URL);
            } else {
                $transaksi = $this->M_payment->get_transaksi_by_id($payment->KODE_TRANS);
                //get user and split
                $kode_user = explode('_', trim($transaksi->KODE_USER_BILL));
                if ($kode_user == "UNIV") {
                    $data['user'] = $this->M_payment->get_univ_by_id($this->kode_user);
                } else {
                    $data['user'] = $this->General->get_akun($this->kode_user);
                }
                $data['bank_tut'] = $this->M_payment->get_tutorial_payment_by_bank_name($payment->METHOD);
                $data['payment'] = $payment;
                $data['status'] = $this->M_payment->get_status_payment_by_stat_pay($payment->STAT_PAY);

                $data['CI']                = $this;
                $data['module']         = "payment";
                $data['fileview']         = "payment_details";
                if ($this->role == "1") {
                    echo Modules::run('template/frontend_auth', $data);
                } else if ($this->role == "3") {
                    echo Modules::run('template/frontend_auth', $data);
                }
            }
        } else {
            $this->session->set_flashdata('error', "Payment not found");
            redirect($this->agent->referrer());
        }
    }


    // ================================ UP = VIEW | DOWN = PROCESS ==================================

    public function pay()
    {
        // initial
        $kode_trans = htmlspecialchars($this->input->post('kode_trans'));
        $name = ($this->input->post("name") != "") ? $this->input->post("name") : "";
        $mobile = ($this->input->post("mobile") != "") ? $this->input->post("mobile") : "";
        $mobile = preg_replace('/^(?:\+?62|0)?/', '0', $mobile);
        $method = ($this->input->post("method") != "") ? $this->input->post("method") : "";
        //get amount
        $total_bayar = $this->M_payment->get_total_bayar($kode_trans);
        $amount = (float)$total_bayar->total_bayar;
        // get transaksi
        $transaksi = $this->M_payment->get_transaksi_by_id($kode_trans);
        // get total bayar

        //split
        $method = explode('_', trim($method));
        if ($method[0] == "EWALLET") {
            $type = $method[0];
            $walletType = $method[1];

            // set fee EW | 1.8 %
            $result = (100 / 98.5) * $amount;
            $amount = ceil($result);
        } else if ($method[0] == "VA") {
            $type = $method[0];
            $bankCode = $method[1];

            // set fee VA | +4000
            $amount = (4000 + $amount);
        } else {
        }

        // create order_id
        $order_id = $this->create_order_id($amount, $kode_trans);

        if ($order_id != "") {
            if ($type == "EWALLET") {
                //param : orderid,$amount,$mobile,$walletType
                $pay = $this->durianpay->createEwalletPayment($order_id, $amount, $mobile, $walletType);
            } elseif ($type == "VA") {
                //VA
                //param : $orderid,$amount,$bankCode,$name
                $pay = $this->durianpay->createVAPayment($order_id, $amount, $bankCode, $name);
            }

            $kode_pay = $this->generatepay->gen_kodePay();
            // save payment_id
            $insert_data = $this->update_pay($kode_pay, $kode_trans, $method[1], $amount, $pay);
            if ($insert_data != false) {
                redirect('payment/details/' . $kode_pay);
            } else {
                $this->session->set_flashdata('error', "Failed creating payment");
                redirect($this->agent->referrer());
            }
        } else {
            $this->session->set_flashdata('error', "Order ID Not Found");
            redirect($this->agent->referrer());
        }
    }

    public function update_pay($kode_pay, $kode_trans, $method, $amount, $pay)
    {
        $payment_id = $pay->data->response->payment_id;
        $utc = explode('.', trim($pay->data->response->expiration_time));

        //CONVERT UTC TO LOKAL 
        $time1 = strtotime($utc[0] . 'UTC');
        $exp_time = date("Y-m-d H:i:s", $time1);

        if ($pay->data->type == "EWALLET") {
            $data_pay = [
                'KODE_PAY' => $kode_pay,
                'ORDER_ID' => $pay->data->response->order_id,
                'PAYMENT_ID' => $payment_id,
                'KODE_TRANS' => $kode_trans,
                'TYPE' => 1,
                'METHOD' => $method,
                'PAID_AMOUNT' => $pay->data->response->paid_amount,
                'CHECKOUT_URL' => $pay->data->response->checkout_url,
                'WEB_URL' => $pay->data->response->web_url,
                'STAT_PAY' => 2,
                'EXP_TIME' => $exp_time,
            ];
        } elseif ($pay->data->type == "VA") {
            $data_pay = [
                'KODE_PAY' => $kode_pay,
                'ORDER_ID' => $pay->data->response->order_id,
                'PAYMENT_ID' => $payment_id,
                'KODE_TRANS' => $kode_trans,
                'TYPE' => 2,
                'METHOD' => $method,
                'ACC_NUMBER' => $pay->data->response->account_number,
                'PAID_AMOUNT' =>  $pay->data->response->paid_amount,
                'STAT_PAY' => 2,
                'EXP_TIME' => $exp_time,
            ];
        } else {
            // type should 3
            $data_pay = [];
        }
        return $this->M_payment->update_pay($payment_id, $data_pay);
    }


    public function create_order_id($amount, $kode_trans)
    {
        // check user from univ or not
        if ($this->role == "3") {
            $user = $this->M_payment->get_univ_by_id($this->kode_user);
            $nama = $user->namapt;
        } else {
            $user = $this->General->get_akun($this->kode_user);
            $nama = $user->NAMA;
        }

        $payload = array(
            'amount' => "$amount",
            'payment_option' => 'full_payment',
            'currency' => 'IDR',
            'order_ref_id' => $kode_trans,
            'customer' =>
            array(
                'customer_ref_id' => $user->KODE_USER,
                'given_name' => $nama,
                'email' => $user->EMAIL,
                'mobile' => $user->HP,
                // 'address' =>
                // array(
                //     'receiver_name' => "dsadas",
                //     'receiver_phone' => '8987654321',
                //     'label' => 'Jude\'s Address',
                //     'address_line_1' => 'Jl. HR. Rasuna Said',
                //     'address_line_2' => 'Apartment #786',
                //     'city' => 'Jakarta Selatan',
                //     'region' => 'Jakarta',
                //     'country' => 'Indonesia',
                //     'postal_code' => '560008',
                //     'landmark' => 'Kota Jakarta Selatan',
                // ),
            ),
            'items' =>
            array(
                0 =>
                array(
                    'name' => "Pembayaran Lo-Kreatif - $kode_trans",
                    'qty' => 1,
                    'price' => "$amount",
                    'logo' => 'https://i.ibb.co/XtvzJBX/icon-ts.png',
                ),
            ),
            'metadata' =>
            array(
                'my-meta-key' => 'my-meta-value',
                'SettlementGroup' => 'LO-KREATIF',
            ),
        );

        $payload = json_encode($payload);
        $result =  $this->durianpay->createOrder($payload);
        return $result->data->id;
    }
}
