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
        $result = $this->db->select('b.*,c.category_name')->from('brands b')->join('categories c','c.id=b.category_id')->get()->result();
        echo json_encode($result);
    }

    public function edit_brand($id){
        $result = $this->Common_model->get_single_row_data('brands',['id'=>$id]);
        echo json_encode($result);
        // $result = $this->db->where('b.id',$id)->join('categories c','c.id=b.category_id')->get('brands b')->row();
        // echo json_encode($result);
    }

    public function update_brand(){
        $brand_id = $this->input->post('brand_id');
        $data['brand_name'] = $this->input->post('brand_name');
        $data['category_id'] = $this->input->post('category_id');
        $result = $this->Common_model->update_data('brands',['id'=>$brand_id],$data);
        echo $result;
    }

    public function change_brand_status($id){
        $data['brand_status'] = $this->input->post('status') == 1 ? 0 : 1;
        $result = $this->Common_model->update_data('brands',['id'=>$id],$data);
        echo json_encode($result);
    }
}