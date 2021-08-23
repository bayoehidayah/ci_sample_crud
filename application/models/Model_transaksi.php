<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Model_transaksi extends CI_Model{
        function isUsed($id){
            return ($this->db->get_where("transaksi", ["id" => $id])->num_rows() > 0) ? true : false;
        }

        function generateNewID(){
            $kodeName = "PJ";
            $data     = $this->db->order_by("created_at", "DESC")
                ->get("transaksi");
                
            if($data->num_rows() > 0){
                $data = $data->row();
                $value = substr($data->id, 3, 8);
                $value = (int) $value + 1;
                $value = $kodeName."-".sprintf("%07s", $value);
            }
            else{
                $value = $kodeName."-0000001";
            }

            //Check kode again
            $check = $this->db->get_where("transaksi", ["id" => $value]);
            if($check->num_rows() > 0){
                return $this->generateNewID();
            }

            return $value;
        }

        function transaksiFilter($search, $limit, $start, $order_field, $order_ascdesc){
            $this->db->select("transaksi.id, barang.nama, transaksi.id_barang, transaksi.tanggal, transaksi.jumlah, transaksi.harga_jual, transaksi.total_jual, transaksi.id_user, transaksi.nama_user, transaksi.created_at, transaksi.updated_at");
            $this->db->like('transaksi.id', $search); 
            $this->db->or_like('id_barang', $search); 
            $this->db->or_like('tanggal', $search); 
            $this->db->or_like('jumlah', $search); 
            $this->db->or_like('transaksi.harga_jual', $search); 
            $this->db->or_like('total_jual', $search); 
            $this->db->or_like('id_user', $search); 
            $this->db->or_like('nama_user', $search);             
            $this->db->order_by("transaksi.".$order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            $this->db->join("barang", "barang.id=transaksi.id_barang");
            return $this->db->get("transaksi")->result_array();
        }

        function countAllTransaksi(){
            return $this->db->count_all("transaksi");
        }

        function countFilterTransaksi($search){
            $this->db->like('transaksi.id', $search); 
            $this->db->or_like('id_barang', $search); 
            $this->db->or_like('tanggal', $search); 
            $this->db->or_like('jumlah', $search); 
            $this->db->or_like('transaksi.harga_jual', $search); 
            $this->db->or_like('total_jual', $search); 
            $this->db->or_like('id_user', $search); 
            $this->db->or_like('nama_user', $search); 
            $this->db->join("barang", "barang.id=transaksi.id_barang");
            return $this->db->get("transaksi")->num_rows();   
        }

        //End Penunjang ---------------------------------------------------------------

    }
?>
