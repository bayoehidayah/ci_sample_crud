<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Model_pegawai extends CI_Model{

        //For CRUD
        function getJendik($jendik = ""){
            if($jendik != ""){return $this->db->get_where("tbjendik", ["jendik" => $jendik])->row_array();}
            else{return $this->db->get("tbjendik")->result();}
        }

        function getGolPns($golpns = ""){
            if($golpns != ""){return $this->db->get_where("tbgolpns", ["golpns" => $golpns])->row_array();}
            else{return $this->db->get("tbgolpns")->result();}
        }

        function getKdnPeg($kdnpeg = ""){
            if($kdnpeg != ""){return $this->db->get_where("tbkdnpeg", ["kdnpeg" => $kdnpeg])->row_array();}
            else{return $this->db->get("tbkdnpeg")->result();}
        }

        function getStsPeg($stspeg = ""){
            if($stspeg != ""){return $this->db->get_where("tbstspeg", ["kdestspeg" => $stspeg])->row_array();}
            else{return $this->db->get("tbstspeg")->result();}
        }

        function getJnsPeg($jnspeg = ""){
            if($jnspeg != ""){return $this->db->get_where("tbjnspeg", ["kdejnspeg" => $jnspeg])->row_array();}
            else{return $this->db->get("tbjnspeg")->result();}
        }

        function getNMajab($nmajab = ""){
            if($nmajab != ""){return $this->db->get_where("tbnmajab", ["kdenmajab" => $nmajab])->row_array();}
            else{return $this->db->get("tbnmajab")->result();}
        }

        function getKlsJab($klsjab = ""){
            if($klsjab != ""){return $this->db->get_where("tbklsjab", ["kdeklsjab" => $klsjab])->row_array();}
            else{return $this->db->get("tbklsjab")->result();}
        }

        function getJabAkad($kdejabakad = ""){
            if($kdejabakad != ""){return $this->db->get_where("tbjabakad", ["kdejabakad" => $kdejabakad])->row_array();}
            else{return $this->db->get("tbjabakad")->result();}
        }

        function getSatKer($satker = ""){
            if($satker != ""){return $this->db->get_where("tmsatker", ["kdesatker" => $satker])->row_array();}
            else{return $this->db->get("tmsatker")->result();}
        }

        function getUKerja($ukerja = ""){
            if($ukerja != ""){return $this->db->order_by("kdeukerja", "ASC")->get_where("tmukerja", ["kdeukerja" => $ukerja])->row_array();}
            else{return $this->db->order_by("kdeukerja", "ASC")->get("tmukerja")->result();}
        }

        function getULapor($ulapor = ""){
            if($ulapor != ""){return $this->db->get_where("tmulapor", ["kdeulapor" => $ulapor])->row_array();}
            else{return $this->db->get("tmulapor")->result();}
        }

        //Pegawai Remun Unimed
        function checkPegawaiRem($kdepeg){
            $check = $this->db->get_where("tmpegrem", ["kdepeg" => $kdepeg])->num_rows();
            if($check > 0){
                return true;
            }
            else{
                return false;
            }
        }

        function checkIdPegawaiRem($idi){
            $check = $this->db->get_where("tmpegrem", ["idi" => $idi])->num_rows();
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

        function getIdPegawaiRem($idi = ""){
            if($idi != ""){
                return $this->db->get_where("tmpegrem", ["idi" => $idi])->row_array();
            }
            else{
                return $this->db->order_by("kdepeg", "ASC")->get("tmpegrem")->result();
            }
        }

        function pegawaiRemFilter($search, $limit, $start, $order_field, $order_ascdesc){
            $this->db->like('kdepeg', $search); 
            $this->db->or_like('nip', $search); 
            $this->db->or_like('nmapanjang', $search); 
            $this->db->or_like('gender', $search); 
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get("tmpegrem")->result_array();
        }

        function countAllPegawaiRem(){
            return $this->db->count_all("tmpegrem");
        }

        function countFilterPegawaiRem($search){
            $this->db->like('kdepeg', $search); 
            $this->db->or_like('nip', $search); 
            $this->db->or_like('nmapanjang', $search); 
            $this->db->or_like('gender', $search); 
            return $this->db->get("tmpegrem")->num_rows();   
        }
        
        //Pegawai Blu Unimed
        function checkPegawaiBlu($kdepeg){
            $check = $this->db->get_where("tmpegblu", ["kdepeg" => $kdepeg])->num_rows();
            if($check > 0){
                return true;
            }
            else{
                return false;
            }
        }

        function checkIdPegawaiBlu($idi){
            $check = $this->db->get_where("tmpegblu", ["idi" => $idi])->num_rows();
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

        function getIdPegawaiBlu($idi = ""){
            if($idi != ""){
                return $this->db->get_where("tmpegblu", ["idi" => $idi])->row_array();
            }
            else{
                return $this->db->order_by("kdepeg", "ASC")->get("tmpegblu")->result();
            }
        }

        function pegawaiBluFilter($search, $limit, $start, $order_field, $order_ascdesc){
            $this->db->like('kdepeg', $search); 
            $this->db->or_like('nip', $search); 
            $this->db->or_like('nmapanjang', $search); 
            $this->db->or_like('gender', $search); 
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get("tmpegblu")->result_array();
        }

        function countAllPegawaiBlu(){
            return $this->db->count_all("tmpegblu");
        }

        function countFilterPegawaiBlu($search){
            $this->db->like('kdepeg', $search); 
            $this->db->or_like('nip', $search); 
            $this->db->or_like('nmapanjang', $search); 
            $this->db->or_like('gender', $search); 
            return $this->db->get("tmpegblu")->num_rows();   
        }
        //End Pegawai Blu Unimed

        //Validator
        // function validatorFilter($search, $limit, $start, $order_field, $order_ascdesc){
        //     $this->db->like('kdepeg', $search); 
        //     $this->db->or_like('email', $search); 
        //     $this->db->order_by($order_field, $order_ascdesc);
        //     $this->db->limit($limit, $start);
        //     return $this->db->get_where("users", ["tipe" => "Validator"])->result_array();
        // }

        // function countAllValidator(){
        //     return $this->db->where("tipe", "Validator")->count_all("users");
        // }

        // function countFilterValidator($search){
        //     $this->db->like('kdepeg', $search); 
        //     $this->db->or_like('email', $search); 
        //     return $this->db->get_where("users", ["tipe" => "Validator"])->num_rows();   
        // }
        function getValidator($kdepeg = ""){
            if($kdepeg != ""){
                return $this->db
                    ->select("users.idi, users.kdepeg, users.kdeukerja, users.kdesatker, tmukerja.nmaukerja, tmsatker.nmasatker, tmpegblu.nmapanjang")
                    ->join("tmukerja", "tmukerja.kdeukerja=users.kdeukerja")
                    ->join("tmsatker", "tmsatker.kdesatker=users.kdesatker")
                    ->join("tmpegblu", "tmpegblu.kdepeg=users.kdepeg")
                    ->get_where("users", ["users.kdepeg" => $kdepeg, "users.tipe" => "Validator"])->row_array();
                }
                else{
                    return $this->db
                    ->select("users.idi, users.kdepeg, users.kdeukerja, users.kdesatker, tmukerja.nmaukerja, tmsatker.nmasatker, tmpegblu.nmapanjang")
                    ->join("tmukerja", "tmukerja.kdeukerja=users.kdeukerja")
                    ->join("tmsatker", "tmsatker.kdesatker=users.kdesatker")
                    ->join("tmpegblu", "tmpegblu.kdepeg=users.kdepeg")
                    ->get_where("users", ["users.tipe" => "Validator"])->result();
            }
        }
        //End Validator
    }
?>
