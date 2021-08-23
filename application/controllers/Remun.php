<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Remun extends CI_Controller{

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

        //Set Up Periode -----------------------------------------------------------

        function setUpPeriode(){
            $data['page_title'] = "Set Up Periode - Proses Remun";
            $data['topbar_title'] = "Set Up Periode";
            $data['bread'] = [
                [false, "Proses Remun", "javascript:void(0);"],
                [true, "Set Up Periode", "javascript:void(0);"]
            ];
            $data['js'] = APPPATH."views/proses_remun/set_periode/set_periode_js.php";
            $data['periode'] = $this->model_remun->getPeriode();
            $this->themes->primary("proses_remun/set_periode/set_periode", $data);
        }

        function setPeriodeBaru(){
            $data['page_title'] = "Set Up Periode - Proses Remun";
            $data['topbar_title'] = "Periode Baru";
            $data['bread'] = [
                [false, "Proses Remun", "javascript:void(0);"],
                [false, "Set Up Periode", base_url("proses-remun/set-up-periode")],
                [true, "Periode Baru", "javascript:void(0);"]
            ];
            $data['edit'] = false;
            $data['pegawai'] = $this->model_remun->getPegawaiRem();
            $data['js'] = APPPATH."views/proses_remun/set_periode/set_periode_form_js.php";
            $this->themes->primary("proses_remun/set_periode/set_periode_form", $data);
        }

        function getNipPeg(){
            $kdepeg = $this->input->post("kode");
            if($this->model_remun->checkPegawaiRem($kdepeg)){
                $dataPeg = $this->model_remun->getPegawaiRem($kdepeg);
                $data['result'] = true;
                $data['nip'] = $dataPeg['nip'];
            }
            else{
                $data['result'] = false;
            }

            echo json_encode($data);
        }

        function newPeriode(){
            $rektor = $this->input->post("rektor");
            $wrektor = $this->input->post("wakil_rektor");
            $kepala_buk = $this->input->post("kepala_buk");
            $bendahara = $this->input->post("bendahara");

            $dataRektor = $this->model_remun->getPegawaiRem($rektor);
            $dataWRektor = $this->model_remun->getPegawaiRem($wrektor);
            $dataKepalaBUK = $this->model_remun->getPegawaiRem($kepala_buk);
            $dataBendahara = $this->model_remun->getPegawaiRem($bendahara);

            //Set $data
            $set = [
                "periode" => $this->input->post("periode"),
                "tglmulai" => $this->input->post("tgl_mulai"),
                "tglakhir" => $this->input->post("tgl_berakhir"),
                "pir" => $this->input->post("pir"),
                "reduksi_real" => $this->input->post("reduksi"),
                "tglbayar1" => $this->input->post("tgl_bayar1"),
                "remundos1" => $this->input->post("remundos1"),
                "remunpeg1" => $this->input->post("remunpeg1"),
                "judul11" => $this->input->post("judul11"),
                "judul12" => $this->input->post("judul12"),
                "tglbayar2" => $this->input->post("tgl_bayar2"),
                "remundos2" => $this->input->post("remundos2"),
                "remunpeg2" => $this->input->post("remunpeg2"),
                "judul21" => $this->input->post("judul21"),
                "judul22" => $this->input->post("judul22"),
                "nmarektor" => $dataRektor['nmapanjang'],
                "niprektor" => $dataRektor['nip'],
                "nmawr2" => $dataWRektor['nmapanjang'],
                "nipwr2" => $dataWRektor['nip'],
                "nmakabuk" => $dataKepalaBUK['nmapanjang'],
                "nipkabuk" => $dataKepalaBUK['nip'],
                "nmabendahara" => $dataBendahara['nmapanjang'],
                "nipbendahara" => $dataBendahara['nip'],
                "tglakses" => $this->currentTime,
                "stsrek" => $this->input->post("status_periode")
            ];

            $insert = $this->db->insert("tr_periode", $set);
            if($insert){
                $data['result'] = true;
                $data['msg'] = "Periode baru telah berhasil dibuat";
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Terjadi kesalahan dalam menyimpan data";
            }

            echo json_encode($data);
        }

        function editPeriode($id){
            if($this->model_remun->checkPeriode($id)){
                $dataPeriode = $this->model_remun->getPeriode($id);
                $data['periode'] = $dataPeriode;
                $data['page_title'] = "Set Up Periode - Proses Remun";
                $data['topbar_title'] = "Periode ".$dataPeriode['periode'];
                $data['bread'] = [
                    [false, "Proses Remun", "javascript:void(0);"],
                    [false, "Set Up Periode", base_url("proses-remun/set-up-periode")],
                    [true, "Periode ".$dataPeriode['periode'], "javascript:void(0);"]
                ];
                $data['edit'] = true;
                $data['pegawai'] = $this->model_remun->getPegawaiRem();
                $data['js'] = APPPATH."views/proses_remun/set_periode/set_periode_form_js.php";
                $this->themes->primary("proses_remun/set_periode/set_periode_form", $data);
            }
            else{
                $this->themes->error_404();
            }
        }

        function updatePeriode($id){
            if($this->model_remun->checkPeriode($id)){

                $rektor = $this->input->post("rektor");
                $wrektor = $this->input->post("wakil_rektor");
                $kepala_buk = $this->input->post("kepala_buk");
                $bendahara = $this->input->post("bendahara");

                $dataRektor = $this->model_remun->getPegawaiRem($rektor);
                $dataWRektor = $this->model_remun->getPegawaiRem($wrektor);
                $dataKepalaBUK = $this->model_remun->getPegawaiRem($kepala_buk);
                $dataBendahara = $this->model_remun->getPegawaiRem($bendahara);

                //Set $data
                $set = [
                    "periode" => $this->input->post("periode"),
                    "tglmulai" => $this->input->post("tgl_mulai"),
                    "tglakhir" => $this->input->post("tgl_berakhir"),
                    "pir" => $this->input->post("pir"),
                    "reduksi_real" => $this->input->post("reduksi"),
                    "tglbayar1" => $this->input->post("tgl_bayar1"),
                    "remundos1" => $this->input->post("remundos1"),
                    "remunpeg1" => $this->input->post("remunpeg1"),
                    "judul11" => $this->input->post("judul11"),
                    "judul12" => $this->input->post("judul12"),
                    "tglbayar2" => $this->input->post("tgl_bayar2"),
                    "remundos2" => $this->input->post("remundos2"),
                    "remunpeg2" => $this->input->post("remunpeg2"),
                    "judul21" => $this->input->post("judul21"),
                    "judul22" => $this->input->post("judul22"),
                    "nmarektor" => $dataRektor['nmapanjang'],
                    "niprektor" => $dataRektor['nip'],
                    "nmawr2" => $dataWRektor['nmapanjang'],
                    "nipwr2" => $dataWRektor['nip'],
                    "nmakabuk" => $dataKepalaBUK['nmapanjang'],
                    "nipkabuk" => $dataKepalaBUK['nip'],
                    "nmabendahara" => $dataBendahara['nmapanjang'],
                    "nipbendahara" => $dataBendahara['nip'],
                    "tglakses" => $this->currentTime,
                    "stsrek" => $this->input->post("status_periode")
                ];

                $update = $this->db->update("tr_periode", $set, ["idi" => $id]);
                if($update){
                    $data['result'] = true;
                    $data['msg'] = "Periode telah berhasil diperbarui";
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Terjadi kesalahan dalam menyimpan data";
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Periode tidak ketahui. Gagal mengupdate periode";
            }

            echo json_encode($data);
        }

        function delPeriode($id){
            if($this->model_remun->checkPeriode($id)){
                $dataPeriode = $this->model_remun->getPeriode($id);
                $periode = $dataPeriode['periode'];

                $allowDelete = true;
                //Checking data
                $checkDokumen = $this->db->select("COUNT(*) as total")->get_where("tr_dokumen", ["periode" => $periode])->row_array();
                if($checkDokumen['total'] > 0){ $allowDelete = false; }
                $checkAktivitas = $this->db->select("COUNT(*) as total")->get_where("tr_aktivitas", ["periode" => $periode])->row_array();
                if($checkAktivitas['total'] > 0){ $allowDelete = false; }
                $checkTusi = $this->db->select("COUNT(*) as total")->get_where("tr10_tusi", ["periode" => $periode])->row_array();
                if($checkTusi['total'] > 0){ $allowDelete = false; }
                $checkMengajar = $this->db->select("COUNT(*) as total")->get_where("tr21_pendikajar", ["periode" => $periode])->row_array();
                if($checkMengajar['total'] > 0){ $allowDelete = false; }
                $checkMengajarLainnya = $this->db->select("COUNT(*) as total")->get_where("tr22_pendikinst", ["periode" => $periode])->row_array();
                if($checkMengajarLainnya['total'] > 0){ $allowDelete = false; }
                $checkPenelitian = $this->db->select("COUNT(*) as total")->get_where("tr31_penlit", ["periode" => $periode])->row_array();
                if($checkPenelitian['total'] > 0){ $allowDelete = false; }
                $checkPengabdian = $this->db->select("COUNT(*) as total")->get_where("tr32_pengabdian", ["periode" => $periode])->row_array();
                if($checkPengabdian['total'] > 0){ $allowDelete = false; }
                $checkPenghargaan = $this->db->select("COUNT(*) as total")->get_where("tr40_penghargaan", ["periode" => $periode])->row_array();
                if($checkPenghagaan['total'] > 0){ $allowDelete = false; }
                $checkPenunjang = $this->db->select("COUNT(*) as total")->get_where("tr50_penunjang", ["periode" => $periode])->row_array();
                if($checkPenunjang['total'] > 0){ $allowDelete = false; }

                if($allowDelete){
                    $this->db->delete("tr_periode", ["idi" => $id]);
                    $data['result'] = true;
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Periode sedang digunakan. <br/>Tidak dapat menghapus periode";
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Periode tidak ketahui. <br/>Gagal menghapus periode";
            }
            echo json_encode($data);
        }

        //End Set Up Periode -----------------------------------------------------------------

        //Dokumen Pendukung ------------------------------------------------------------------
        function dokumenPendukung(){
            $data['page_title'] = "Dokumen Pendukung - Proses Remun";
            $data['topbar_title'] = "Dokumen Pendukung";
            $data['bread'] = [
                [false, "Proses Remun", "javascript:void(0);"],
                [true, "Dokumen Pendukung", "javascript:void(0);"]
            ];
            $data['dokumen_pendukung'] = $this->model_remun->getDokumen();
            $data['js'] = APPPATH."views/proses_remun/dokumen_pendukung/dokumen_pendukung_js.php";
            $this->themes->primary("proses_remun/dokumen_pendukung/dokumen_pendukung", $data);
        }
        
        function dokumenBaru(){
            $data['page_title'] = "Dokumen Pendukung - Proses Remun";
            $data['topbar_title'] = "Dokumen Baru";
            $data['bread'] = [
                [false, "Proses Remun", "javascript:void(0);"],
                [false, "Dokumen Pendukung", base_url("proses-remun/dokumen-pendukung")],
                [true, "Dokumen Baru", "javascript:void(0);"]
            ];
            $data['edit'] = false;

            //Data For Form
            $data['periode'] = $this->model_remun->getPeriode();
            $data['unit_kerja'] = $this->model_remun->getUnitKerja();
            $data['pekerjaan'] = $this->model_remun->getPekerjaan();

            $data['js'] = APPPATH."views/proses_remun/dokumen_pendukung/dokumen_pendukung_form_js.php";
            $this->themes->primary("proses_remun/dokumen_pendukung/dokumen_pendukung_form", $data);
        }

        function editDokumen($id){
            if($this->model_remun->checkDokumen($id)){
                $dataDokumen = $this->model_remun->getDokumen($id);
                $data['page_title'] = "Dokumen Pendukung - Proses Remun";
                $data['topbar_title'] = "Dokumen ".$dataDokumen['nomskdokumen'];
                $data['bread'] = [
                    [false, "Proses Remun", "javascript:void(0);"],
                    [false, "Dokumen Pendukung", base_url("proses-remun/dokumen-pendukung")],
                    [true, "Dokumen ".$dataDokumen['nomskdokumen'], "javascript:void(0);"]
                ];

                $data['edit'] = true;
    
                //Data For Form
                $data['dokumen'] = $dataDokumen;
                $data['periode'] = $this->model_remun->getPeriode();
                $data['unit_kerja'] = $this->model_remun->getUnitKerja();
                $data['satuan_kerja'] = $this->db->get_where("tmsatker", ["kdeukerja" => $dataDokumen['kdeukerja']])->result();
                $data['aktivitas'] = $this->db->get_where("tbaktivitas", ["kdepekerjaan" => $dataDokumen['kdepekerjaan']])->result();
                $data['pekerjaan'] = $this->model_remun->getPekerjaan();
    
                $data['js'] = APPPATH."views/proses_remun/dokumen_pendukung/dokumen_pendukung_form_js.php";
                $this->themes->primary("proses_remun/dokumen_pendukung/dokumen_pendukung_form", $data);
            }
            else{

            }
        }

        function updateDokumen($id){
            if($this->model_remun->checkDokumen($id)){
                $dataDokumen = $this->model_remun->getDokumen($id);
                $uid = $dataDokumen['udi'];

                //Set Data
                $set = [
                    "periode" => $this->input->post("periode"),
                    "kdeukerja" => $this->input->post("unit_kerja"),
                    "kdesatker" => $this->input->post("satuan_kerja"),
                    "kdepekerjaan" => $this->input->post("pekerjaan"),
                    "kdeaktivitas" => $this->input->post("aktivitas"),
                    "tglskdokumen" => $this->input->post("tglskdokumen"),
                    "nomskdokumen" => $this->input->post("nomskdokumen"),
                    "judul" => $this->input->post("judul"),
                    "tglmulai" => $this->input->post("tglmulai"),
                    "tglakhir" => $this->input->post("tglakhir"),
                    "jumlahdana" => $this->input->post("jumlahdana"),
                    "sumberdana" => $this->input->post("sumberdana"),
                    "tglakses" => $this->currentTime,
                    "email"  => $this->session->userdata("email")
                ];

                if(empty($_FILES['dokumen']['name'])){
                    $this->db->update("tr_dokumen", $set, ["idi" => $id]);
                    $data['result'] = true;
                    $data['msg'] = "Berhasil memperbarui dokumen";
                }  
                else{
                    //Remove File Before Updating
                    unlink("./assets/dokumen/".$dataDokumen['dok_trdok']);

                    $uid = $this->uuid->v4(true);
                    $config['upload_path'] = './assets/dokumen/';
                    $config['allowed_types'] = 'pdf|doc|docx';
                    $config['max_size'] = 2048;
                    $config['file_name'] = $uid;
                    $config["overwrite"] = true;

                    $this->upload->initialize($config);
                    if($this->upload->do_upload("dokumen")){
                        $hasil = $this->upload->data();
    
                        $set['dok_trdok'] = $hasil['file_name'];
                        $this->db->update("tr_dokumen", $set, ["idi" => $id]);
                        $data['result'] = true;
                        $data['msg'] = "Berhasil memperbarui dokumen";
                    }
                    else{
                        $data['result'] = false;
                        $data['msg'] = $this->upload->display_errors();
                    }
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Terjadi kesalahan dalam memperbarui dokumen";
            }

            echo json_encode($data);
        }

        function newDokumen(){
            if(!empty($_FILES['dokumen']['name'])){
                $uid = $this->uuid->v4(true);
                $config['upload_path'] = './assets/dokumen/';
                $config['allowed_types'] = 'pdf|doc|docx';
                $config['max_size'] = 2048;
                $config['file_name'] = $uid;
                $config["overwrite"] = true;
    
                $this->upload->initialize($config);
                if($this->upload->do_upload("dokumen")){
                    $hasil = $this->upload->data();
    
                    $file = $hasil['file_name'];
    
                    //Set Data
                    $set = [
                        "udi" => $uid,
                        "periode" => $this->input->post("periode"),
                        "kdeukerja" => $this->input->post("unit_kerja"),
                        "kdesatker" => $this->input->post("satuan_kerja"),
                        "kdepekerjaan" => $this->input->post("pekerjaan"),
                        "kdeaktivitas" => $this->input->post("aktivitas"),
                        "tglskdokumen" => $this->input->post("tglskdokumen"),
                        "nomskdokumen" => $this->input->post("nomskdokumen"),
                        "judul" => $this->input->post("judul"),
                        "tglmulai" => $this->input->post("tglmulai"),
                        "tglakhir" => $this->input->post("tglakhir"),
                        "jumlahdana" => $this->input->post("jumlahdana"),
                        "sumberdana" => $this->input->post("sumberdana"),
                        "dok_trdok" => $file,
                        "tglakses" => $this->currentTime,
                        "email"  => $this->session->userdata("email")
                    ];
    
                    $inserting = $this->db->insert("tr_dokumen", $set);
                    if($inserting){
                        $data['result'] = true;
                        $data['msg'] = "Berhasil membuat dokumen baru";
                    }
                    else{
                        $data['result'] = false;
                        $data['msg'] = "Gagal membuat dokumen baru";
                    }
    
                }
                else{
                    $data['result'] = false;
                    // $data['msg'] = "Terjadi kesalahan dalam mengupload dokumen anda.";
                    $data['msg'] = $this->upload->display_errors();
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Harap menyertakan file dokumen anda";
            }
            echo json_encode($data);
        }

        function deleteDokumen($id){
            if($this->model_remun->checkDokumen($id)){
                $dataDokumen = $this->model_remun->getDokumen($id);
                unlink("./assets/dokumen/".$dataDokumen['dok_trdok']);
                $this->db->delete("tr_dokumen", ["idi" => $id]);
                $data['result'] = true;
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Dokumen tidak diketahui. Gagal menghapus dokumen";
            }
            echo json_encode($data);
        }

        function downloadDokumen($id){
            if($this->model_remun->checkDokumen($id)){
                $dataDokumen = $this->model_remun->getDokumen($id);
                // $data['result'] = true;
                force_download("./assets/dokumen/".$dataDokumen['dok_trdok'], null);
            }
            else{
                // $data['result'] = false;
                // $data['msg'] = "Terjadi kesalahan dalam mendownload dokumen";
                $this->themes->error_404();
            }
            // echo json_encode($data);
        }

        function getSatuanKerja(){
            $kdeukerja = $this->input->post("unit");
            $data['satuan_kerja'] = $this->db->get_where("tmsatker", ["kdeukerja" => $kdeukerja])->result();
            echo json_encode($data);
        }

        function getAktivitas(){
            $kdepekerjaan = $this->input->post("pekerjaan");
            $data['aktivitas'] = $this->db->get_where("tbaktivitas", ["kdepekerjaan" => $kdepekerjaan])->result();
            echo json_encode($data);
        }

        //End Dokumen Pendukung --------------------------------------------------------------

        //Ativtias ---------------------------------------------------------------------------
        // Backup Of Ativitas
        // function ativitas(){
        //     $data['page_title'] = "Ativitas - Proses Remun";
        //     $data['topbar_title'] = "Ativitas";
        //     $data['bread'] = [
        //         [false, "Proses Remun", "javascript:void(0);"],
        //         [true, "Ativtias", "javascript:void(0);"],
        //     ];

        //     //Data For Form
        //     $data['pegawai'] = $this->model_remun->getPegawaiRem();
        //     $data['periode'] = $this->model_remun->getPeriode();

        //     $data['js'] = APPPATH."views/proses_remun/ativitas/ativitas_js.php";
        //     $this->themes->primary("proses_remun/ativitas/ativitas", $data);
        // }

        function ativitasPerTransaksi(){
            $data['page_title'] = "Ativitas Per Transaksi - Proses Remun";
            $data['topbar_title'] = "Ativitas Per Transaksi";
            $data['bread'] = [
                [false, "Proses Remun", "javascript:void(0);"],
                [false, "Ativtias", "javascript:void(0);"],
                [true, "Per Transaksi", "javascript:void(0);"]
            ];

            //Data For Form
            $data['pegawai'] = $this->model_remun->getPegawaiRem();
            $data['periode'] = $this->model_remun->getPeriode();

            $data['js'] = APPPATH."views/proses_remun/ativitas_transaksi/ativitas_js.php";
            $this->themes->primary("proses_remun/ativitas_transaksi/ativitas", $data);
        }

        function ativitasSemuaTransaksi(){
            $data['page_title'] = "Ativitas Semua Transaksi - Proses Remun";
            $data['topbar_title'] = "Ativitas Semua Transaksi";
            $data['bread'] = [
                [false, "Proses Remun", "javascript:void(0);"],
                [false, "Ativtias", "javascript:void(0);"],
                [true, "Semua Transaksi", "javascript:void(0);"]
            ];

            //Data For Form
            $data['pegawai'] = $this->model_remun->getPegawaiRem();
            $data['periode'] = $this->model_remun->getPeriode();

            $data['js'] = APPPATH."views/proses_remun/ativitas_full/ativitas_js.php";
            $this->themes->primary("proses_remun/ativitas_full/ativitas", $data);
        }

        // Backup Of Search Ativitas ----------------------------------------------------------------
        function searchAtivitasPerTransaksi(){
            $kdepeg = $this->input->post("pegawai");
            $periode = $this->input->post("periode");
            $transaksi = $this->input->post("transaksi");

            if($transaksi == "Tupoksi"){
                $setData = $this->model_aktivitas->tusi_aktivitas($kdepeg, $periode);
            }
            else if($transaksi == "Mengajar"){
                $setData = $this->model_aktivitas->pendikajar_aktivitas($kdepeg, $periode);
            }
            else if($transaksi == "Mengajar Lainnya"){
                $setData = $this->model_aktivitas->pendikinst_aktivitas($kdepeg, $periode);
            }
            else if($transaksi == "Penelitian"){
                $setData = $this->model_aktivitas->penlit_aktivitas($kdepeg, $periode);
            }
            else if($transaksi == "Pengabdian"){
                $setData = $this->model_aktivitas->pengabdian_aktivitas($kdepeg, $periode);
            }
            else if($transaksi == "Penghargaan"){
                $setData = $this->model_aktivitas->penghargaan_aktivitas($kdepeg, $periode);
            }
            else if($transaksi == "Penunjang"){
                $setData = $this->model_aktivitas->penunjang_aktivitas($kdepeg, $periode);
            }

            $data['aktivitas'] = $setData;
            $data['transaksi'] = $transaksi;

            echo json_encode($data);
        }

        function searchAtivitasFull(){
            $kdepeg = $this->input->get_post("pegawai");
            $periode = $this->input->get_post("periode");

            //Jumlah Pegawai
            // $jlhpeg = $this->model_pegawai->countAllPegawaiRem();

            //Data Periode
            // $dataPeriode = $this->db->get_where("tr_periode", ["periode" => $periode])->row_array();
            // $pir = $dataPeriode['pir'];

            //Data Total
            // $data['nkp'] = $this->model_aktivitas->getNkpPegawai($kdepeg, $pir);
            // $data['hargaperpoin'] = $data['nkp']*6/40;
            // $data['gaji30p'] = $data['nkp']*30/100; //30%
            // $data['intensif25p'] = ($data['nkp'] - $data['gaji30p'])*25/100; //25%
            // $data['intensif100p'] = $data['nkp']*70/100; //70%
            // $data['intensif150p'] = $data['intensif100p']*150/100; //150%
            // $data['intensif200p'] = $data['intensif100p']*200/100; //200%
            // $data['remun25psmt'] = $data['intensif25p']*6;
            // $data['remun100psmt'] = $data['intensif100p']*6;
            // $data['remun150psmt'] = $data['intensif150p']*6;
            // $data['remun200psmt'] = $data['intensif200p']*6;
            // $data['rem100p12bln']= $data['nkp'];
            // $data['rem100p_thn_gj13_thr'] = $data['rem100p12bln']*14;
            // $data['remmaxpthn'] = ($data['nkp']*2+$data['gaji30p']*12+$data['intensif150p']*12)*$jlhpeg;
            $data['pegawai'] = $this->model_pegawai->getPegawaiRem($kdepeg);
            
            $kdejnspeg = $data['pegawai']['kdejnspeg'];
            if($kdejnspeg == "DT" || $kdejnspeg == "PJFT" || $kdejnspeg == "PJFU" || $kdejnspeg == "PST"){
                $jab_1 = $data['pegawai']['kdeklsjab'];
                $jab_2 = $data['pegawai']['kdeklsjabf'];
            }
            else if($kdejnspeg == "DB"){
                $jab_1 = $data['pegawai']['kdeklsjabf'];
                $jab_2 = $data['pegawai']['kdeklsjab'];
            }

            //Data Kelas Jab 1
            $dataJab1 = $this->model_pegawai->getKlsJab($jab_1);
            $data['pegawai']['kdeklsjab'] = $jab_1;
            $data['pegawai']['jabatan_1'] = $dataJab1['nmaklsjab'];

            //Data Kelas Jab 2
            $dataJab2 = $this->model_pegawai->getKlsJab($jab_2);
            $data['pegawai']['kdeklsjabf'] = $jab_2;
            $data['pegawai']['jabatan_2'] = $dataJab2['nmaklsjab'];

            //Data Satker
            $dataSatker = $this->model_pegawai->getSatKer($data['pegawai']['kdesatker']);
            $data['pegawai']['satuan_kerja'] = $dataSatker['nmasatker'];

            $data['rekapitulasi'] = $this->model_aktivitas->getRekapitulasiPeg($kdepeg, $periode);

            $data['tupoksi'] = $this->model_aktivitas->tusi_aktivitas($kdepeg, $periode);
            $data['mengajar'] = $this->model_aktivitas->pendikajar_aktivitas($kdepeg, $periode);
            $data['mengajar_lainnya'] = $this->model_aktivitas->pendikinst_aktivitas($kdepeg, $periode);
            $data['penelitian'] = $this->model_aktivitas->penlit_aktivitas($kdepeg, $periode);
            $data['pengabdian'] = $this->model_aktivitas->pengabdian_aktivitas($kdepeg, $periode);
            $data['penghargaan'] = $this->model_aktivitas->penghargaan_aktivitas($kdepeg, $periode);
            $data['penunjang'] = $this->model_aktivitas->penunjang_aktivitas($kdepeg, $periode);

            // echo "<pre>".json_encode($data, JSON_PRETTY_PRINT)."</pre>";
            
            header('Content-Type: application/json');
            echo json_encode($data, JSON_PRETTY_PRINT);
        }
        //End Ativtias -----------------------------------------------------------------------
    }
?>
