<?php
class Product_ctrl extends CI_Controller{
    public function __construct(){
        parent::__construct();
        
        $this->load->model('Common_model','common');
        $role = $this->session->userdata('role');
        if($role !== "1"){
            redirect('/');
        }
    } 

    public function product(){
        $categories = $this->Common_model->get_all_rows('categories');
        $this->load->view('product/index',compact('categories'));
    }

    public function save_product(){
        $data['category_id'] = $this->input->post('category_id');
        $data['brand_id'] = $this->input->post('brand_id');
        $data['product_name'] = $this->input->post('product_name');
        $data['product_description'] = $this->input->post('product_description');
        $data['product_quantity'] = $this->input->post('product_quantity');
        $data['product_unit'] = $this->input->post('product_unit');
        $data['product_base_price'] = $this->input->post('product_base_price');
        $data['product_tax'] = $this->input->post('product_tax');
        $data['product_added_by'] = $this->session->userdata('id');
        $result = $this->common->insert_data('products',$data);
        echo json_encode($result);
    }
    public function all_products(){
        // $result = $this->common->get_all_rows('brands');
        // echo json_encode($result);
        $result = $this->db->select('p.*,b.brand_name,c.category_name,u.name')->from('products p')->join('categories c','c.id=p.category_id')->join('brands b','b.id=p.brand_id')->join('users u','u.id=p.product_added_by')->get()->result();
        echo json_encode($result);
    }

    public function edit_product($id){
        $result = $this->Common_model->get_single_row_data('products',['id'=>$id]);
        echo json_encode($result);
        // $result = $this->db->where('b.id',$id)->join('categories c','c.id=b.category_id')->get('brands b')->row();
        // echo json_encode($result);
    }

    public function update_product(){
        $product_id = $this->input->post('product_id');
        $data['category_id'] = $this->input->post('category_id');
        $data['brand_id'] = $this->input->post('brand_id');
        $data['product_name'] = $this->input->post('product_name');
        $data['product_description'] = $this->input->post('product_description');
        $data['product_quantity'] = $this->input->post('product_quantity');
        $data['product_quantity'] = $this->input->post('product_quantity');
        $data['product_base_price'] = $this->input->post('product_base_price');
        $data['product_tax'] = $this->input->post('product_tax');
        $data['product_added_by'] = $this->session->userdata('id');
        $result = $this->Common_model->update_data('products',['id'=>$product_id],$data);
        echo $result;
    }

    public function change_product_status($id){
        $data['product_status'] = $this->input->post('status') == 1 ? 0 : 1;
        $result = $this->Common_model->update_data('products',['id'=>$id],$data);
        echo json_encode($result);
    }

    public function get_brands($category_id){
        $result = $this->Common_model->get_conditional_rows('brands',['category_id'=>$category_id]);
        echo json_encode($result);
    }

    public function product_details($product_id){
        $result = $this->db->select('p.*,c.category_name,b.brand_name,u.name')->from('products p')->join('categories c','c.id=p.category_id')->join('brands b','b.id=p.brand_id')->join('users u','u.id=p.product_added_by')->where('p.id',$product_id)->get()->row();
        echo json_encode($result);
    }
}