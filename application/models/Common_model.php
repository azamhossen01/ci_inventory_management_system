<?php
class Common_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function insert_data($table,$data){
        $query = $this->db->insert($table,$data);
        return $query;
    }

    public function get_all_rows($table){
        $query = $this->db->get($table)->result();
        return $query;
    }

    public function get_single_row_data($table,$where){
        $query = $this->db->where($where)->get($table)->row();
        return $query;
    }

    public function anyName($table,$where,$field){
        $query = $this->db->select($field)->where($where)->get($table)->row();
        return $query->$field;
    }

    public function update_data($table,$where,$data){
        $query = $this->db->where($where)->update($table,$data);
        return $query;
    }
}