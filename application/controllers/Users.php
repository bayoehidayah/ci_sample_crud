<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Users extends CI_Controller{

        private $currentTime;
        private $akses;

        function __construct(){
            parent::__construct();
            check_session();
            date_default_timezone_set("Asia/Jakarta");
            $this->currentTime = date("Y-m-d H:i:s");
            $this->akses = $this->session->userdata("tipe");
        }

        public function new_id($type){
            echo $this->model_users->generateNewID($type);
        }

        public function showAll(){
            $data['page_title'] = "Pengguna";
            $data['topbar_title'] = "Pengguna";
            $data['bread'] = [
              [false, "Home", base_url("dashboard")],
              [false, "Pengguna", "javascript:void(0);"],
            ];
            $data['js'] = APPPATH."/views/users/show-all-js.php";
            $this->themes->primary("users/show-all", $data);
        }

        public function showAllDatas(){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];

            $sql_total = $this->model_users->countAllUsers(); 
            $sql_data = $this->model_users->usersFilter($search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_users->countFilterUsers($search);

            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
        }

        public function form($id = null){
            $data['page_title'] = "Pengguna Baru";
            $data['topbar_title'] = "Pengguna Baru";
            $data['bread'] = [
              [false, "Home", base_url("dashboard")],
              [false, "Pengguna", base_url("pengguna")],
              [true, "Pengguna Baru", "javascript:void(0);"],
            ];

            //Datas For Form
            $data["type"] = $this->model_users->listType;
            $data["edit"] = false;
            $data['js'] = APPPATH."/views/users/form-js.php";
            
            if($id != null){
                if(!$this->model_auth->checkPengguna($id)){
                    $this->themes->error_404();
                }
                else{
                    $data['page_title']   = "Edit Pengguna";
                    $data['topbar_title'] = "Edit Pengguna";
                    $data["bread"][2]     = [true, "Edit Pengguna", "javascript:void(0);"];
    
                    $data["pengguna"] = $this->model_users->getData($id);
                    $data["edit"]     = true;
                    $this->themes->primary("users/form", $data);
                }
            }
            else{
                $this->themes->primary("users/form", $data);
            }
        }

        public function downloadPhoto($id){
            if($this->model_auth->checkPengguna($id)){
                $pengguna = $this->model_users->getData($id);
                force_download("./assets/photos/pengguna/".$pengguna->photo, null);
            }
            else{
                $this->themes->error_404();
            }
        }

        public function formActions(){
            try {
                $edit  = false;
                $id    = $this->input->post("id");
                $email = $this->input->post("email");
                $tipe  = $this->input->post("tipe");

                //Check jika memiliki data yang sama
                if($this->model_users->checkData([
                    "id"    => $id,
                    "email" => $email,
                    "tipe"  => $tipe
                ])){
                    $edit = true;
                }

                //Check ID jika sudah digunakan automatis mengganti ke yang terbaru
                if($this->model_auth->checkPengguna($id) && !$edit){
                    $id   = $this->model_users->generateNewID($tipe);
                }

                //Check Email
                $checkEmail = $this->db->where("email", $email)->where("id !=", $id)->get("users")->num_rows();
                if($checkEmail > 0){
                    $data["result"] = false;
                    $data["msg"]    = "Email telah digunakan. Silahkan menggunakan email yang lain";
                }
                else{
                    if(!empty($_FILES['foto']['name'])){
                        if($edit){
                            $dataUser = $this->model_auth->getDataUser(["id" => $id]);
                            $photoBefore = $dataUser["photo"];

                            //Check if foto already exist
                            if($photoBefore != "" || $photoBefore != null){
                                $pathBefore = "./assets/photos/pengguna/".$photoBefore;
                                if(file_exists($pathBefore)){
                                    unlink($pathBefore);
                                }
                            }
                        }

                        $uid                     = $this->uuid->v4(true);
                        $config['upload_path']   = './assets/photos/pengguna';
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['max_size']      = 2048;
                        $config['file_name']     = $id."_".$uid;
                        $config["overwrite"]     = true;
        
                        $this->upload->initialize($config);
                        if($this->upload->do_upload("foto")){
                            $hasil       = $this->upload->data();
                            $file        = $hasil['file_name'];
                            $pasfoto     = $file;
                            $allowInsert = true;
                        }
                        else{
                            $pasfoto     = null;
                            $error       = $this->upload->display_errors();
                            $allowInsert = false;
                        }
                    }
                    else{
                        $pasfoto     = null;
                        $allowInsert = true;
                    }

                    $have_ktp = $this->input->post("no_ktp") != "" && $this->input->post("no_ktp") != null ? true : false;
        
                    if($allowInsert){
                        $set = [
                            "nama"      => $this->input->post("nama"),
                            "tipe"      => $tipe,
                            "email"     => $this->input->post("email"),
                            "nama_anak" => $this->input->post("nama_anak"),
                            "alamat"    => $this->input->post("alamat"),
                            "nik"       => $this->input->post("nik"),
                            "pekerjaan" => $this->input->post("pekerjaan"),
                            "no_hp"     => $this->input->post("no_hp"),
                            "no_rek"    => $this->input->post("no_rek"),
                            "bank"      => $this->input->post("bank"),
                            "no_ktp"    => $this->input->post("no_ktp"),
                            "have_ktp"  => $have_ktp,
                            "photo"     => $pasfoto
                        ];

                        $password = $this->input->post("password");

                        if($edit){
                            if($password != "" && $password != null){
                                $set["password"] = password_hash($password, PASSWORD_BCRYPT);
                            }
                            
                            $set["updated_at"] = $this->currentTime;
                            $doActions = $this->db->where("id", $id)->update("users", $set);
                        }
                        else{
                            $set["id"]         = $id;
                            $set["password"]   = password_hash($password, PASSWORD_BCRYPT);
                            $set["created_at"] = $this->currentTime;
                            $doActions = $this->db->insert("users", $set);
                        }
                        if($doActions){
                            $data['result'] = true;
                            $data['msg'] = "Pengguna baru telah berhasil disimpan";
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
                
            } catch (\Throwable $th) {
                $data['result'] = false;
                $data['msg'] = $th->getMessage();
            }
            
            echo json_encode($data);
        }

        public function delete($id){
            if($this->akses == "admin"){
                if($this->model_auth->checkPengguna($id)){
                    $dataPengguna = $this->model_auth->getDataUser(["id" => $id]);
                    $delete       = $this->db->delete("users", ["id" => $id]);
    
                    if($delete){
                        if($dataPengguna['photo'] != null || $dataPengguna['photo'] != ""){
                            $path = "./assets/photos/pengguna/".$dataPengguna['photo'];
                            if(file_exists($path)){
                                unlink($path);
                            }
                        }
    
                        $data['result'] = true;
                    }
                    else{
                        $data['result'] = false;
                        $data['msg']    = "Terjadi kesalahan dalam menghapus pengguna";
                    }
                }
                else{
                    $data['result'] = false;
                    $data['msg'] = "Pengguna tidak diketahui";
                }
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Anda tidak mempunyai hak untuk melakukan ini";
            }

            echo json_encode($data);
        }
    }
?>