<?php
class Logout_ctrl extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Auth','auth');
        
        $id = $this->session->userdata('id');
        if(empty($id)){
            redirect('/');
        }
        
    }
    public function profile(){
        $user = $this->Common_model->get_single_row_data('users',['id'=>$this->session->userdata('id')]);
        $this->load->view('profile/edit_profile',compact('user'));
    }

    public function update_profile(){
        if($this->input->post('new_password')){
            $data['password'] = md5($this->input->post('new_password'));
        }
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $result = $this->Common_model->update_data('users',['id'=>$this->session->userdata('id')],$data);
        echo $result;
    }
















    public function logout(){
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
        $this->session->sess_destroy();
        redirect('/');
    }

    

}