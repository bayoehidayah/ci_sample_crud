<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Model_referensi extends CI_Model{

        function getData($table, $idi = ""){
            if($idi != ""){
                return $this->db->get_where($table, ["idi" => $idi])->row_array();
            }
            else{
                return $this->db->get($table)->result();
            }
        }

        function checkData($table, $idi){
            $check = $this->db->get_where($table, ["idi" => $idi])->num_rows();
            if($check > 0){return true;}
            else{return false;}
        }

        //Kelompok Jabatan -----------------------------------------------------------------
        function kelJabFilter($search, $limit, $start, $order_field, $order_ascdesc){
            $this->db->like('kdekeljab', $search); 
            $this->db->or_like('nmakeljab', $search); 
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get("tbkeljab")->result_array();
        }

        function countAllKelJab(){
            return $this->db->count_all("tbkeljab");
        }

        function countFilterKelJab($search){
            $this->db->like('kdekeljab', $search); 
            $this->db->or_like('nmakeljab', $search); 
            return $this->db->get("tbkeljab")->num_rows();   
        }
        //End Kelompok Jabatan -------------------------------------------------------------

        //Kelompok Nama Jabatan ------------------------------------------------------------
        function kelNamaJabFilter($search, $limit, $start, $order_field, $order_ascdesc){
            $this->db->like('kdekeljab', $search); 
            $this->db->or_like('kdenmajab', $search); 
            $this->db->or_like('nmajab', $search); 
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get("tbnmajab")->result_array();
        }

        function countAllKelNamaJab(){
            return $this->db->count_all("tbnmajab");
        }

        function countFilterKelNamaJab($search){
            $this->db->like('kdekeljab', $search); 
            $this->db->or_like('kdenmajab', $search); 
            $this->db->or_like('nmajab', $search);  
            return $this->db->get("tbnmajab")->num_rows();   
        }
        //End Kelompok Nama Jabatan ---------------------------------------------------------

        //Kelas Jabatan ---------------------------------------------------------------------
        function kelasJabFilter($search, $limit, $start, $order_field, $order_ascdesc){
            $this->db->or_like('kdeklsjab', $search); 
            $this->db->or_like('nmaklsjab', $search); 
            $this->db->or_like('sksklsjab', $search); 
            $this->db->or_like('grade', $search); 
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get("tbklsjab")->result_array();
        }

        function countAllKelasJab(){
            return $this->db->count_all("tbklsjab");
        }
        
        function countFilterKelasJab($search){
            $this->db->or_like('kdeklsjab', $search); 
            $this->db->or_like('nmaklsjab', $search); 
            $this->db->or_like('sksklsjab', $search); 
            $this->db->or_like('grade', $search); 
            return $this->db->get("tbklsjab")->num_rows();   
        }
        //End Kelas Jabatan -----------------------------------------------------------------

        //Pekerjaan -------------------------------------------------------------------------
        function pekerjaanFilter($search, $limit, $start, $order_field, $order_ascdesc){
            $this->db->like('kdepekerjaan', $search); 
            $this->db->or_like('nmapekerjaan', $search); 
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get("tbpekerjaan")->result_array();
        }

        function countAllPekerjaan(){
            return $this->db->count_all("tbpekerjaan");
        }
        
        function countFilterPekerjaan($search){
            $this->db->like('kdepekerjaan', $search); 
            $this->db->or_like('nmapekerjaan', $search); 
            return $this->db->get("tbpekerjaan")->num_rows();   
        }
        //End Pekerjaan --------------------------------------------------------------------

        //Aktivitas -------------------------------------------------------------------------
        function aktivitasFilter($search, $limit, $start, $order_field, $order_ascdesc){
            $this->db->like('kdepekerjaan', $search); 
            $this->db->or_like('kdeaktivitas', $search); 
            $this->db->or_like('nmaaktivitas', $search); 
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get("tbaktivitas")->result_array();
        }

        function countAllAktivitas(){
            return $this->db->count_all("tbaktivitas");
        }
        
        function countFilterAktivitas($search){
            $this->db->like('kdepekerjaan', $search); 
            $this->db->or_like('kdeaktivitas', $search); 
            $this->db->or_like('nmaaktivitas', $search); 
            return $this->db->get("tbaktivitas")->num_rows();   
        }
        //End Aktivitas --------------------------------------------------------------------

        //Peran ----------------------------------------------------------------------------
        function peranFilter($search, $limit, $start, $order_field, $order_ascdesc){
            $this->db->like('kdeaktivitas', $search); 
            $this->db->or_like('kdeperan', $search); 
            $this->db->or_like('nmaperan', $search); 
            $this->db->or_like('jnspeg', $search); 
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get("tbperan")->result_array();
        }

        function countAllPeran(){
            return $this->db->count_all("tbperan");
        }
        
        function countFilterPeran($search){
            $this->db->like('kdeaktivitas', $search); 
            $this->db->or_like('kdeperan', $search); 
            $this->db->or_like('nmaperan', $search); 
            $this->db->or_like('jnspeg', $search); 
            return $this->db->get("tbperan")->num_rows();   
        }
        //End Peran ------------------------------------------------------------------------

        //Unit Kerja -----------------------------------------------------------------------
        function unitKerjaFilter($search, $limit, $start, $order_field, $order_ascdesc){
            $this->db->like('kdeukerja', $search); 
            $this->db->or_like('nmaukerja', $search); 
            $this->db->or_like('akronim', $search); 
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get("tmukerja")->result_array();
        }

        function countAllUnitKerja(){
            return $this->db->count_all("tmukerja");
        }
        
        function countFilterUnitKerja($search){
            $this->db->like('kdeukerja', $search); 
            $this->db->or_like('nmaukerja', $search); 
            $this->db->or_like('akronim', $search); 
            return $this->db->get("tmukerja")->num_rows();   
        }
        //End Unit Kerja -------------------------------------------------------------------

        //Satuan Kerja ---------------------------------------------------------------------
        function satuanKerjaFilter($search, $limit, $start, $order_field, $order_ascdesc){
            $this->db->like('kdeukerja', $search); 
            $this->db->or_like('kdesatker', $search); 
            $this->db->or_like('nmasatker', $search); 
            $this->db->or_like('jbtsatker', $search); 
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get("tmsatker")->result_array();
        }

        function countAllSatuanKerja(){
            return $this->db->count_all("tmsatker");
        }
        
        function countFilterSatuanKerja($search){
            $this->db->like('kdeukerja', $search); 
            $this->db->or_like('kdesatker', $search); 
            $this->db->or_like('nmasatker', $search); 
            $this->db->or_like('jbtsatker', $search);  
            return $this->db->get("tmsatker")->num_rows();   
        }
        //End Satuan Kerja -----------------------------------------------------------------

        //Unit Laporan ---------------------------------------------------------------------
        function unitLaporanFilter($search, $limit, $start, $order_field, $order_ascdesc){
            $this->db->like('kdeulapor', $search); 
            $this->db->or_like('nmaulapor', $search); 
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get("tmulapor")->result_array();
        }

        function countAllUnitLaporan(){
            return $this->db->count_all("tmulapor");
        }
        
        function countFilterUnitLaporan($search){
            $this->db->like('kdeulapor', $search); 
            $this->db->or_like('nmaulapor', $search); 
            return $this->db->get("tmulapor")->num_rows();   
        }
        //End Unit Laporan -----------------------------------------------------------------
    }
?>