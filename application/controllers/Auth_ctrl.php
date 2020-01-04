<?php
class Auth_ctrl extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Auth','auth');
        $role = $this->session->userdata('role');
        if($role == "1"){
            redirect('admin_ctrl');
        }elseif($role == "2"){
            redirect('user_ctrl');
        }
    }

    public function index(){
        $this->load->view('auth/login');
    }

    public function login(){
        $data['email'] = $this->input->post('email');
        $data['password'] = md5($this->input->post('password'));
        $result = $this->auth->login('users',$data);
        if($result){
            $this->session->set_userdata('success','login successfull');
            $role = $this->session->userdata('role');
            if($role == 1){
                redirect('admin_ctrl');
            }elseif($role == 2){
                redirect('user_ctrl');
            }
        }else{
            $this->session->set_userdata('error','login failed');
            $this->load->view('auth/login');
        }
    }
}