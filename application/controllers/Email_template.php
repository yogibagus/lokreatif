<?php

class Cronjob extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->load->view('email/header');
        $this->load->view('email/auth');
        $this->load->view('email/footer');
    }

}