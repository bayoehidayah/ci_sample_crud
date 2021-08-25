<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Model_faktur extends CI_Model{

		function checkData($id){
			$check = $this->db->get_where("faktur", ["id" => $id])->num_rows();
            if($check > 0){ return true; }
            else {return false;}
		}

		function checkChildData($idFaktur, $idBarang){
			$check = $this->db->get_where("faktur_items", [
				"id_faktur" => $idFaktur,
				"id_barang" => $idBarang
			])->num_rows();
            if($check > 0){ return true; }
            else {return false;}
		}

		function getData($id){
            return $this->db->get_where("faktur", ["id" => $id])->row();
        }

		function getFakturChild($id_faktur){
			if(!$this->checkData($id_faktur)){
				return [];
			}

			return $this->db->get_where("faktur_items", ["id_faktur" => $id_faktur])->result();
		}

        function fakturFilter($search, $limit, $start, $order_field, $order_ascdesc){
            $this->db->like('id', $search); 
            $this->db->or_like('nama_pelanggan', $search); 
            $this->db->or_like('total_items', $search); 
            $this->db->or_like('total_harga', $search); 
            $this->db->or_like('created_at', $search); 
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get("faktur")->result();
        }

        function countAllFaktur(){
            return $this->db->count_all("faktur");
        }

        function countFilterFaktur($search){
            return $this->db->like('id', $search)
                ->or_like('nama_pelanggan', $search)
                ->or_like('total_items', $search)
                ->or_like('total_harga', $search)
                ->or_like('created_at', $search)
                ->get("faktur")->num_rows(); 
        }
    }
?>
