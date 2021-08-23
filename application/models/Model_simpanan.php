<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Model_simpanan extends CI_Model{
		
		public $listJenis = ["Simpanan Wajib","Simpanan Pokok","Simpanan Sukarela"];

		function checkData($id){
			$check = $this->db->get_where("simpanan", ["id" => $id])->num_rows();
            if($check > 0){ return true; }
            else {return false;}
		}

		function getData($id){
            return $this->db->get_where("simpanan", ["id" => $id])->row();
        }

        function simpananFilter($search, $limit, $start, $order_field, $order_ascdesc){
            $this->db->like('id', $search); 
            $this->db->or_like('id_user', $search); 
            $this->db->or_like('jenis', $search); 
            $this->db->or_like('nilai', $search); 
            $this->db->or_like('created_at', $search); 
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get("simpanan")->result_array();
        }

        function countAllSimpanan(){
            return $this->db->count_all("simpanan");
        }

        function countFilterSimpanan($search){
            return $this->db->like('id', $search)
                ->or_like('id_user', $search)
                ->or_like('jenis', $search)
                ->or_like('nilai', $search)
                ->or_like('created_at', $search)
                ->get("simpanan")->num_rows(); 
        }
    }
?>
