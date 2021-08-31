<?php

class Email_template extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }

    public function default_auth($message){
    	$data['message']	= $message;
        $this->load->view('email/header');
        $this->load->view('email/auth', $data);
        $this->load->view('email/footer');
    }

}