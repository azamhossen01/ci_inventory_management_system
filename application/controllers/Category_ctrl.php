<?php
class Category_ctrl extends CI_Controller{
    public function __construct(){
        parent::__construct();
        
        $this->load->model('Common_model','common');
        $role = $this->session->userdata('role');
        if($role !== "1"){
            redirect('/');
        }
    }

    public function category(){
        $this->load->view('category/index');
    }
    public function save_category(){
        $data['category_name'] = $this->input->post('category_name');
        $result = $this->common->insert_data('categories',$data);
        echo json_encode($result);
    }
    public function all_categories(){
        $result = $this->common->get_all_rows('categories');
        echo json_encode($result);
    }
}