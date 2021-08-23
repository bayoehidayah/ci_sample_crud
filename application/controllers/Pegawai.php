<?php 
    // defined('BASEPATH') OR exit('No direct script access allowed');
    class Pegawai extends CI_Controller{

        private $currentTime;
        private $akses;

        function __construct(){
            parent::__construct();
            check_session();
            date_default_timezone_set("Asia/Jakarta");
            $this->currentTime = date("Y-m-d H:i:s");
            $this->akses = $this->session->userdata("tipe");
        }

        function dataPegawai(){
            $kdepeg = $this->input->post("kdepeg");
            if($this->model_pegawai->checkPegawaiRem($kdepeg)){
                $data['result'] = true;
                $data['pegawai'] = $this->model_pegawai->getPegawaiRem($kdepeg);
                $data['pegawai']['satker'] = $this->model_pegawai->getSatKer($data['pegawai']['kdesatker']);
                $data['pegawai']['ukerja'] = $this->model_pegawai->getUKerja($data['pegawai']['satker']['kdeukerja']);
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Pegawai tidak diketahui";
            }
            echo json_encode($data);
        }

        //Blu Unimed --------------------------------------------------------------------
        function bluUnimed(){
            if($this->akses == "Super" || $this->akses == "Kepegawaian"){
                $data['page_title'] = "Pegawai Blu Unimed - Pegawai";
                $data['topbar_title'] = "Pegawai Blu Unimed";
                $data['bread'] = [
                    [false, "Pegawai", "javascript:void(0);"],
                    [true, "Pegawai Blu Unimed", "javascript:void(0);"]
                ];
                $data['js'] = APPPATH."views/pegawai/blu_unimed/blu_unimed_js.php";
                $this->themes->primary("pegawai/blu_unimed/blu_unimed", $data);
            }
            else{
                $this->themes->error_404();
            }
        }
        
        function newPegawaiBlu(){
            if($this->akses == "Super" || $this->akses == "Kepegawaian"){
                $data['page_title'] = "Pegawai Blu Unimed - Pegawai";
                $data['topbar_title'] = "Pegawai Baru";
                $data['bread'] = [
                    [false, "Pegawai", "javascript:void(0);"],
                    [false, "Pegawai Blu Unimed", base_url("pegawai/blu-unimed")],
                    [true, "Pegawai Baru", "javascript:void(0);"],
                ];
                $data['edit'] = false;
                $data['jendik'] = $this->model_pegawai->getJendik();
                $data['golpns'] = $this->model_pegawai->getGolPns();
                $data['stspeg'] = $this->model_pegawai->getStsPeg();
                $data['jnspeg'] = $this->model_pegawai->getJnsPeg();
                $data['js'] = APPPATH."views/pegawai/blu_unimed/blu_unimed_form_js.php";
                $this->themes->primary("pegawai/blu_unimed/blu_unimed_form", $data);
            }
            else{
                $this->themes->error_404();
            }
        }

        function editPegawaiBlu($idi){
            if($this->akses == "Super" || $this->akses == "Kepegawaian"){
                if($this->model_pegawai->checkIdPegawaiBlu($idi)){
                    $dataPegawai = $this->model_pegawai->getIdPegawaiBlu($idi);
                    $data['page_title'] = "Pegawai Blu Unimed - Pegawai";
                    $data['topbar_title'] = "Pegawai Baru";
                    $data['bread'] = [
                        [false, "Pegawai", "javascript:void(0);"],
                        [false, "Pegawai Blu Unimed", base_url("pegawai/blu-unimed")],
                        [true, "Edit Pegawai Blu ".$dataPegawai['kdepeg'], "javascript:void(0);"],
                    ];
                    $data['edit'] = true;
                    $data['pegawai'] = $dataPegawai;
                    $data['jendik'] = $this->model_pegawai->getJendik();
                    $data['golpns'] = $this->model_pegawai->getGolPns();
                    $data['stspeg'] = $this->model_pegawai->getStsPeg();
                    $data['jnspeg'] = $this->model_pegawai->getJnsPeg();
                    $data['js'] = APPPATH."views/pegawai/blu_unimed/blu_unimed_form_js.php";
                    $this->themes->primary("pegawai/blu_unimed/blu_unimed_form", $data);
                }
                else{
                    $this->themes->error_404();
                }
            }
            else{
                $this->themes->error_404();
            }
        }
        
        function getDataPegawaiBlu(){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];

            $sql_total = $this->model_pegawai->countAllPegawaiBlu(); 
            $sql_data = $this->model_pegawai->pegawaiBluFilter($search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_pegawai->countFilterPegawaiBlu($search);

            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
        }

        function bluFotoDownload($id){
            if($this->model_pegawai->checkIdPegawaiBlu($id)){
                $dataPegawai = $this->model_pegawai->getIdPegawaiBlu($id);
                force_download("./assets/photos/pegawai/blu/".$dataPegawai['pasfoto'], null);
            }
            else{
                $this->themes->error_404();
            }
        }
        
        function insertPegawaiBlu(){
            if($this->akses == "Super" || $this->akses == "Kepegawaian"){
                $kdepeg = $this->input->post("kdepeg");
                if(!$this->model_pegawai->checkPegawaiBlu($kdepeg)){
                    if(!empty($_FILES['foto']['name'])){
                        $uid = $this->uuid->v4(true);
                        $config['upload_path'] = './assets/photos/pegawai/blu';
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['max_size'] = 2048;
                        $config['file_name'] = $kdepeg."_".$uid;
                        $config["overwrite"] = true;

                        $this->upload->initialize($config);
                        if($this->upload->do_upload("foto")){
                            $hasil = $this->upload->data();
                            $file = $hasil['file_name'];
                            $pasfoto = $file;
                            $allowInsert = true;
                            $error = $this->upload->display_errors();
                        }
                        else{
                            $pasfoto = null;
                            $error = null;
                            $allowInsert = false;
                        }
                    }
                    else{
                        $pasfoto = null;
                        $error = null;
                        $allowInsert = true;
                    }

                    if($allowInsert){
                        $set = [
                            "kdepeg" => $kdepeg,
                            "kdepus" => null,
                            "nip" => $this->input->post("nip"),
                            "nidn" => $this->input->post("nidn"),
                            "nmapeg" => $this->input->post("nmapeg"),
                            "nmapanjang" => $this->input->post("nmapanjang"),
                            "gender" => $this->input->post("gender"),
                            "jendik" => $this->input->post("jendik"),
                            "golpns" => $this->input->post("golpns"),
                            "kdestspeg" => $this->input->post("stspeg"),
                            "kdejnspeg" => $this->input->post("jnspeg"),
                            "stsrek" => $this->input->post("stsrek"),
                            "pasfoto" => $pasfoto
                        ];
                        $insert = $this->db->insert("tmpegblu", $set);
                        if($insert){
                            $data['result'] = true;
                            $data['msg'] = "Pegawai baru telah berhasil ditambah";
                        }
                        else{
                            $data['result'] = false;
                            $data['msg'] = "Terjadi kesalahan dalam menyimpan data";
                        }
                    }
                    else{
                        $data['result'] = false;
                        $data['msg'] = $error;
                    }
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Kode Pegawai telah digunakan. <br/> Silahkan gunakan kode pegawai yang lain";
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Anda tidak mempunyai hak untuk melakukan ini";
            }
            echo json_encode($data);
        }

        function delPegawaiBlu($idi){
            if($this->akses == "Super" || $this->akses == "Kepegawaian"){
                if($this->model_pegawai->checkIdPegawaiBlu($idi)){
                    $dataPegawai = $this->model_pegawai->getIdPegawaiBlu($idi);
                    $kdepeg = $dataPegawai['kdepeg'];
                    $allowInsert = true;
                    $checkAkun = $this->db->query("SELECT COUNT(*) AS total FROM users WHERE kdepeg='$kdepeg'")->row_array();
                    if($checkAkun['total'] > 0){$allowInsert = false;}

                    $checkTransaksi = $this->db->query("SELECT COUNT(*) AS total FROM tr_aktivitas WHERE kdepeg='$kdepeg'")->row_array();
                    if($checkTransaksi['total'] > 0){$allowInsert = false;}

                    if($allowInsert){
                        $delete = $this->db->delete("tmpegblu", ["kdepeg" => $kdepeg]);
                        if($delete){
                            if($dataPegawai['pasfoto'] != null || $dataPegawai['pasfoto'] != ""){
                                $path = "./assets/photos/pegawai/blu/".$dataPegawai['pasfoto'];
                                if(file_exists($path)){
                                    unlink($path);
                                }
                            }
                            $data['result'] = true;
                        }
                        else{
                            $data['result'] = false;
                            $data['msg'] = "Terjadi kesalahan dalam menghapus pegawai";
                        }
                    }
                    else{
                        $data['result'] = false;
                        $data['msg'] = "Pegawai sedang memiliki sebuah data. <br/> Tidak bisa menghapus data dan pastikan pegawai tidak memiliki data yang berkaitan";
                    }
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Pegawai blu tidak diketahui";
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Anda tidak mempunyai hak untuk melakukan ini";
            }
            echo json_encode($data);
        }

        function updatePegawaiBlu(){
            if($this->akses == "Super" || $this->akses == "Kepegawaian"){
                $kdepeg = $this->input->post("kdepeg");
                if($this->model_pegawai->checkPegawaiBlu($kdepeg)){
                    $dataPegawai = $this->model_pegawai->getPegawaiBlu($kdepeg);
                    $pasFotoBefore = $dataPegawai['pasfoto'];

                    if(!empty($_FILES['foto']['name'])){
                        //Check if foto already exist
                        if($pasFotoBefore != "" || $pasFotoBefore != null){
                            $pathBefore = "./assets/photos/pegawai/blu/".$pasFotoBefore;
                            if(file_exists($pathBefore)){
                                unlink($pathBefore);
                            }
                        }

                        $uid = $this->uuid->v4(true);
                        $config['upload_path'] = './assets/photos/pegawai/blu/';
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['max_size'] = 2048;
                        $config['file_name'] = $kdepeg."_".$uid;
                        $config["overwrite"] = true;

                        $this->upload->initialize($config);
                        if($this->upload->do_upload("foto")){
                            $hasil = $this->upload->data();
                            $file = $hasil['file_name'];
                            $pasfoto = $file;
                            $allowInsert = true;
                            $error = $this->upload->display_errors();
                        }
                        else{
                            $pasfoto = null;
                            $error = null;
                            $allowInsert = false;
                        }
                    }
                    else{
                        $pasfoto = null;
                        $error = null;
                        $allowInsert = true;
                    }

                    if($allowInsert){
                        $set = [
                            "kdepus" => null,
                            "nip" => $this->input->post("nip"),
                            "nidn" => $this->input->post("nidn"),
                            "nmapeg" => $this->input->post("nmapeg"),
                            "nmapanjang" => $this->input->post("nmapanjang"),
                            "gender" => $this->input->post("gender"),
                            "jendik" => $this->input->post("jendik"),
                            "golpns" => $this->input->post("golpns"),
                            "kdestspeg" => $this->input->post("stspeg"),
                            "kdejnspeg" => $this->input->post("jnspeg"),
                            "stsrek" => $this->input->post("stsrek")
                        ];

                        if($pasfoto != null){
                            $set['pasfoto'] = $pasfoto;
                        }
                        $update = $this->db->update("tmpegblu", $set, ["kdepeg" => $kdepeg]);
                        if($update){
                            $data['result'] = true;
                            $data['msg'] = "Pegawai telah berhasil diperbarui";
                        }
                        else{
                            $data['result'] = false;
                            $data['msg'] = "Terjadi kesalahan dalam menyimpan data";
                        }
                    }
                    else{
                        $data['result'] = false;
                        $data['msg'] = $error;
                    }
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Pegawai tidak diketahui";
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Anda tidak mempunyai hak akses untuk melakukan ini";
            }
            echo json_encode($data);
        }

        //End Blu Unimed ----------------------------------------------------------------
        
        //Remun Unimed --------------------------------------------------------------------
        function remunUnimed(){
            if($this->akses == "Super" || $this->akses == "Kepegawaian"){
                $data['page_title'] = "Pegawai Remun Unimed - Pegawai";
                $data['topbar_title'] = "Pegawai Remun Unimed";
                $data['bread'] = [
                    [false, "Pegawai", "javascript:void(0);"],
                    [true, "Pegawai Remun Unimed", "javascript:void(0);"]
                ];
                $data['js'] = APPPATH."views/pegawai/remun_unimed/remun_unimed_js.php";
                $this->themes->primary("pegawai/remun_unimed/remun_unimed", $data);
            }
            else{
                $this->themes->error_404();
            }
        }

        function newPegawaiRemun(){
            if($this->akses == "Super" || $this->akses == "Kepegawaian"){
                $data['page_title'] = "Pegawai Remun Unimed - Pegawai";
                $data['topbar_title'] = "Pegawai Baru";
                $data['bread'] = [
                    [false, "Pegawai", "javascript:void(0);"],
                    [false, "Pegawai Remun Unimed", base_url("pegawai/remun-unimed")],
                    [true, "Pegawai Baru", "javascript:void(0);"],
                ];
                $data['edit'] = false;
                $data['jendik'] = $this->model_pegawai->getJendik();
                $data['golpns'] = $this->model_pegawai->getGolPns();
                $data['kdnpeg'] = $this->model_pegawai->getKdnPeg();
                $data['stspeg'] = $this->model_pegawai->getStsPeg();
                $data['jnspeg'] = $this->model_pegawai->getJnsPeg();
                $data['nmajab'] = $this->model_pegawai->getNMajab();
                $data['klsjab'] = $this->model_pegawai->getKlsJab();
                $data['jabakad'] = $this->model_pegawai->getJabAkad();
                $data['satker'] = $this->model_pegawai->getSatKer();
                $data['ulapor'] = $this->model_pegawai->getULapor();
                $data['js'] = APPPATH."views/pegawai/remun_unimed/remun_unimed_form_js.php";
                $this->themes->primary("pegawai/remun_unimed/remun_unimed_form", $data);
            }
            else{
                $this->themes->error_404();
            }
        }

        function remunFotoDownload($id){
            if($this->model_pegawai->checkIdPegawaiRem($id)){
                $dataPegawai = $this->model_pegawai->getIdPegawaiRem($id);
                force_download("./assets/photos/pegawai/remun/".$dataPegawai['pasfoto'], null);
            }
            else{
                $this->themes->error_404();
            }
        }

        function editPegawaiRemun($idi){
            if($this->akses == "Super" || $this->akses == "Kepegawaian"){
                if($this->model_pegawai->checkIdPegawaiRem($idi)){
                    $dataPegawai = $this->model_pegawai->getIdPegawaiRem($idi);
                    $data['page_title'] = "Pegawai Remun Unimed - Pegawai";
                    $data['topbar_title'] = "Pegawai Baru";
                    $data['bread'] = [
                        [false, "Pegawai", "javascript:void(0);"],
                        [false, "Pegawai Remun Unimed", base_url("pegawai/remun-unimed")],
                        [true, "Edit Pegawai Remun ".$dataPegawai['kdepeg'], "javascript:void(0);"],
                    ];
                    $data['edit'] = true;
                    $data['pegawai'] = $dataPegawai;
                    $data['jendik'] = $this->model_pegawai->getJendik();
                    $data['golpns'] = $this->model_pegawai->getGolPns();
                    $data['kdnpeg'] = $this->model_pegawai->getKdnPeg();
                    $data['stspeg'] = $this->model_pegawai->getStsPeg();
                    $data['jnspeg'] = $this->model_pegawai->getJnsPeg();
                    $data['nmajab'] = $this->model_pegawai->getNMajab();
                    $data['klsjab'] = $this->model_pegawai->getKlsJab();
                    $data['jabakad'] = $this->model_pegawai->getJabAkad();
                    $data['satker'] = $this->model_pegawai->getSatKer();
                    $data['ulapor'] = $this->model_pegawai->getULapor();
                    $data['js'] = APPPATH."views/pegawai/remun_unimed/remun_unimed_form_js.php";
                    $this->themes->primary("pegawai/remun_unimed/remun_unimed_form", $data);
                }
                else{
                    $this->themes->error_404();
                }
            }
            else{
                $this->themes->error_404();
            }
        }
        
        function getDataPegawaiRem(){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];

            $sql_total = $this->model_pegawai->countAllPegawaiRem(); 
            $sql_data = $this->model_pegawai->pegawaiRemFilter($search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_pegawai->countFilterPegawaiRem($search);

            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
        }

        function insertPegawaiRemun(){
            if($this->akses == "Super" || $this->akses == "Kepegawaian"){
                $kdepeg = $this->input->post("kdepeg");
                if(!$this->model_pegawai->checkPegawaiRem($kdepeg)){
                    if(!empty($_FILES['foto']['name'])){
                        $uid = $this->uuid->v4(true);
                        $config['upload_path'] = './assets/photos/pegawai/remun';
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['max_size'] = 2048;
                        $config['file_name'] = $kdepeg."_".$uid;
                        $config["overwrite"] = true;

                        $this->upload->initialize($config);
                        if($this->upload->do_upload("foto")){
                            $hasil = $this->upload->data();
                            $file = $hasil['file_name'];
                            $pasfoto = $file;
                            $allowInsert = true;
                            $error = $this->upload->display_errors();
                        }
                        else{
                            $pasfoto = null;
                            $error = null;
                            $allowInsert = false;
                        }
                    }
                    else{
                        $pasfoto = null;
                        $error = null;
                        $allowInsert = true;
                    }

                    if($allowInsert){
                        $set = [
                            "kdepeg" => $kdepeg,
                            "nip" => $this->input->post("nip"),
                            "nidn" => $this->input->post("nidn"),
                            "nmapeg" => $this->input->post("nmapeg"),
                            "nmapanjang" => $this->input->post("nmapanjang"),
                            "temlhr" => $this->input->post("temlhr"),
                            "tgllhr" => $this->input->post("tgllhr"),
                            "gender" => $this->input->post("gender"),
                            "jendik" => $this->input->post("jendik"),
                            "golpns" => $this->input->post("golpns"),
                            "tmtgol" => $this->input->post("tmtgol"),
                            "kdekdnpeg" => $this->input->post("kdnpeg"),
                            "kdestspeg" => $this->input->post("stspeg"),
                            "kdejnspeg" => $this->input->post("jnspeg"),
                            "kdenmajabf" => $this->input->post("nmajabf"),
                            "kdenmajab" => $this->input->post("nmajab"),
                            "kdeklsjabf" => $this->input->post("klsjabf"),
                            "kdeklsjab" => $this->input->post("klsjab"),
                            "tmtjabatan" => $this->input->post("tmtjabatan"),
                            "kdejabakad" => $this->input->post("jabakad"),
                            "ket_jabatan" => $this->input->post("ket_jabatan"),
                            "kdesatker" => $this->input->post("satker"),
                            "kdeulapor" => $this->input->post("ulapor"),
                            "kdepus" => null,
                            "stsrek" => $this->input->post("stsrek"),
                            "pasfoto" => $pasfoto,
                            "buk_nmajab" => null,
                            "buk_unit" => null
                        ];
                        $insert = $this->db->insert("tmpegrem", $set);
                        if($insert){
                            $data['result'] = true;
                            $data['msg'] = "Pegawai baru telah berhasil ditambah";
                        }
                        else{
                            $data['result'] = false;
                            $data['msg'] = "Terjadi kesalahan dalam menyimpan data";
                        }
                    }
                    else{
                        $data['result'] = false;
                        $data['msg'] = $error;
                    }
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Kode Pegawai telah digunakan. <br/> Silahkan gunakan kode pegawai yang lain";
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Anda tidak mempunyai hak untuk melakukan ini";
            }
            echo json_encode($data);
        }

        function updatePegawaiRemun(){
            if($this->akses == "Super" || $this->akses == "Kepegawaian"){
                $kdepeg = $this->input->post("kdepeg");
                if($this->model_pegawai->checkPegawaiRem($kdepeg)){
                    $dataPegawai = $this->model_pegawai->getPegawaiRem($kdepeg);
                    $pasFotoBefore = $dataPegawai['pasfoto'];

                    if(!empty($_FILES['foto']['name'])){
                        //Check if foto already exist
                        if($pasFotoBefore != "" || $pasFotoBefore != null){
                            $pathBefore = "./assets/photos/pegawai/remun/".$pasFotoBefore;
                            if(file_exists($pathBefore)){
                                unlink($pathBefore);
                            }
                        }

                        $uid = $this->uuid->v4(true);
                        $config['upload_path'] = './assets/photos/pegawai/remun/';
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['max_size'] = 2048;
                        $config['file_name'] = $kdepeg."_".$uid;
                        $config["overwrite"] = true;

                        $this->upload->initialize($config);
                        if($this->upload->do_upload("foto")){
                            $hasil = $this->upload->data();
                            $file = $hasil['file_name'];
                            $pasfoto = $file;
                            $allowInsert = true;
                            $error = $this->upload->display_errors();
                        }
                        else{
                            $pasfoto = null;
                            $error = null;
                            $allowInsert = false;
                        }
                    }
                    else{
                        $pasfoto = null;
                        $error = null;
                        $allowInsert = true;
                    }

                    if($allowInsert){
                        $set = [
                            "nip" => $this->input->post("nip"),
                            "nidn" => $this->input->post("nidn"),
                            "nmapeg" => $this->input->post("nmapeg"),
                            "nmapanjang" => $this->input->post("nmapanjang"),
                            "temlhr" => $this->input->post("temlhr"),
                            "tgllhr" => $this->input->post("tgllhr"),
                            "gender" => $this->input->post("gender"),
                            "jendik" => $this->input->post("jendik"),
                            "golpns" => $this->input->post("golpns"),
                            "tmtgol" => $this->input->post("tmtgol"),
                            "kdekdnpeg" => $this->input->post("kdnpeg"),
                            "kdestspeg" => $this->input->post("stspeg"),
                            "kdejnspeg" => $this->input->post("jnspeg"),
                            "kdenmajabf" => $this->input->post("nmajabf"),
                            "kdenmajab" => $this->input->post("nmajab"),
                            "kdeklsjabf" => $this->input->post("klsjabf"),
                            "kdeklsjab" => $this->input->post("klsjab"),
                            "tmtjabatan" => $this->input->post("tmtjabatan"),
                            "kdejabakad" => $this->input->post("jabakad"),
                            "ket_jabatan" => $this->input->post("ket_jabatan"),
                            "kdesatker" => $this->input->post("satker"),
                            "kdeulapor" => $this->input->post("ulapor"),
                            "kdepus" => null,
                            "stsrek" => $this->input->post("stsrek"),
                            "buk_nmajab" => null,
                            "buk_unit" => null
                        ];

                        if($pasfoto != null){
                            $set['pasfoto'] = $pasfoto;
                        }
                        $update = $this->db->update("tmpegrem", $set, ["kdepeg" => $kdepeg]);
                        if($update){
                            $data['result'] = true;
                            $data['msg'] = "Pegawai telah berhasil diperbarui";
                        }
                        else{
                            $data['result'] = false;
                            $data['msg'] = "Terjadi kesalahan dalam menyimpan data";
                        }
                    }
                    else{
                        $data['result'] = false;
                        $data['msg'] = $error;
                    }
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Pegawai tidak diketahui";
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Anda tidak mempunyai hak akses untuk melakukan ini";
            }
            echo json_encode($data);
        }

        function delPegawaiRemun($idi){
            if($this->akses == "Super" || $this->akses == "Kepegawaian"){
                if($this->model_pegawai->checkIdPegawaiRem($idi)){
                    $dataPegawai = $this->model_pegawai->getIdPegawaiRem($idi);
                    $kdepeg = $dataPegawai['kdepeg'];
                    $allowInsert = true;
                    $checkAkun = $this->db->query("SELECT COUNT(*) AS total FROM users WHERE kdepeg='$kdepeg'")->row_array();
                    if($checkAkun['total'] > 0){$allowInsert = false;}

                    $checkTransaksi = $this->db->query("SELECT COUNT(*) AS total FROM tr_aktivitas WHERE kdepeg='$kdepeg'")->row_array();
                    if($checkTransaksi['total'] > 0){$allowInsert = false;}

                    if($allowInsert){
                        $delete = $this->db->delete("tmpegrem", ["kdepeg" => $kdepeg]);
                        if($delete){
                            if($dataPegawai['pasfoto'] != null || $dataPegawai['pasfoto'] != ""){
                                $path = "./assets/photos/pegawai/remun/".$dataPegawai['pasfoto'];
                                if(file_exists($path)){
                                    unlink($path);
                                }
                            }
                            $data['result'] = true;
                        }
                        else{
                            $data['result'] = false;
                            $data['msg'] = "Terjadi kesalahan dalam menghapus pegawai";
                        }
                    }
                    else{
                        $data['result'] = false;
                        $data['msg'] = "Pegawai sedang memiliki sebuah data. <br/> Tidak bisa menghapus data dan pastikan pegawai tidak memiliki data yang berkaitan";
                    }
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Pegawai remun tidak diketahui";
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Anda tidak mempunyai hak untuk melakukan ini";
            }
            echo json_encode($data);
        }
        //End Remun Unimed ----------------------------------------------------------------

        //Validator -----------------------------------------------------------------------
        function validatorUser(){
            if($this->akses == "Super" || $this->akses == "Kepegawaian"){
                $data['page_title'] = "Validator - Pegawai";
                $data['topbar_title'] = "Validator";
                $data['bread'] = [
                    [false, "Pegawai", "javascript:void(0);"],
                    [true, "Validator", "javascript:void(0);"]
                ];
                $data['validator_user'] = $this->model_pegawai->getValidator();
                $data['js'] = APPPATH."views/pegawai/validator/validator_js.php";
                $this->themes->primary("pegawai/validator/validator", $data);   
            }
            else{
                $this->themes->error_404();
            }
        }

        function validatorBaru(){
            if($this->akses == "Super" || $this->akses == "Kepegawaian"){
                $data['page_title'] = "Validator Baru - Pegawai";
                $data['topbar_title'] = "Validator Baru";
                $data['bread'] = [
                    [false, "Pegawai", "javascript:void(0);"],
                    [false, "Validator", base_url("pegawai/validator")],
                    [true, "Validator Baru", "javascript:void(0);"]
                ];
                // $data['validator_user'] = $this->model_pegawai->getValidator();
                $data['ukerja'] = $this->model_pegawai->getUKerja();
                $data['js'] = APPPATH."views/pegawai/validator/validator_form_js.php";
                $this->themes->primary("pegawai/validator/validator_form", $data);   
            }
            else{
                $this->themes->error_404();
            }
        }

        function newValidator(){
            if($this->akses == "Super" || $this->akses == "Kepegawaian"){
                $kdepeg = $this->input->post("pegawai");
                if($this->model_auth->checkPegawai($kdepeg)){
                    $data['result'] = false;
                    $data['msg'] = "Pegawai tersebut telah memiliki akun";
                }
                else{
                    $set = [
                        "kdepeg" => $kdepeg,
                        "email" => $this->input->post("username"),
                        "password" => password_hash($this->input->post("password"), PASSWORD_BCRYPT),
                        "tipe" => "Validator",
                        "kdeukerja" => $this->input->post("ukerja"),
                        "kdesatker" => $this->input->post("satker")
                    ];

                    $insert = $this->db->insert("users", $set);
                    if($insert){
                        $data['result'] = true;
                        $data['msg'] = "Akun untuk validator telah berhasil dibuat";
                    }
                    else{
                        $data['result'] = false;
                        $data['msg'] = "Terjadi kesalahan dalam membuat akun";
                    }
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Anda tidak mempunyai hak akses";
            }
            echo json_encode($data);
        }

        function getValidatorSatker(){
            if($this->akses == "Super" || $this->akses == "Kepegawaian"){
                $kdeukerja = $this->input->post("ukerja");
                $dataSatker = $this->db->order_by("kdeukerja", "ASC")->get_where("tmsatker", ["kdeukerja" => $kdeukerja]);
                if($dataSatker->num_rows() > 0){
                    $data['result'] = true;
                    $data['satker'] = $dataSatker->result();
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Unit kerja tidak memiliki satuan kerja";
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Anda tidak mempunyai hak akses";
            }
            echo json_encode($data);
        } 

        function getValidatorPeg(){
            if($this->akses == "Super" || $this->akses == "Kepegawaian"){
                $kdesatker = $this->input->post("satker");
                $dataPeg = $this->db->order_by("kdepeg", "ASC")->get_where("tmpegrem", ["kdesatker" => $kdesatker]);
                if($dataPeg->num_rows() > 0){
                    $data['result'] = true;
                    $data['pegawai'] = $dataPeg->result();
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Tidak ada pegawai yang memiliki satuan kerja yang terkait";
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Anda tidak mempunyai hak akses";
            }
            echo json_encode($data);
        }

        function delValidatorUser($kdepeg){
            if($this->akses == "Super" || $this->akses == "Kepegawaian"){
                if($this->model_auth->checkPegawai($kdepeg)){
                    $delete = $this->db->delete("users", ['kdepeg' => $kdepeg]);
                    if($delete){
                        $data['result'] = true;
                    }
                    else{
                        $data['result'] = false;
                        $data['msg'] = "Terjadi kesalahan dalam menghapus akun";
                    }
                } 
                else{
                    $data['result'] = false;
                    $data['msg'] = "Akun tidak diketahui";
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Anda tidak mempunyai hak akses";
            }
            echo json_encode($data);
        }

        // function getDataValidator(){
        //     $search = $_POST['search']['value'];
        //     $limit = $_POST['length'];
        //     $start = $_POST['s-tart'];
        //     $order_index = $_POST['order'][0]['column'];
        //     $order_field = $_POST['columns'][$order_index]['data'];
        //     $order_ascdesc = $_POST['order'][0]['dir'];
        //     $sql_total = $this->model_pegawai->countAllValidator(); 
        //     $sql_data = $this->model_pegawai->validatorFilter($search, $limit, $start, $order_field, $order_ascdesc);
        //     $sql_filter = $this->model_pegawai->countFilterValidator($search);

        //     $callback = array(
        //         'draw' => $_POST['draw'],
        //         'recordsTotal' => $sql_total,
        //         'recordsFiltered' => $sql_filter,
        //         'data' => $sql_data
        //     );
        //     header('Content-Type: application/json');
        //     echo json_encode($callback);
        // }
        //End Validator -------------------------------------------------------------------
    }
?>
