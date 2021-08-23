<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Referensi extends CI_Controller{

        private $currentTime;
        private $kdepeg;

        function __construct(){
            parent::__construct();
            check_session();
            date_default_timezone_set("Asia/Jakarta");
            $this->currentTime = date("Y-m-d H:i:s");
            $this->kdepeg = $this->session->userdata("kdepeg");
            if($this->session->userdata("tipe") != "Super"){
                redirect(base_url());
            }
        }

        function dataPegawai(){
            $kdepeg = $this->input->post("kdepeg");
            if($this->model_pegawai->checkPegawaiRem($kdepeg)){
                $data['result'] = true;
                $data['pegawai'] = $this->model_pegawai->getPegawaiRem($kdepeg);
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Pegawai tidak diketahui";
            }
            echo json_encode($data);
        }

        //Kelompok Jabatan ---------------------------------------------------------
        function kelompokJabatan(){
            $data['page_title'] = "Tabel Kelompok Jabatan - Tabel Referensi";
            $data['topbar_title'] = "Tabel Kelompok Jabatan";
            $data['bread'] = [
                [false, "Tabel Referensi", "javascript:void(0);"],
                [true, "Tabel Kelompok Jabatan", "javascript:void(0);"]
            ];
            $data['count_keljab'] = $this->model_referensi->countAllKelJab(); 
            $data['js'] = APPPATH."views/referensi/kelompok_jabatan/kelompok_jabatan_js.php";
            $this->themes->primary("referensi/kelompok_jabatan/kelompok_jabatan", $data);
        }

        function kelompokJabatanBaru(){
            $data['page_title'] = "Tabel Kelompok Jabatan - Tabel Referensi";
            $data['topbar_title'] = "Tabel Kelompok Jabatan Baru";
            $data['bread'] = [
                [false, "Tabel Referensi", "javascript:void(0);"],
                [false, "Tabel Kelompok Jabatan", base_url("tabel-referensi/tabel-kelompok-jabatan")],
                [true, "Tabel Kelompok Jabatan Baru", "javascript:void(0);"]
            ];
            
            //For Form
            $data['edit'] = false;
            
            $data['js'] = APPPATH."views/referensi/kelompok_jabatan/kelompok_jabatan_form_js.php";
            $this->themes->primary("referensi/kelompok_jabatan/kelompok_jabatan_form", $data);
        }

        function editKelompokJabatan($id){
            if($this->model_referensi->checkData("tbkeljab", $id)){
                $dataKelJab = $this->model_referensi->getData("tbkeljab", $id);
                $data['page_title'] = "Tabel Kelompok Jabatan - Tabel Referensi";
                $data['topbar_title'] = "Edit Tabel Kelompok Jabatan ".$dataKelJab['kdekeljab'];
                $data['bread'] = [
                    [false, "Tabel Referensi", "javascript:void(0);"],
                    [false, "Tabel Kelompok Jabatan", base_url("tabel-referensi/tabel-kelompok-jabatan")],
                    [true, "Edit Tabel Kelompok Jabatan ".$dataKelJab['kdekeljab'], "javascript:void(0);"]
                ];
    
                //For Form
                $data['edit'] = true;
                $data['kelompokJabatan'] = $dataKelJab;
    
                $data['js'] = APPPATH."views/referensi/kelompok_jabatan/kelompok_jabatan_form_js.php";
                $this->themes->primary("referensi/kelompok_jabatan/kelompok_jabatan_form", $data);
            }
            else{
                $this->themes->error_404();
            }
        }

        function getDataKelJab(){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];

            $sql_total = $this->model_referensi->countAllKelJab(); 
            $sql_data = $this->model_referensi->kelJabFilter($search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_referensi->countFilterKelJab($search);

            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
        }

        function newKelompokJabatanBaru(){
            $kdekeljab = $this->input->post("kdekeljab");
            $nmakeljab = $this->input->post("nmakeljab");

            //Check if kode kelas jab is already exist
            $check = $this->db->get_where("tbkeljab", ["kdekeljab" => $kdekeljab])->num_rows();
            if($check > 0){
                $data['result'] = false;
                $data['msg'] = "Tidak bisa menyimpan data ketika terdapat kode kelompok jabatan yang sudah ada";
            }
            else{
                $set = [
                    "kdekeljab" => $kdekeljab,
                    "nmakeljab" => $nmakeljab
                ];

                $insert = $this->db->insert("tbkeljab", $set);
                if($insert){
                    $data['result'] = true;
                    $data['msg'] = "Kelompok jabatan telah berhasil disimpan";
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Terjadi kesalahan dalam menyimpan data";
                }
            }
            echo json_encode($data);
        }

        function updateKelompokJabatan($id){
            if($this->model_referensi->checkData("tbkeljab", $id)){
                $dataKelJab = $this->model_referensi->getData("tbkeljab", $id);
                $kdekeljab = $dataKelJab['kdekeljab'];
                $nmakeljab = $this->input->post("nmakeljab");
    
                $set = [
                    "nmakeljab" => $nmakeljab
                ];

                $update = $this->db->update("tbkeljab", $set, ["idi" => $id, "kdekeljab" => $kdekeljab]);
                if($update){
                    $data['result'] = true;
                    $data['msg'] = "Kelompok jabatan telah berhasil diperbarui";
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Terjadi kesalahan dalam memperbarui data";
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Kelompok jabatan tidak diketahui";
            }
            echo json_encode($data);
        }

        function delKelompokJabatan($id){
            if($this->model_referensi->checkData("tbkeljab", $id)){
                $dataKelJab = $this->model_referensi->getData("tbkeljab", $id);
                //Check jika kelompok jabatan digunakan
                $check = $this->db->get_where("tbnmajab", ["kdekeljab" => $dataKelJab['kdekeljab']])->num_rows();
                if($check > 0){
                    $data['result'] = false;
                    $data['msg'] = "Kelompok jabatan tersebut sedang digunakan";
                }
                else{
                    $delete = $this->db->delete("tbkeljab", ["idi" => $id, "kdekeljab" => $dataKelJab['kdekeljab']]);
                    if($delete){
                        $data['result'] = true;
                    }
                    else{
                        $data['result'] = false;
                        $data['msg'] = "Terjadi kesalahan dalam menghapus kelompok jabatan";
                    }
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Kelompok jabatan tidak diketahui";
            }
            echo json_encode($data);
        }
        //End Kelompok Jabatan ---------------------------------------------------------

        //Kelompok Nama Jabatan --------------------------------------------------------
        function kelompokNamaJabatan(){
            $data['page_title'] = "Tabel Kelompok Nama Jabatan - Tabel Referensi";
            $data['topbar_title'] = "Tabel Kelompok Nama Jabatan";
            $data['bread'] = [
                [false, "Tabel Referensi", "javascript:void(0);"],
                [true, "Tabel Kelompok Nama Jabatan", "javascript:void(0);"]
            ];
            $data['count_kelnamajab'] = $this->model_referensi->countAllKelNamaJab(); 
            $data['js'] = APPPATH."views/referensi/kelompok_nama_jabatan/kelompok_nama_jabatan_js.php";
            $this->themes->primary("referensi/kelompok_nama_jabatan/kelompok_nama_jabatan", $data);
        }

        function kelompokNamaJabatanBaru(){
            $data['page_title'] = "Tabel Kelompok Nama Jabatan - Tabel Referensi";
            $data['topbar_title'] = "Tabel Kelompok Nama Jabatan Baru";
            $data['bread'] = [
                [false, "Tabel Referensi", "javascript:void(0);"],
                [false, "Tabel Kelompok Nama Jabatan", base_url("tabel-referensi/tabel-kelompok-nama-jabatan")],
                [true, "Tabel Kelompok Nama Jabatan Baru", "javascript:void(0);"]
            ];

            //For Form
            $data['edit'] = false;
            $data['keljab'] = $this->model_referensi->getData("tbkeljab");

            $data['js'] = APPPATH."views/referensi/kelompok_nama_jabatan/kelompok_nama_jabatan_form_js.php";
            $this->themes->primary("referensi/kelompok_nama_jabatan/kelompok_nama_jabatan_form", $data);
        }

        function editKelompokNamaJabatan($id){
            if($this->model_referensi->checkData("tbnmajab", $id)){
                $dataKelNamaJab = $this->model_referensi->getData("tbnmajab", $id);
                $data['page_title'] = "Tabel Kelompok Nama Jabatan - Tabel Referensi";
                $data['topbar_title'] = "Edit Tabel Kelompok Nama Jabatan ".$dataKelNamaJab['kdenmajab'];
                $data['bread'] = [
                    [false, "Tabel Referensi", "javascript:void(0);"],
                    [false, "Tabel Kelompok Nama Jabatan", base_url("tabel-referensi/tabel-kelompok-nama-jabatan")],
                    [true, "Edit Tabel Kelompok Nama Jabatan ".$dataKelNamaJab['kdenmajab'], "javascript:void(0);"]
                ];
    
                //For Form
                $data['edit'] = true;
                $data['kelompokNamaJabatan'] = $dataKelNamaJab;
                $data['keljab'] = $this->model_referensi->getData("tbkeljab");
    
                $data['js'] = APPPATH."views/referensi/kelompok_nama_jabatan/kelompok_nama_jabatan_form_js.php";
                $this->themes->primary("referensi/kelompok_nama_jabatan/kelompok_nama_jabatan_form", $data);
            }
            else{
                $this->themes->error_404();
            }
        }

        function getDataKelNamaJab(){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];

            $sql_total = $this->model_referensi->countAllKelNamaJab(); 
            $sql_data = $this->model_referensi->kelNamaJabFilter($search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_referensi->countFilterKelNamaJab($search);

            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
        }

        function newKelompokNamaJabatanBaru(){
            $kdekeljab = $this->input->post("kdekeljab");
            $kdenmajab = $this->input->post("kdenmajab");
            $nmajab = $this->input->post("nmajab");

            //Check if already exist
            $check = $this->db->get_where("tbnmajab", ["kdenmajab" => $kdenmajab])->num_rows();
            if($check > 0){
                $data['result'] = false;
                $data['msg'] = "Tidak bisa menyimpan data ketika terdapat kode kelompok nama jabatan yang sudah ada";
            }
            else{
                $set = [
                    "kdekeljab" => $kdekeljab,
                    "kdenmajab" => $kdenmajab,
                    "nmajab" => $nmajab
                ];

                $insert = $this->db->insert("tbnmajab", $set);
                if($insert){
                    $data['result'] = true;
                    $data['msg'] = "Kelompok nama jabatan telah berhasil disimpan";
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Terjadi kesalahan dalam menyimpan data";
                }
            }
            echo json_encode($data);
        }

        function updateKelompokNamaJabatan($id){
            if($this->model_referensi->checkData("tbnmajab", $id)){
                $dataKelNamaJab = $this->model_referensi->getData("tbnmajab", $id);
                
                $kdekeljab = $this->input->post("kdekeljab");
                $kdenmajab = $dataKelNamaJab['kdenmajab'];
                $nmajab = $this->input->post("nmajab");
    
                $set = [
                    "kdekeljab" => $kdekeljab,
                    "nmajab" => $nmajab
                ];

                $update = $this->db->update("tbnmajab", $set, ["idi" => $id, "kdenmajab" => $kdenmajab]);
                if($update){
                    $data['result'] = true;
                    $data['msg'] = "Kelompok nama jabatan telah berhasil diperbarui";
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Terjadi kesalahan dalam memperbarui data";
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Kelompok nama jabatan tidak diketahui";
            }
            echo json_encode($data);
        }

        function delKelompokNamaJabatan($id){
            if($this->model_referensi->checkData("tbnmajab", $id)){
                $dataKelNamaJab = $this->model_referensi->getData("tbnmajab", $id);
                $kdenmajab = $dataKelNamaJab['kdenmajab'];
                $check = $this->db->get_where("tmpegrem", ["kdenmajab" => $kdenmajab])->num_rows();
                if($check > 0){
                    $data['result'] = false;
                    $data['msg'] = "Kelompok nama jabatan tersebut sedang digunakan";
                }
                else{
                    $delete = $this->db->delete("tbnmajab", ["idi" => $id, "kdenmajab" => $kdenmajab]);
                    if($delete){
                        $data['result'] = true;
                    }
                    else{
                        $data['result'] = false;
                        $data['msg'] = "Terjadi kesalahan dalam menghapus kelompok nama jabatan";
                    }
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Kelompok nama jabatan tidak diketahui";
            }
            echo json_encode($data);
        }
        //End Kelompok  Nama Jabatan ---------------------------------------------------

        //Kelas Jabatan ----------------------------------------------------------------
        function kelasJabatan(){
            $data['page_title'] = "Tabel Kelas Jabatan - Tabel Referensi";
            $data['topbar_title'] = "Tabel Kelas Jabatan";
            $data['bread'] = [
                [false, "Tabel Referensi", "javascript:void(0);"],
                [true, "Tabel Kelas Jabatan", "javascript:void(0);"]
            ];
            $data['count_kelasjab'] = $this->model_referensi->countAllKelasJab(); 
            $data['js'] = APPPATH."views/referensi/kelas_jabatan/kelas_jabatan_js.php";
            $this->themes->primary("referensi/kelas_jabatan/kelas_jabatan", $data);
        }

        function kelasJabatanBaru(){
            $data['page_title'] = "Tabel Kelas Jabatan - Tabel Referensi";
            $data['topbar_title'] = "Tabel Kelas Jabatan Baru";
            $data['bread'] = [
                [false, "Tabel Referensi", "javascript:void(0);"],
                [false, "Tabel Kelas Jabatan", base_url("tabel-referensi/tabel-kelas-jabatan")],
                [true, "Tabel Kelas Jabatan Baru", "javascript:void(0);"]
            ];

            //For Form
            $data['edit'] = false;

            $data['js'] = APPPATH."views/referensi/kelas_jabatan/kelas_jabatan_form_js.php";
            $this->themes->primary("referensi/kelas_jabatan/kelas_jabatan_form", $data);
        
        }
        function editKelasJabatan($id){
            if($this->model_referensi->checkData("tbklsjab", $id)){
                $dataKelasJab = $this->model_referensi->getData("tbklsjab", $id);
                $data['page_title'] = "Tabel Kelas Jabatan - Tabel Referensi";
                $data['topbar_title'] = "Edit Tabel Kelas Jabatan ".$dataKelasJab['kdeklsjab'];
                $data['bread'] = [
                    [false, "Tabel Referensi", "javascript:void(0);"],
                    [false, "Tabel Kelas Jabatan", base_url("tabel-referensi/tabel-kelas-jabatan")],
                    [true, "Edit Tabel Kelas Jabatan ".$dataKelasJab['kdeklsjab'], "javascript:void(0);"]
                ];
    
                //For Form
                $data['edit'] = true;
                $data['kelasJabatan'] = $dataKelasJab;
    
                $data['js'] = APPPATH."views/referensi/kelas_jabatan/kelas_jabatan_form_js.php";
                $this->themes->primary("referensi/kelas_jabatan/kelas_jabatan_form", $data);
            }
            else{
                $this->themes->error_404();
            }
        }

        function getDataKelasJab(){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];

            $sql_total = $this->model_referensi->countAllKelasJab(); 
            $sql_data = $this->model_referensi->kelasJabFilter($search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_referensi->countFilterKelasJab($search);

            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
        }

        function newKelasJabatanBaru(){
            $kdeklsjab = $this->input->post("kdeklsjab");
            $nmaklsjab = $this->input->post("nmaklsjab");
            $sksklsjab = $this->input->post("sksklsjab");
            $grade = $this->input->post("grade");
            $nilaijabatan = $this->input->post("nilaijabatan");
            $koefisien = $this->input->post("koefisien");
            $pir = $this->input->post("pir");
            $nkp = $this->input->post("nkp");
            $hargaperpoin = $this->input->post("hargaperpoin");
            $pointstd = $this->input->post("pointstd");
            $pointmax = $this->input->post("pointmax");
            $skorjabmin = $this->input->post("skorjabmin");
            $skorjabmax = $this->input->post("skorjabmax");
            $hargajabmax = $this->input->post("hargajabmax");

            //Check kdeklsjab
            $check = $this->db->select("COUNT(*) as total")->get_where("tbklsjab", ["kdeklsjab" => $kdeklsjab])->row_array();
            if($check['total'] > 0){
                $data['result'] = false;
                $data['msg'] = "Tidak bisa menyimpan data ketika terdapat kode kelas jabatan yang sudah ada";
            }
            else{
                $set = [
                    "kdeklsjab" => $kdeklsjab,
                    "nmaklsjab" => $nmaklsjab,
                    "sksklsjab" => $sksklsjab,
                    "grade" => $grade,
                    "nilaijabatan" => $nilaijabatan,
                    "koefisien" => $koefisien,
                    "pir" => $pir,
                    "nkp" => $nkp,
                    "hargaperpoin" => $hargaperpoin,
                    "pointstd" => $pointstd,
                    "pointmax" => $pointmax,
                    "skorjabmin" => $skorjabmin,
                    "skorjabmax" => $skorjabmax,
                    "hargajabmax" => $hargajabmax
                ];

                $insert = $this->db->insert("tbklsjab", $set);
                if($insert){
                    $data['result'] = true;
                    $data['msg'] = "Kelas jabatan baru telah berhasil disimpan";
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Terjadi kesalahan dalam menyimpan data";
                }
            }
            echo json_encode($data);
        }   

        function updateKelasJabatan($id){
            if($this->model_referensi->checkData("tbklsjab", $id)){
                $dataKelasJab = $this->model_referensi->getData("tbklsjab", $id);
                $kdeklsjab = $dataKelasJab['kdeklsjab'];
                $nmaklsjab = $this->input->post("nmaklsjab");
                $sksklsjab = $this->input->post("sksklsjab");
                $grade = $this->input->post("grade");
                $nilaijabatan = $this->input->post("nilaijabatan");
                $koefisien = $this->input->post("koefisien");
                $pir = $this->input->post("pir");
                $nkp = $this->input->post("nkp");
                $hargaperpoin = $this->input->post("hargaperpoin");
                $pointstd = $this->input->post("pointstd");
                $pointmax = $this->input->post("pointmax");
                $skorjabmin = $this->input->post("skorjabmin");
                $skorjabmax = $this->input->post("skorjabmax");
                $hargajabmax = $this->input->post("hargajabmax");
    
                
                $set = [
                    "nmaklsjab" => $nmaklsjab,
                    "sksklsjab" => $sksklsjab,
                    "grade" => $grade,
                    "nilaijabatan" => $nilaijabatan,
                    "koefisien" => $koefisien,
                    "pir" => $pir,
                    "nkp" => $nkp,
                    "hargaperpoin" => $hargaperpoin,
                    "pointstd" => $pointstd,
                    "pointmax" => $pointmax,
                    "skorjabmin" => $skorjabmin,
                    "skorjabmax" => $skorjabmax,
                    "hargajabmax" => $hargajabmax
                ];

                $where = [
                    "idi" => $id,
                    "kdeklsjab" => $kdeklsjab
                ];

                $insert = $this->db->update("tbklsjab", $set, $where);
                if($insert){
                    $data['result'] = true;
                    $data['msg'] = "Kelas jabatan baru telah berhasil diperbarui";
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Terjadi kesalahan dalam memperbarui data";
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Kelas jabatan tidak diketahui";
            }
            echo json_encode($data);
        }   

        function delKelasJabatan($id){
            if($this->model_referensi->checkData("tbklsjab", $id)){
                $dataPegawai = $this->model_referensi->getData("tbklsjab", $id);
                //Check Pegawai
                $check = $this->db->select("COUNT(*) as total")->get_where("tmpegrem", ["kdeklsjab" => $dataPegawai['kdeklsjab']])->row_array();
                if($check['total'] > 0){
                    $data['result'] = false;
                    $data['msg'] = "Kelas jabatan tersebut sedang digunakan";
                }
                else{
                    $delete = $this->db->delete("tbklsjab", ["idi" => $id, "kdeklsjab" => $dataPegawai['kdeklsjab']]);
                    if($delete){
                        $data['result'] = true;
                    }
                    else{
                        $data['result'] = false;
                        $data['msg'] = "Terjadi kesalahan dalam menghapus kelas jabatan";
                    }
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Kelas jabatan tidak ketahui";
            }
            echo json_encode($data);
        }
        //End Kelas Jabatan -----------------------------------------------------------

        //Pekerjaan --------------------------------------------------------------------
        function pekerjaan(){
            $data['page_title'] = "Tabel Pekerjaan - Tabel Referensi";
            $data['topbar_title'] = "Tabel Pekerjaan";
            $data['bread'] = [
                [false, "Tabel Referensi", "javascript:void(0);"],
                [true, "Tabel Pekerjaan", "javascript:void(0);"]
            ];
            $data['count_pekerjaan'] = $this->model_referensi->countAllPekerjaan(); 
            $data['js'] = APPPATH."views/referensi/pekerjaan/pekerjaan_js.php";
            $this->themes->primary("referensi/pekerjaan/pekerjaan", $data);
        }

        function pekerjaanBaru(){
            $data['page_title'] = "Tabel Pekerjaan - Tabel Referensi";
            $data['topbar_title'] = "Tabel Pekerjaan Baru";
            $data['bread'] = [
                [false, "Tabel Referensi", "javascript:void(0);"],
                [false, "Tabel Pekerjaan", base_url("tabel-referensi/tabel-pekerjaan")],
                [true, "Tabel Pekerjaan Baru", "javascript:void(0);"]
            ];
            
            //For Form
            $data['edit'] = false;
            
            $data['js'] = APPPATH."views/referensi/pekerjaan/pekerjaan_form_js.php";
            $this->themes->primary("referensi/pekerjaan/pekerjaan_form", $data);
        }

        function editPekerjaan($id){
            if($this->model_referensi->checkData("tbpekerjaan", $id)){
                $dataPekerjaan = $this->model_referensi->getData("tbpekerjaan", $id);
                $data['page_title'] = "Tabel Pekerjaan - Tabel Referensi";
                $data['topbar_title'] = "Edit Tabel Pekerjaan ".$dataPekerjaan['kdepekerjaan'];
                $data['bread'] = [
                    [false, "Tabel Referensi", "javascript:void(0);"],
                    [false, "Tabel Pekerjaan", base_url("tabel-referensi/tabel-pekerjaan")],
                    [true, "Edit Tabel Pekerjaan ".$dataPekerjaan['kdepekerjaan'], "javascript:void(0);"]
                ];
                
                //For Form
                $data['edit'] = true;
                $data['pekerjaan'] = $dataPekerjaan;
                
                $data['js'] = APPPATH."views/referensi/pekerjaan/pekerjaan_form_js.php";
                $this->themes->primary("referensi/pekerjaan/pekerjaan_form", $data);
            }
            else{
                $this->themes->error_404();
            }
        }

        // Hi, saya developer yang membangun sistem ini dari awal hingga versi 1.6.Teruntuk developer yang melanjutkan program ini.. selamat anda telah ditipu oleh bg irfan, ia memberikan pemanis pada awal-awal.. ketika sudah berjalan beberapa bulan anda akan menyesali dan mungkin anda akan mengalami hal yang sama dengan saya yaitu di MONOPOLI. Saya harap untuk developer selanjut nya yang mengembangkan aplikasi ini tidak tertipu seperti yang saya alami, silahkan jika anda percaya atau tidak.. ketika sudah berjalan bbrp bulan mungkin anda akan mengalami hal yang sama dengan saya

        function getDataPekerjaan(){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            
            $sql_total = $this->model_referensi->countAllPekerjaan(); 
            $sql_data = $this->model_referensi->pekerjaanFilter($search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_referensi->countFilterPekerjaan($search);
            
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
        }

        function newPekerjaanBaru(){
            $kdepekerjaan = $this->input->post("kdepekerjaan");
            $nmapekerjaan = $this->input->post("nmapekerjaan");

            //Check kode
            $check = $this->db->get_where("tbpekerjaan", ['kdepekerjaan' => $kdepekerjaan])->num_rows();
            if($check > 0){
                $data['result'] = false;
                $data['msg'] = "Tidak bisa menyimpan data ketika terdapat kode kelas jabatan yang sudah ada";
            }
            else{
                $set = [
                    "kdepekerjaan" => $kdepekerjaan,
                    "nmapekerjaan" => $nmapekerjaan
                ];

                $insert = $this->db->insert("tbpekerjaan", $set);
                if($insert){
                    $data['result'] = true;
                    $data['msg'] = "Pekerjaan telah berhasil disimpan";
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Terjadi kesalahan dalam menyimpan data";
                }
            }

            echo json_encode($data);
        }

        function updatePekerjaan($id){
            if($this->model_referensi->checkData("tbpekerjaan", $id)){
                $dataPekerjaan = $this->model_referensi->getData("tbpekerjaan", $id);
                $kdepekerjaan = $dataPekerjaan['kdepekerjaan'];
                $nmapekerjaan = $this->input->post("nmapekerjaan");

                $update = $this->db->update("tbpekerjaan", [
                    'nmapekerjaan' => $nmapekerjaan
                ], [
                    "idi" => $id,
                    "kdepekerjaan" => $kdepekerjaan
                ]);
                if($update){
                    $data['result'] = true;
                    $data['msg'] = "Pekerjaan telah berhasil diperbarui";
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Terjadi kesalahan dalam memperbarui data";
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Pekerjaan tidak diketahui";
            }
            echo json_encode($data);
        }

        function delPekerjaan($id){
            if($this->model_referensi->checkData("tbpekerjaan", $id)){
                $dataPekerjaan = $this->model_referensi->getData("tbpekerjaan", $id);
                $kdepekerjaan = $dataPekerjaan['kdepekerjaan'];
                //Check Pemakaian
                $check = $this->db->get_where("tbaktivitas", ["kdepekerjaan" => $kdepekerjaan])->num_rows();
                if($check > 0){
                    $data['result'] = false;
                    $data['msg'] = "Pekerjaan tersebut sedang digunakan";
                }
                else{
                    $delete = $this->db->delete("tbpekerjaan", ["idi" => $id, "kdepekerjaan" => $kdepekerjaan]);
                    if($delete){
                        $data['result'] = true;
                    }
                    else{
                        $data['result'] = true;
                        $data['msg'] = "Terjadi kesalahan dalam menghapus pekerjaan";
                    }
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Pekerjaan tidak diketahui";
            }
            echo json_encode($data);
        }
        //Emd Pekerjaan ----------------------------------------------------------------

        //Aktivitas --------------------------------------------------------------------
        function aktivitas(){
            $data['page_title'] = "Tabel Aktivitas - Tabel Referensi";
            $data['topbar_title'] = "Tabel Aktivitas";
            $data['bread'] = [
                [false, "Tabel Referensi", "javascript:void(0);"],
                [true, "Tabel Aktivitas", "javascript:void(0);"]
            ];
            $data['count_aktivitas'] = $this->model_referensi->countAllAktivitas(); 
            $data['js'] = APPPATH."views/referensi/aktivitas/aktivitas_js.php";
            $this->themes->primary("referensi/aktivitas/aktivitas", $data);
        }

        function aktivitasBaru(){
            $data['page_title'] = "Tabel Aktivitas - Tabel Referensi";
            $data['topbar_title'] = "Tabel Aktivitas Baru";
            $data['bread'] = [
                [false, "Tabel Referensi", "javascript:void(0);"],
                [false, "Tabel Aktivitas", base_url("tabel-referensi/tabel-aktivitas")],
                [true, "Tabel Aktivitas Baru", "javascript:void(0);"]
            ];
            
            //For Form
            $data['edit'] = false;
            $data['pekerjaan'] = $this->model_referensi->getData("tbpekerjaan");
            
            $data['js'] = APPPATH."views/referensi/aktivitas/aktivitas_form_js.php";
            $this->themes->primary("referensi/aktivitas/aktivitas_form", $data);
        }

        function editAktivitas($id){
            if($this->model_referensi->checkData("tbaktivitas", $id)){
                $dataAktivitas = $this->model_referensi->getData("tbaktivitas", $id);
                $data['page_title'] = "Tabel Aktivitas - Tabel Referensi";
                $data['topbar_title'] = "Edit Tabel Aktivitas ".$dataAktivitas['kdeaktivitas'];
                $data['bread'] = [
                    [false, "Tabel Referensi", "javascript:void(0);"],
                    [false, "Tabel Aktivitas", base_url("tabel-referensi/tabel-aktivitas")],
                    [true, "Edit Tabel Aktivitas ".$dataAktivitas['kdeaktivitas'], "javascript:void(0);"]
                ];
                
                //For Form
                $data['edit'] = true;
                $data['pekerjaan'] = $this->model_referensi->getData("tbpekerjaan");
                $data['aktivitas'] = $dataAktivitas;
                
                $data['js'] = APPPATH."views/referensi/aktivitas/aktivitas_form_js.php";
                $this->themes->primary("referensi/aktivitas/aktivitas_form", $data);
            }
            else{
                $this->themes->error_404();
            }
        }

        function newAktivitasBaru(){
            $kdepekerjaan = $this->input->post("kdepekerjaan");
            $kdeaktivitas = $this->input->post('kdeaktivitas');
            $nmaaktivitas = $this->input->post("nmaaktivitas");

            //Check Kode Aktivitas
            $check = $this->db->get_where("tbaktivitas", ["kdeaktivitas" => $kdeaktivitas])->num_rows();
            if($check > 0){
                $data['result'] = true;
                $data['msg'] = "Tidak bisa menyimpan data ketika terdapat kode aktivitas yang sudah ada";
            }
            else{
                $set = [
                    "kdepekerjaan" => $kdepekerjaan,
                    "kdeaktivitas" => $kdeaktivitas,
                    "nmaaktivitas" => $nmaaktivitas,
                    "rubrik" => ""
                ];

                $insert = $this->db->insert("tbaktivitas", $set);
                if($insert){
                    $data['result'] = true;
                    $data['msg'] = "Aktivitas telah berhasil disimpan";
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Terjadi kesalahan dalam menyimpan data";
                }
            }
            echo json_encode($data);
        }

        function updateAktivitas($id){
            if($this->model_referensi->checkData("tbaktivitas", $id)){
                $dataAktivitas = $this->model_referensi->getData("tbaktivitas", $id);
                $kdepekerjaan = $this->input->post("kdepekerjaan");
                $kdeaktivitas = $dataAktivitas['kdeaktivitas'];
                $nmaaktivitas = $this->input->post("nmaaktivitas");
    
                $set = [
                    "kdepekerjaan" => $kdepekerjaan,
                    "nmaaktivitas" => $nmaaktivitas,
                    "rubrik" => ""
                ];

                $update = $this->db->update("tbaktivitas", $set, ["kdeaktivitas" => $kdeaktivitas]);
                if($update){
                    $data['result'] = true;
                    $data['msg'] = "Aktivitas telah berhasil diperbarui";
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Terjadi kesalahan dalam memperbarui data";
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Aktivitas tidak diketahui";
            }
            echo json_encode($data);
        }

        function getDataAktivitas(){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            
            $sql_total = $this->model_referensi->countAllAktivitas(); 
            $sql_data = $this->model_referensi->aktivitasFilter($search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_referensi->countFilterAktivitas($search);
            
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
        }

        function delAktivitas($id){
            if($this->model_referensi->checkData("tbaktivitas", $id)){
                $dataAktivitas = $this->model_referensi->getData("tbaktivitas", $id);
                $kdeaktivitas = $dataAktivitas['kdeaktivitas'];
                //Check Pemakaian
                $check = $this->db->get_where("tbperan", ["kdeaktivitas" => $kdeaktivitas])->num_rows();
                if($check > 0){
                    $data['result'] = false;
                    $data['msg'] = "Aktivitas tersebut sedang digunakan";
                }
                else{
                    $delete = $this->db->delete("tbaktivitas", ["idi" => $id, "kdeaktivitas" => $kdeaktivitas]);
                    if($delete){
                        $data['result'] = true;
                    }
                    else{
                        $data['result'] = true;
                        $data['msg'] = "Terjadi kesalahan dalam menghapus aktivitas";
                    }
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Aktivitas tidak diketahui";
            }
            echo json_encode($data);
        }
        //End Aktivitas ----------------------------------------------------------------

        //Peran ------------------------------------------------------------------------
        function peran(){
            $data['page_title'] = "Tabel Peran - Tabel Referensi";
            $data['topbar_title'] = "Tabel Peran";
            $data['bread'] = [
                [false, "Tabel Referensi", "javascript:void(0);"],
                [true, "Tabel Peran", "javascript:void(0);"]
            ];
            $data['count_peran'] = $this->model_referensi->countAllPeran(); 
            $data['js'] = APPPATH."views/referensi/peran/peran_js.php";
            $this->themes->primary("referensi/peran/peran", $data);
        }

        function peranBaru(){
            $data['page_title'] = "Tabel Peran - Tabel Referensi";
            $data['topbar_title'] = "Tabel Peran Baru";
            $data['bread'] = [
                [false, "Tabel Referensi", "javascript:void(0);"],
                [false, "Tabel Peran", base_url("tabel-referensi/tabel-peran")],
                [true, "Tabel Peran Baru", "javascript:void(0);"]
            ];
            
            //For Form
            $data['edit'] = false;
            $data['aktivitas'] = $this->model_referensi->getData("tbaktivitas");
            
            $data['js'] = APPPATH."views/referensi/peran/peran_form_js.php";
            $this->themes->primary("referensi/peran/peran_form", $data);
        }

        function editPeran($id){
            if($this->model_referensi->checkData("tbperan", $id)){
                $dataPeran = $this->model_referensi->getData("tbperan", $id);
                $data['page_title'] = "Tabel Peran - Tabel Referensi";
                $data['topbar_title'] = "Edit Tabel Peran ".$dataPeran['kdeperan'];
                $data['bread'] = [
                    [false, "Tabel Referensi", "javascript:void(0);"],
                    [false, "Tabel Peran", base_url("tabel-referensi/tabel-peran")],
                    [true, "Edit Tabel Peran ".$dataPeran['kdeperan'], "javascript:void(0);"]
                ];
                
                //For Form
                $data['edit'] = true;
                $data['peran'] = $dataPeran;
                $data['aktivitas'] = $this->model_referensi->getData("tbaktivitas");
                
                $data['js'] = APPPATH."views/referensi/peran/peran_form_js.php";
                $this->themes->primary("referensi/peran/peran_form", $data);
            }
            else{
                $this->themes->error_404();
            }
        }

        function getDataPeran(){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            
            $sql_total = $this->model_referensi->countAllPeran(); 
            $sql_data = $this->model_referensi->peranFilter($search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_referensi->countFilterPeran($search);
            
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
        }

        function newPeranBaru(){
            $kdeaktivitas = $this->input->post("kdeaktivitas");
            $kdeperan = $this->input->post("kdeperan");
            $nmaperan = $this->input->post("nmaperan");
            $jnspeg = $this->input->post("jnspeg");
            $beban = $this->input->post("beban");
            $satuan = $this->input->post("satuan");
            $ewkp = $this->input->post("ewkp");
            $ewmp = $this->input->post("ewmp");

            //Check Kode Peran
            $check = $this->db->get_where("tbperan", ["kdeperan" => $kdeperan])->num_rows();
            if($check > 0){
                $data['result'] = false;
                $data['msg'] = "Tidak bisa menyimpan data ketika terdapat kode aktivitas yang sudah ada";
            }
            else{
                $set = [
                    "kdeaktivitas" => $kdeaktivitas,
                    "kdeperan" => $kdeperan,
                    "nmaperan" => $nmaperan,
                    "jnspeg" => $jnspeg,
                    "beban" => $beban,
                    "satuan" => $satuan,
                    "ewkp" => $ewkp,
                    "ewmp" => $ewmp
                ];

                $insert = $this->db->insert("tbperan", $set);
                if($insert){
                    $data['result'] = true;
                    $data['msg'] = "Peran telah berhasil disimpan";
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Terjadi kesalahan dalam menyimpan data";
                }
            }
            echo json_encode($data);
        }

        function updatePeran($id){
            if($this->model_referensi->checkData("tbperan", $id)){
                $dataPeran = $this->model_referensi->getData("tbperan", $id);
                $kdeperan = $dataPeran['kdeperan'];
                $kdeaktivitas = $this->input->post("kdeaktivitas");
                $nmaperan = $this->input->post("nmaperan");
                $jnspeg = $this->input->post("jnspeg");
                $beban = $this->input->post("beban");
                $satuan = $this->input->post("satuan");
                $ewkp = $this->input->post("ewkp");
                $ewmp = $this->input->post("ewmp");
    
                $set = [
                    "kdeaktivitas" => $kdeaktivitas,
                    "nmaperan" => $nmaperan,
                    "jnspeg" => $jnspeg,
                    "beban" => $beban,
                    "satuan" => $satuan,
                    "ewkp" => $ewkp,
                    "ewmp" => $ewmp
                ];

                $update = $this->db->update("tbperan", $set, ["idi" => $id, "kdeperan" => $kdeperan]);
                if($update){
                    $data['result'] = true;
                    $data['msg'] = "Peran telah berhasil diperbarui";
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Terjadi kesalahan dalam memperbarui data";
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Peran tidak diketahui";
            }
            echo json_encode($data);
        }

        function delPeran($id){
            if($this->model_referensi->checkData("tbperan", $id)){
                $dataPeran = $this->model_referensi->getData("tbperan", $id);
                $kdeperan = $dataPeran['kdeperan'];
                //Check penggunaan peran di transaksi
                $whereCheck['kdeperan'] = $kdeperan;
                $check = [
                    "tusi" => $this->db->get_where("tr10_tusi", $whereCheck)->num_rows(),
                    "mengajar" => $this->db->get_where("tr21_pendikajar", $whereCheck)->num_rows(),
                    "mengajar_lainnya" => $this->db->get_where("tr22_pendikinst", $whereCheck)->num_rows(),
                    "penelitian" => $this->db->get_where("tr31_penlit", $whereCheck)->num_rows(),
                    "pengabdian" => $this->db->get_where("tr32_pengabdian", $whereCheck)->num_rows(),
                    "penghargaan" => $this->db->get_where("tr40_penghargaan", $whereCheck)->num_rows(),
                    "penunjang" => $this->db->get_where("tr50_penunjang", $whereCheck)->num_rows()
                ];

                if($check['tusi'] > 0 || $check['mengajar'] > 0 || $check['mengajar_lainnya'] > 0 || $check['penelitian'] > 0 || $check['pengadian'] > 0 || $check['penghargaan'] > 0 || $check['penunjang'] > 0){
                    $data['result'] = false;
                    $data['msg'] = "Peran tersebut sedang digunakan";
                }   
                else{
                    $where['idi'] = $id;
                    $delete = $this->db->delete("tbperan", $where);
                    if($delete){
                        $data['result'] = true;
                    }
                    else{
                        $data['result'] = false;
                        $data['msg'] = "Terjadi kesalahan dalam menghapus peran";
                    }
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Peran tidak diketahui";
            }
            echo json_encode($data);
        }
        //End Peran -------------------------------------------------------------------

        //Unit Kerja ------------------------------------------------------------------
        function unitKerja(){
            $data['page_title'] = "Tabel Unit Kerja - Tabel Referensi";
            $data['topbar_title'] = "Tabel Unit Kerja";
            $data['bread'] = [
                [false, "Tabel Referensi", "javascript:void(0);"],
                [true, "Tabel Unit Kerja", "javascript:void(0);"]
            ];
            $data['count_unit_kerja'] = $this->model_referensi->countAllUnitKerja(); 
            $data['js'] = APPPATH."views/referensi/unit_kerja/unit_kerja_js.php";
            $this->themes->primary("referensi/unit_kerja/unit_kerja", $data);
        }

        function unitKerjaBaru(){
            $data['page_title'] = "Tabel Unit Kerja - Tabel Referensi";
            $data['topbar_title'] = "Tabel Unit Kerja Baru";
            $data['bread'] = [
                [false, "Tabel Referensi", "javascript:void(0);"],
                [false, "Tabel Unit Kerja", base_url("tabel-referensi/tabel-unit-kerja")],
                [true, "Tabel Unit Kerja Baru", "javascript:void(0);"]
            ];
            
            //For Form
            $data['edit'] = false;
            $data['pegawai'] = $this->model_pegawai->getPegawaiRem();
            
            $data['js'] = APPPATH."views/referensi/unit_kerja/unit_kerja_form_js.php";
            $this->themes->primary("referensi/unit_kerja/unit_kerja_form", $data);
        }
        
        function editUnitKerja($id){
            if($this->model_referensi->checkData("tmukerja", $id)){
                $dataUnitKerja = $this->model_referensi->getData("tmukerja", $id);
                $data['page_title'] = "Tabel Unit Kerja - Tabel Referensi";
                $data['topbar_title'] = "Edit Tabel Unit Kerja ".$dataUnitKerja['kdeukerja'];
                $data['bread'] = [
                    [false, "Tabel Referensi", "javascript:void(0);"],
                    [false, "Tabel Unit Kerja", base_url("tabel-referensi/tabel-unit-kerja")],
                    [true, "Edit Tabel Unit Kerja ".$dataUnitKerja['kdeukerja'], "javascript:void(0);"]
                ];
                
                //For Form
                $data['edit'] = true;
                $data['unitKerja'] = $dataUnitKerja;
                $data['pegawai'] = $this->model_pegawai->getPegawaiRem();
                
                $data['js'] = APPPATH."views/referensi/unit_kerja/unit_kerja_form_js.php";
                $this->themes->primary("referensi/unit_kerja/unit_kerja_form", $data);
            }
            else{
                $this->themes->error_404();
            }
        }

        function getDataUnitKerja(){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            
            $sql_total = $this->model_referensi->countAllUnitKerja(); 
            $sql_data = $this->model_referensi->unitKerjaFilter($search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_referensi->countFilterUnitKerja($search);
            
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
        }

        function newUnitKerja(){
            if(!empty($_FILES['foto']['name'])){
                $uid = $this->uuid->v4(true);
                $config['upload_path'] = './assets/photos/referensi/unit_kerja/';
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_size'] = 1024;
                $config['file_name'] = $uid;
                $config["overwrite"] = true;

                $kdeukerja = $this->input->post("kdeukerja");

                //Checking Kode Unit Kerja
                $check = $this->db->get_where("tmukerja", ["kdeukerja" => $kdeukerja])->num_rows();
                if($check > 0){
                    $data['result'] = false;
                    $data['msg'] = "Tidak bisa menyimpan data ketika terdapat kode unit kerja yang sudah ada";
                }
                else{
                    $this->upload->initialize($config);
                    if($this->upload->do_upload("foto")){
                        $hasil = $this->upload->data();
        
                        $file = $hasil['file_name'];
        
                        //Set Data
                        $set = [
                            "kdeukerja" => $kdeukerja,
                            "nmaukerja" => $this->input->post("nmaukerja"),
                            "akronim" => $this->input->post("akronim"),
                            "jabukerja" => $this->input->post("jabukerja"),
                            "nmapjb" => $this->input->post("nmapjb"),
                            "nippjb" => $this->input->post("nippjb"),
                            "tlppjb" => $this->input->post("tlppjb"),
                            "emlpjb" => $this->input->post("emlpjb"),
                            "pasfotopjb" => $file
                        ];
        
                        $inserting = $this->db->insert("tmukerja", $set);
                        if($inserting){
                            $data['result'] = true;
                            $data['msg'] = "Unit kerja telah berhasil disimpan";
                        }
                        else{
                            $data['result'] = false;
                            $data['msg'] = "Terjadi kesalahan dalam menyimpan unit kerja";
                        }
        
                    }
                    else{
                        $data['result'] = false;
                        // $data['msg'] = "Terjadi kesalahan dalam mengupload dokumen anda.";
                        $data['msg'] = $this->upload->display_errors();
                    }
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Harap menyertakan file foto anda";
            }
            echo json_encode($data);
        }

        function updateUnitKerja($id){
            if($this->model_referensi->checkData("tmukerja",$id)){
                $dataUnitKerja = $this->model_referensi->getData("tmukerja", $id);
                $kdeukerja = $dataUnitKerja['kdeukerja'];

                //Set Data
                $set = [
                    "kdeukerja" => $kdeukerja,
                    "nmaukerja" => $this->input->post("nmaukerja"),
                    "akronim" => $this->input->post("akronim"),
                    "jabukerja" => $this->input->post("jabukerja"),
                    "nmapjb" => $this->input->post("nmapjb"),
                    "nippjb" => $this->input->post("nippjb"),
                    "tlppjb" => $this->input->post("tlppjb"),
                    "emlpjb" => $this->input->post("emlpjb")
                ];

                if(empty($_FILES['foto']['name'])){
                    $this->db->update("tmukerja", $set, ["idi" => $id, "kdeukerja" => $kdeukerja]);
                    $data['result'] = true;
                    $data['msg'] = "Unit kerja telah berhasil diperbarui";
                }  
                else{
                    //Remove File Before Updating
                    if($dataUnitKerja['pasfotopjb'] != null || $dataUnitKerja['pasfotopjb'] != ""){
                        $foto = $dataUnitKerja['pasfotopjb'];
                        unlink('./assets/photos/referensi/unit_kerja/'.$foto);
                    }

                    $uid = $this->uuid->v4(true);
                    $config['upload_path'] = './assets/photos/referensi/unit_kerja/';
                    $config['allowed_types'] = 'jpeg|jpg|png';
                    $config['max_size'] = 1024;
                    $config['file_name'] = $uid;
                    $config["overwrite"] = true;

                    $this->upload->initialize($config);
                    if($this->upload->do_upload("foto")){
                        $hasil = $this->upload->data();
    
                        $set['pasfotopjb'] = $hasil['file_name'];
                        $this->db->update("tmukerja", $set, ["idi" => $id, "kdeukerja" => $kdeukerja]);
                        $data['result'] = true;
                        $data['msg'] = "Unit kerja telah berhasil diperbarui";
                    }
                    else{
                        $data['result'] = false;
                        $data['msg'] = $this->upload->display_errors();
                    }
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Terjadi kesalahan dalam memperbarui unit kerja";
            }

            echo json_encode($data);
        }

        function delUnitKerja($id){
            if($this->model_referensi->checkData("tmukerja", $id)){
                $dataUnitKerja = $this->model_referensi->getData("tmukerja", $id);
                $kdeukerja = $dataUnitKerja['kdeukerja'];

                //Check Pemakaian
                $check = $this->db->get_where("tmsatker", ["kdeukerja" => $kdeukerja])->num_rows();
                if($check > 0){
                    $data['result'] = false;
                    $data['msg'] = "Unit kerja sedang digunakan";
                }
                else{
                    if($dataUnitKerja['pasfotopjb'] != null || $dataUnitKerja['pasfotopjb'] != ""){
                        $foto = $dataUnitKerja['pasfotopjb'];
                        unlink('./assets/photos/referensi/unit_kerja/'.$foto);
                    }

                    $delete = $this->db->delete("tmukerja", ["idi" => $id, "kdeukerja" => $kdeukerja]);
                    if($delete){
                        $data['result'] = true;
                    }
                    else{
                        $data['result'] = false;
                        $data['msg'] = "Terjadi kesalahan dalam menghapus unit kerja";
                    }
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Unit Kerja tidak diketahui";
            }
            echo json_encode($data);
        }

        function fotoUnitKerja($id){
            if($this->model_referensi->checkData("tmukerja", $id)){
                $dataUnitKerja = $this->model_referensi->getData("tmukerja", $id);
                force_download("./assets/photos/referensi/unit_kerja/".$dataUnitKerja['pasfotopjb'], null);
            }
            else{
                $this->themes->error_404();
            }
        }
        //End Unit Kerja --------------------------------------------------------------

        //Satuan Kerja ----------------------------------------------------------------
        function satuanKerja(){
            $data['page_title'] = "Tabel Satuan Kerja - Tabel Referensi";
            $data['topbar_title'] = "Tabel Satuan Kerja";
            $data['bread'] = [
                [false, "Tabel Referensi", "javascript:void(0);"],
                [true, "Tabel Satuan Kerja", "javascript:void(0);"]
            ];
            $data['count_satuan_kerja'] = $this->model_referensi->countAllSatuanKerja(); 
            $data['js'] = APPPATH."views/referensi/satuan_kerja/satuan_kerja_js.php";
            $this->themes->primary("referensi/satuan_kerja/satuan_kerja", $data);
        }

        function satuanKerjaBaru(){
            $data['page_title'] = "Tabel Satuan Kerja - Tabel Referensi";
            $data['topbar_title'] = "Tabel Satuan Kerja Baru";
            $data['bread'] = [
                [false, "Tabel Referensi", "javascript:void(0);"],
                [false, "Tabel Satuan Kerja", base_url("tabel-referensi/tabel-satuan-kerja")],
                [true, "Tabel Satuan Kerja Baru", "javascript:void(0);"]
            ];
            
            //For Form
            $data['edit'] = false;
            $data['pegawai'] = $this->model_pegawai->getPegawaiRem();
            $data['ukerja'] = $this->model_referensi->getData("tmukerja");
            
            $data['js'] = APPPATH."views/referensi/satuan_kerja/satuan_kerja_form_js.php";
            $this->themes->primary("referensi/satuan_kerja/satuan_kerja_form", $data);
        }
        
        function editSatuanKerja($id){
            if($this->model_referensi->checkData("tmsatker", $id)){
                $dataSatker = $this->model_referensi->getData("tmsatker", $id);
                $kdesatker = $dataSatker['kdesatker'];
                
                $data['page_title'] = "Tabel Satuan Kerja - Tabel Referensi";
                $data['topbar_title'] = "Tabel Edit Satuan Kerja ".$kdesatker;
                $data['bread'] = [
                    [false, "Tabel Referensi", "javascript:void(0);"],
                    [false, "Tabel Satuan Kerja", base_url("tabel-referensi/tabel-satuan-kerja")],
                    [true, "Edit Tabel Satuan Kerja ".$kdesatker, "javascript:void(0);"]
                ];
                
                //For Form
                $data['edit'] = true;
                $data['satuanKerja'] = $dataSatker;
                $data['pegawai'] = $this->model_pegawai->getPegawaiRem();
                $data['ukerja'] = $this->model_referensi->getData("tmukerja");
                
                $data['js'] = APPPATH."views/referensi/satuan_kerja/satuan_kerja_form_js.php";
                $this->themes->primary("referensi/satuan_kerja/satuan_kerja_form", $data);
            }
            else{
                $this->themes->error_404();
            }
        }

        function newSatuanKerja(){
            $kdesatker = $this->input->post("kdesatker");
            
            //Check Kode Satker
            $check = $this->db->get_where("tmsatker", ["kdesatker" => $kdesatker])->num_rows();
            if($check > 0){
                $data['result'] = false;
                $data['msg'] = "Tidak bisa menyimpan data ketika terdapat kode satuan kerja yang sudah ada";
            }
            else{
                $kdeukerja = $this->input->post("kdeukerja");
                $set = [
                    "kdeukerja" => $kdeukerja,
                    "kdesatker" => $kdesatker,
                    "nmasatker" => $this->input->post("nmasatker"),
                    "akronim" => $this->input->post("akronim"),
                    "jbtsatker" => $this->input->post("jbtsatker"),
                    "nmapejabat" => $this->input->post("nmapejabat"),
                    "nippejabat" => $this->input->post("nippejabat"),
                    "tlppejabat" => $this->input->post("tlppejabat"),
                    "induksatker" => $this->input->post("induksatker"),
                    "kdevaluniv1" => $this->input->post("kdevaluniv1"),
                    "kdevaluniv2" => $this->input->post("kdevaluniv2"),
                    "kdevalfak1" => $this->input->post("kdevalfak1"),
                    "kdevalfak2" => $this->input->post("kdevalfak2")
                ];

                $insert = $this->db->insert("tmsatker", $set);
                if($insert){
                    $data['result'] = true;
                    $data['msg'] = 'Satuan kerja telah berhasil ditambah';
                }
                else{  
                    $data['result'] = false;
                    $data['msg'] = "Telah terjadi kesalahan dalam menyimpan satuan kerja";
                }
            }
            echo json_encode($data);
        }

        function updateSatuanKerja($id){
            if($this->model_referensi->checkData("tmsatker", $id)){
                $dataSatker = $this->model_referensi->getData("tmsatker", $id);
                $kdesatker = $dataSatker['kdesatker'];
                $kdeukerja = $this->input->post("kdeukerja");
                $set = [
                    "kdeukerja" => $kdeukerja,
                    "nmasatker" => $this->input->post("nmasatker"),
                    "akronim" => $this->input->post("akronim"),
                    "jbtsatker" => $this->input->post("jbtsatker"),
                    "nmapejabat" => $this->input->post("nmapejabat"),
                    "nippejabat" => $this->input->post("nippejabat"),
                    "tlppejabat" => $this->input->post("tlppejabat"),
                    "induksatker" => $this->input->post("induksatker"),
                    "kdevaluniv1" => $this->input->post("kdevaluniv1"),
                    "kdevaluniv2" => $this->input->post("kdevaluniv2"),
                    "kdevalfak1" => $this->input->post("kdevalfak1"),
                    "kdevalfak2" => $this->input->post("kdevalfak2")
                ];

                $update = $this->db->update("tmsatker", $set, ['idi' => $id, "kdesatker" => $kdesatker]);
                if($update){
                    $data['result'] = true;
                    $data['msg'] = 'Satuan kerja telah berhasil diperbarui';
                }
                else{  
                    $data['result'] = false;
                    $data['msg'] = "Telah terjadi kesalahan dalam memperbarui satuan kerja";
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Satuan kerja tidak diketahui";
            }

            echo json_encode($data);
        }

        function getDataSatuanKerja(){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            
            $sql_total = $this->model_referensi->countAllSatuanKerja(); 
            $sql_data = $this->model_referensi->satuanKerjaFilter($search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_referensi->countFilterSatuanKerja($search);
            
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
        }

        function delSatuanKerja($id){
            if($this->model_referensi->checkData("tmsatker", $id)){
                $dataSatker = $this->model_referensi->getData("tmsatker", $id);
                $kdesatker = $dataSatker['kdesatker'];

                //Check pemakaian
                $check = $this->db->get_where("tmpegrem", ["kdesatker" => $kdesatker])->num_rows();
                if($check > 0){
                    $data['result'] = false;
                    $data['msg'] = "Satuan kerja sedang digunakan";
                }
                else{
                    $delete = $this->db->delete("tmsatker", ["idi" => $id, "kdesatker" => $kdesatker]);
                    if($delete){
                        $data['result'] = true;
                    }
                    else{
                        $data['result'] = false;
                        $data['msg'] = "Terjadi kesalahan dalam menghapus satuan kerja";
                    }
                }
            }
            else{
                $data = [
                    "result" => false,
                    "msg" => "Satuan kerja tidak diketahui"
                ];
            }

            echo json_encode($data);
        }
        //End Satuan Kerja -----------------------------------------------------------

        //Unit Laporan ---------------------------------------------------------------
        function unitLaporan(){
            $data['page_title'] = "Tabel Unit Laporan - Tabel Referensi";
            $data['topbar_title'] = "Tabel Unit Laporan";
            $data['bread'] = [
                [false, "Tabel Referensi", "javascript:void(0);"],
                [true, "Tabel Unit Laporan", "javascript:void(0);"]
            ];
            $data['count_unit_laporan'] = $this->model_referensi->countAllUnitLaporan(); 
            $data['js'] = APPPATH."views/referensi/unit_laporan/unit_laporan_js.php";
            $this->themes->primary("referensi/unit_laporan/unit_laporan", $data);
        }

        function unitLaporanBaru(){
            $data['page_title'] = "Tabel Unit Laporan - Tabel Referensi";
            $data['topbar_title'] = "Tabel Unit Laporan Baru";
            $data['bread'] = [
                [false, "Tabel Referensi", "javascript:void(0);"],
                [false, "Tabel Unit Laporan", base_url("tabel-referensi/tabel-unit-laporan")],
                [true, "Tabel Unit Laporan Baru", "javascript:void(0);"]
            ];
            
            //For Form
            $data['edit'] = false;
            
            $data['js'] = APPPATH."views/referensi/unit_laporan/unit_laporan_form_js.php";
            $this->themes->primary("referensi/unit_laporan/unit_laporan_form", $data);
        }
        
        function editUnitLaporan($id){
            if($this->model_referensi->checkData("tmulapor", $id)){
                $dataUnitLaporan = $this->model_referensi->getData("tmulapor", $id);
                $kdeulapor = $dataUnitLaporan['kdeulapor'];
                
                $data['page_title'] = "Tabel Unit Laporan - Tabel Referensi";
                $data['topbar_title'] = "Tabel Edit Unit Laporan ".$kdeulapor;
                $data['bread'] = [
                    [false, "Tabel Referensi", "javascript:void(0);"],
                    [false, "Tabel Unit Laporan", base_url("tabel-referensi/tabel-unit-laporana")],
                    [true, "Edit Tabel Unit Laporan ".$kdeulapor, "javascript:void(0);"]
                ];
                
                //For Form
                $data['edit'] = true;
                $data['unitLaporan'] = $dataUnitLaporan;
                
                $data['js'] = APPPATH."views/referensi/unit_laporan/unit_laporan_form_js.php";
                $this->themes->primary("referensi/unit_laporan/unit_laporan_form", $data);
            }
            else{
                $this->themes->error_404();
            }
        }

        function newUnitLaporan(){
            $kdeulapor = $this->input->post("kdeulapor");
            $nmaulapor = $this->input->post("nmaulapor");

            //Check Unit Laporan
            $check = $this->db->get_where("tmulapor", ["kdeulapor" => $kdeulapor])->num_rows();
            if($check > 0){
                $data['result'] = false;
                $data['msg'] = "Tidak bisa menyimpan data ketika terdapat kode unit laporan yang sudah ada";
            }
            else{
                $set = [
                    "kdeulapor" => $kdeulapor,
                    "nmaulapor" => $nmaulapor
                ];

                $insert = $this->db->insert("tmulapor", $set);
                if($insert){
                    $data['result'] = true;
                    $data['msg'] = "Unit laporan telah berhasil disimpan";
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Telah terjadi kesalahan dalam menyimpan unit laporan";
                }
            }
            echo json_encode($data);
        }

        function updateUnitLaporan($id){
            if($this->model_referensi->checkData("tmulapor", $id)){
                $dataUnitLaporan = $this->model_referensi->getData("tmulapor", $id);
                $kdeulapor = $dataUnitLaporan['kdeulapor'];
                $nmaulapor = $this->input->post("nmaulapor");
    
                $set = [
                    "nmaulapor" => $nmaulapor
                ];

                $update = $this->db->update("tmulapor", $set, ["idi" => $id, "kdeulapor" => $kdeulapor]);
                if($update){
                    $data['result'] = true;
                    $data['msg'] = "Unit laporan telah berhasil diperbarui";
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Telah terjadi kesalahan dalam memperbarui unit laporan";
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Unit laporan tidak diketahui";
            }
            echo json_encode($data);
        }

        function getDataUnitLaporan(){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            
            $sql_total = $this->model_referensi->countAllUnitLaporan(); 
            $sql_data = $this->model_referensi->unitLaporanFilter($search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_referensi->countFilterUnitLaporan($search);
            
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
        }

        function delUnitLaporan($id){
            if($this->model_referensi->checkData("tmulapor", $id)){
                $dataULapor = $this->model_referensi->getData("tmulapor", $id);
                $kdeulapor = $dataULapor['kdeulapor'];

                //Check Pemakaian
                $check = $this->db->get_where("tmpegrem", ["kdeulapor" => $kdeulapor])->num_rows();
                if($check > 0){
                    $data['result'] = false;
                    $data['msg'] = "Unit laporan sedang digunakan";
                }
                else{
                    $delete = $this->db->delete("tmulapor", ["idi" => $id, "kdeulapor" => $kdeulapor]);
                    if($delete){
                        $data['result'] = true;
                    }
                    else{
                        $data['result'] = false;
                        $data['msg'] = "Terjadi kesalahan dalam menghapus unit laporan";
                    }
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Unit laporan tidak diketahui";
            }
            echo json_encode($data);
        }
        //End Unit Laporan ----------------------------------------------------------
    }
?>
