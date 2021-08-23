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
            $this->db->or_like('last_stok', $search); 
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
                ->or_like('last_stok', $search)
                ->or_like('created_at', $search)
                ->get("barang")->num_rows(); 
        }
        
        function stokBarangFilter($search, $limit, $start, $order_field, $order_ascdesc){
            return $this->db
                ->like('id', $search)
                ->or_like('tanggal', $search)
                ->or_like('created_by', $search)
                ->or_like('created_at', $search)
                ->order_by($order_field, $order_ascdesc)
                ->limit($limit, $start)
                ->get("barang_stok_tgl")->result_array();
        }

        function countAllStokBarang(){
            return $this->db->get("barang_stok_tgl")->num_rows();
        }

        function countFilterStokBarang($search){
            return $this->db
                ->like('id', $search)
                ->or_like('tanggal', $search)
                ->or_like('created_by', $search)
                ->or_like('created_at', $search)
                ->get("barang_stok_tgl")->num_rows();   
        }

        function stokBarangPertanggalFilter($date, $search, $limit, $start, $order_field, $order_ascdesc){
            return $this->db->where("id_tgl", $date)
                ->like('(id', $search)
                ->or_like('id_barang', $search)
                ->or_like('stok_awal', $search)
                ->or_like('pembelian', $search)
                ->or_like('penjualan', $search)
                ->or_like('sisa_stok', $search)
                ->or_like("created_at LIKE '%$search%')", null)
                ->order_by($order_field, $order_ascdesc)
                ->limit($limit, $start)
                ->get("barang_stok")->result_array();
        }

        function countAllStokBarangPertanggal($date){
            return $this->db->where("id_tgl", $date)->get("barang_stok")->num_rows();
        }

        function countFilterStokBarangPertanggal($date, $search){
            return $this->db->where("id_tgl", $date)
                ->like('(id', $search)
                ->or_like('id_barang', $search)
                ->or_like('stok_awal', $search)
                ->or_like('pembelian', $search)
                ->or_like('penjualan', $search)
                ->or_like('sisa_stok', $search)
                ->or_like("created_at LIKE '%$search%')", null)
                ->get("barang_stok")->num_rows();   
        }
    }
?>
