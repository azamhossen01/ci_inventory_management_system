<?php
class Admin_ctrl extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Auth','auth');
        $role = $this->session->userdata('role');
        if($role !== "1"){
            redirect('/');
        }
    }

    public function index(){
        $this->load->view('dashboard');
    }
}