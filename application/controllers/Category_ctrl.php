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

    public function edit_category($id){
        $result = $this->Common_model->get_single_row_data('categories',['id'=>$id]);
        echo json_encode($result);
    }

    public function update_category(){
        $category_id = $this->input->post('category_id');
        $data['category_name'] = $this->input->post('category_name');
        $result = $this->Common_model->update_data('categories',['id'=>$category_id],$data);
        echo $result;
    }

    public function change_category_status($id){
        $data['category_status'] = $this->input->post('status') == 1 ? 0 : 1;
        $result = $this->Common_model->update_data('categories',['id'=>$id],$data);
        echo json_encode($result);
    }
}