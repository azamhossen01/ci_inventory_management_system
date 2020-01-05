<?php
class User_ctrl extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Auth','auth');
        $id = $this->session->userdata('id');
        if($id == null){
            redirect('/');
        }
        
    }

    public function index(){
        $this->load->view('dashboard');
    }

    public function user(){
        $this->load->view('user/index');
    }

    public function save_user(){
        $data['role'] = $this->input->post('role');
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $data['password'] = md5($this->input->post('password'));
        $result = $this->Common_model->insert_data('users',$data);
        echo json_encode($result);
    }

    public function all_users(){
        $result = $this->Common_model->get_all_rows('users');
        echo json_encode($result);
    }

    public function get_update_user($id){
        $result = $this->Common_model->get_single_row_data('users',['id'=>$id]);
        echo json_encode($result);
    }

    public function change_user_status($id){
        $data['user_status'] = $this->input->post('status') == 1 ? 0 : 1;
        $result = $this->Common_model->update_data('users',['id'=>$id],$data);
        echo json_encode($result);
    }

    public function update_user(){
        $id = $this->input->post('user_id');
        if($this->input->post('password') !== null){
            $data['password'] = md5($this->input->post('password'));
        }
        
        $data['role'] = $this->input->post('role');
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $result = $this->Common_model->update_data('users',['id'=>$id],$data);
        echo json_encode($result);
    }
}
