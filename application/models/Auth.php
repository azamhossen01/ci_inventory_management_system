<?php
class Auth extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function login($table,$where){
        $query = $this->db->where($where)->get($table)->row();
        if($query){
            $this->session->set_userdata('id',$query->id);
            $this->session->set_userdata('role',$query->role);
        }
        
        return $query;
    }
}