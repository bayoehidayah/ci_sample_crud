<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Model_remun extends CI_Model{

        //Set Up Periode -----------------------------------------------------------------
        function checkPeriode($id){
            $check = $this->db->get_where("tr_periode", ["idi" => $id])->num_rows();
            if($check > 0){
                return true;
            }
            else{
                return false;
            }
        }

        function getPeriode($id = ""){
            if($id != ""){
                return $this->db->get_where("tr_periode", ["idi" => $id])->row_array();
            }
            else{
                return $this->db->get("tr_periode")->result();
            }
        }
        
        function checkPegawaiRem($kdepeg){
            $check = $this->db->get_where("tmpegrem", ["kdepeg" => $kdepeg])->num_rows();
            if($check > 0){
                return true;
            }
            else{
                return false;
            }
        }
        
        function getPegawaiRem($kdepeg = ""){
            if($kdepeg != ""){
                return $this->db->get_where("tmpegrem", ["kdepeg" => $kdepeg])->row_array();
            }
            else{
                return $this->db->order_by("kdepeg", "ASC")->get("tmpegrem")->result();
            }
        }
        
        function checkPegawaiBlu($kdepeg){
            $check = $this->db->get_where("tmpegblu", ["kdepeg" => $kdepeg])->num_rows();
            if($check > 0){
                return true;
            }
            else{
                return false;
            }
        }

        function getPegawaiBlu($kdepeg = ""){
            if($kdepeg != ""){
                return $this->db->get_where("tmpegblu", ["kdepeg" => $kdepeg])->row_array();
            }
            else{
                return $this->db->order_by("kdepeg", "ASC")->get("tmpegblu")->result();
            }
        }
        //End Set Up Periode --------------------------------------------------------------
        
        //Dokumen Pendukung ---------------------------------------------------------------
        function checkDokumen($id){
            $check = $this->db->get_where("tr_dokumen", ["idi" => $id])->num_rows();
            if($check > 0){return true;}
            else{return false;}
        }
        
        function getDokumen($id = ""){
            if($id != ""){
                return $this->db->get_where("tr_dokumen", ["idi" => $id])->row_array();
            }
            else{
                return $this->db->get("tr_dokumen")->result();
            }
        }

        function getDokumenUdi($udi){
            return $this->db->get_where("tr_dokumen", ["udi" => $udi])->row_array();
        }
        
        function getUnitKerja($id = ""){
            if($id != ""){
                return $this->db->get_where("tmukerja", ["idi" => $id])->row_array();
            }
            else{
                return $this->db->get("tmukerja")->result();
            }
        }

        function getSatuanKerja($id = ""){
            if($id != ""){
                return $this->db->get_where("tmsatker", ["idi" => $id])->row_array();
            }
            else{
                return $this->db->get("tmsatker")->result();
            }
        }

        function getPekerjaan($id = ""){
            if($id != ""){
                return $this->db->get_where("tbpekerjaan", ["idi" => $id])->row_array();
            }
            else{
                return $this->db->get("tbpekerjaan")->result();
            }
        }

        //End Dokumen Pendukung -----------------------------------------------------------
    }
?>