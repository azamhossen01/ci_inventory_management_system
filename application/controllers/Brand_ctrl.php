<?php
class Brand_ctrl extends CI_Controller{
    public function __construct(){
        parent::__construct();
        
        $this->load->model('Common_model','common');
        $role = $this->session->userdata('role');
        if($role !== "1"){
            redirect('/');
        }
    } 

    public function brand(){
        $categories = $this->Common_model->get_all_rows('categories');
        $this->load->view('brand/index',compact('categories'));
    }

    public function save_brand(){
        $data['category_id'] = $this->input->post('category_id');
        $data['brand_name'] = $this->input->post('brand_name');
        $result = $this->common->insert_data('brands',$data);
        echo json_encode($result);
    }
    public function all_brands(){
        // $result = $this->common->get_all_rows('brands');
        // echo json_encode($result);
        $result = $this->db->join('categories c','c.id=b.category_id')->get('brands b')->result();
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