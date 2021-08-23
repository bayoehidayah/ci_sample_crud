<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Simpanan extends CI_Controller{
    
        private $id;
        private $currentTime;
        private $akses;

        function __construct(){
            parent::__construct();
            check_session();
            date_default_timezone_set("Asia/Jakarta");
            $this->id          = $this->session->userdata("id");
            $this->currentTime = date("Y-m-d H:i:s");
            $this->akses       = $this->session->userdata("tipe");
        }

        public function show_all(){
            $data['page_title'] = "Simpanan";
            $data['topbar_title'] = "Simpanan";
            $data['bread'] = [
              [false, "Home", base_url("dashboard")],
              [true, "Simpanan", "javascript:void(0);"],
            ];

			$data["jenis"]  = $this->model_simpanan->listJenis;
			$data["users"]  = $this->db->get("users")->result();
            $data['js'] 	= APPPATH."/views/simpanan/show-all-js.php";
            $this->themes->primary("simpanan/show-all", $data);
        }

        public function getListSimpanan(){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];

            $sql_total = $this->model_simpanan->countAllSimpanan(); 
            $sql_data = $this->model_simpanan->simpananFilter($search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_simpanan->countFilterSimpanan($search);

            $callback = array(
                'draw'            => $_POST['draw'],
                'recordsTotal'    => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data'            => $sql_data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
        }

		public function saveSimpanan(){
			try {
				$id      = $this->input->post("id");
				$edit    = $this->input->post("edit");
				$id_user = $this->input->post("id_users");
				if(!$this->model_users->checkData(["id" => $id_user])){
					throw new \Exception("Pengguna tidak diketahui");
				}

				$simpanan = $this->input->post("jenis");
				if(!in_array($simpanan, $this->model_simpanan->listJenis)){
					throw new \Exception("Jenis simpanan tidak diketahui");
				}

				$set = [
					"id_user"    => $id_user,
					"jenis"      => $simpanan,
					"nilai"      => $this->input->post("nilai"),
					"updated_at" => $this->currentTime,
				];

				if($edit == "false"){
					$set["created_at"] = $this->currentTime;
					$save = $this->db->insert("simpanan", $set);
				}
				else{
					$save = $this->db->update("simpanan", $set, ["id" => $id]);
				}

				if(!$save){
					throw new \Exception("Terjadi kesalahan dalam menyimpan data");
				}

				$data = [
					"result" => true,
					"msg" => "Berhasil menyimpan data"
				];

			} catch (\Throwable $th) {
				$data = [
					"result" => false,
					"msg" => $th->getMessage()
				];
			}

			echo json_encode($data);
		}

		public function showSimpanan($id){
			try {
                if(!$this->model_simpanan->checkData($id)){
                    throw new \Exception("Data tidak ditemukan");
                }

                $dataSimpanan = $this->db
					->get_where("simpanan", ["id" => $id])
					->row_array();

                $data = [
                    "result" => true,
                    "msg"    => "Berhasil mengambil data",
                    "data"   => $dataSimpanan
                ];

            } catch (\Throwable $th) {
                $data = [
                    "result" => false,
                    "msg"    => $th->getMessage()
                ];
            }

            echo json_encode($data);
		}

		public function deleteSimpanan($id){
            try {
                if(!$this->model_simpanan->checkData($id)){
                    throw new \Exception("Data tidak diketahui");
                }

                $this->db->delete("simpanan", ["id" => $id]);
                $data['result'] = true;
            } catch (\Throwable $th) {
                $data = [
                    "result" => false,
                    "msg"    => $th->getMessage()
                ];
            }

            echo json_encode($data);
        }
    }
?>
