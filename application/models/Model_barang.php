<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Model_barang extends CI_Model{
        
        function checkBarang($id){
            $check = $this->db->get_where("barang", ["id" => $id])->num_rows();
            if($check > 0){ return true; }
            else {return false;}
        }

        function getData($id){
            return $this->db->get_where("barang", ["id" => $id])->row();
        }

        function getPrice($id_barang){
			if(!$this->checkBarang($id_barang)){
				return 0;
			}

			$data = $this->getData($id_barang);
			return $data->harga;
        }

        function barangFilter($search, $limit, $start, $order_field, $order_ascdesc){
            $this->db->like('id', $search); 
            $this->db->or_like('nama', $search); 
            $this->db->or_like('harga', $search); 
            $this->db->or_like('created_at', $search); 
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get("barang")->result();
        }

        function countAllBarang(){
            return $this->db->count_all("barang");
        }

        function countFilterBarang($search){
            return $this->db->like('id', $search)
                ->or_like('nama', $search)
                ->or_like('harga', $search)
                ->or_like('created_at', $search)
                ->get("barang")->num_rows(); 
        }
    }
?>
