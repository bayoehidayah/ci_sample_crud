<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Model_users extends CI_Model{

        public $listType = [
            "admin"   => "Admin",
            "anggota" => "Anggota"
        ];

        function checkData($data){
            $check = $this->db->get_where("users", $data)->num_rows();
            if($check > 0){ return true; }
            else {return false;}
        }

        function getData($id){
            return $this->db->get_where("users", ["id" => $id])->row();
        }

        function generateNewID($type = "anggota"){
            if(!array_key_exists($type, $this->listType)){
                return null;
            }

            $kodeName = $type == "anggota" ? "AK": "AD";
            $data     = $this->db
                ->where("tipe", $type)
                ->order_by("created_at", "DESC")
                ->get("users");
                
            if($data->num_rows() > 0){
                $data = $data->row();
                $value = substr($data->id, 3, 4);
                $value = (int) $value + 1;
                $value = $kodeName."-".sprintf("%04s", $value);
            }
            else{
                $value = $kodeName."-0001";
            }

            return $value;
        }

        function usersFilter($search, $limit, $start, $order_field, $order_ascdesc){
            $this->db->like('id', $search); 
            $this->db->or_like('nama', $search); 
            $this->db->or_like('tipe', $search); 
            $this->db->or_like('email', $search); 
            $this->db->or_like('created_at', $search); 
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get("users")->result_array();
        }

        function countAllUsers(){
            return $this->db->count_all("users");
        }

        function countFilterUsers($search){
            $this->db->like('id', $search); 
            $this->db->or_like('nama', $search); 
            $this->db->or_like('tipe', $search); 
            $this->db->or_like('email', $search); 
            $this->db->or_like('created_at', $search); 
            return $this->db->get("users")->num_rows();   
        }
    }
?>