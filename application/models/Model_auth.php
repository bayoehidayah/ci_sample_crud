<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Model_auth extends CI_Model{

        function checkUser($email){
            $check = $this->db->get_where("users", ["email" => $email])->num_rows();
            if($check > 0){ return true; }
            else {return false;}
        }

        function getDataUser($data){
            return $this->db->get_where("users", $data)->row_array();
        }

        function checkPengguna($id){
            $check = $this->db->get_where("users", ["id" => $id])->num_rows();
            if($check > 0){ return true; }
            else {return false;}
        }

        //User Password
        function userPassFilter($search, $limit, $start, $order_field, $order_ascdesc){
            $this->db->like('kdepeg', $search); 
            $this->db->or_like('email', $search); 
            $this->db->or_like('tipe', $search); 
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get("users")->result_array();
        }

        function countAllUserPass(){
            return $this->db->count_all("users");
        }

        function countFilterUserPass($search){
            $this->db->like('kdepeg', $search); 
            $this->db->or_like('email', $search); 
            $this->db->or_like('tipe', $search); 
            return $this->db->get("users")->num_rows();   
        }
    }
?>
