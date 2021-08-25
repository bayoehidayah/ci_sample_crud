<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Barang extends CI_Controller{

        private $currentTime;

        function __construct(){
            parent::__construct();
            date_default_timezone_set("Asia/Jakarta");
            $this->currentTime = date("Y-m-d H:i:s");
        }

        public function listBarang(){
            $data['page_title']   = "Barang";
            $data['topbar_title'] = "Barang";
			$data['js']           = APPPATH."/views/barang/list-js.php";
            $data['bread']        = [
              [false, "Home", base_url("dashboard")],
              [true, "Barang", "javascript:void(0);"],
            ];
            $this->themes->primary("barang/list", $data);
        }

        public function getListBarang(){
            $search        = $_POST['search']['value'];
            $limit         = $_POST['length'];
            $start         = $_POST['start'];
            $order_index   = $_POST['order'][0]['column'];
            $order_field   = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];

            $sql_total  = $this->model_barang->countAllBarang(); 
            $sql_data   = $this->model_barang->barangFilter($search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_barang->countFilterBarang($search);
            $callback   = array(
                'draw'            => $_POST['draw'],
                'recordsTotal'    => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data'            => $sql_data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
        }

        public function barangFormActions(){
            try {
                $id   = $this->input->post("id");
                $edit = $this->input->post("edit");

                if(!$this->model_barang->checkBarang($id) && $edit == "1"){
                    $data['result'] = false;
                    $data['msg']    = "Data tidak diketahui";
                }
                else{
                    $set = [
                        "nama"  => $this->input->post("nama"),
                        "harga" => $this->input->post("harga")
                    ];

					$this->db->trans_begin();

                    if($edit == "1"){
                        $set["updated_at"] = $this->currentTime;
                        $doActions         = $this->db->where("id", $id)->update("barang", $set);
                    }
                    else{
                        $set["id"]         = $this->uuid->v4(true);
                        $set["created_at"] = $this->currentTime;
                        $doActions         = $this->db->insert("barang", $set);
                    }

                    if(!$doActions){
						throw new \Exception("Terjadi kesalahan dalam menyimpan data");
					}
                    
					$data['result'] = true;
					$data['msg'] = "Data telah berhasil disimpan";
					$this->db->trans_commit();
                }
            } catch (\Throwable $th) {
				$this->db->trans_rollback();
                $data['result'] = false;
                $data['msg'] = $th->getMessage();
            }
                
            echo json_encode($data);
        }

        public function barangData($id){
            if($this->model_barang->checkBarang($id)){
                $data["result"] = true;
                $data["data"] = $this->model_barang->getData($id);
            }
            else{
                $data['result'] = false;
                $data['msg'] = "Barang tidak diketahui";
            }

            echo json_encode($data);
        }

        public function deleteBarang($id){
			try {
				if(!$this->model_barang->checkBarang($id)){
					throw new \Exception("Barang tidak diketahui");
				}
				$this->db->trans_begin();
				$delete = $this->db->delete("barang", ["id" => $id]);

				if(!$delete){
					throw new \Exception("Terjadi kesalahan dalam menghapus barang");
				}

				$data['result'] = true;
				$this->db->trans_commit();
				
			} catch (\Throwable $th) {
				$this->db->trans_rollback();
				$data['result'] = false;
				$data['msg'] = $th->getMessage();
			}
            
            echo json_encode($data);
        }
    }
?> 
