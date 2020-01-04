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
}