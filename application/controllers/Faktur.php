<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Faktur extends CI_Controller{

        private $currentTime;

        function __construct(){
            parent::__construct();
            date_default_timezone_set("Asia/Jakarta");
            $this->currentTime = date("Y-m-d H:i:s");
        }

        public function showAllFaktur(){
            $data['page_title']   = "Faktur";
            $data['topbar_title'] = "Faktur";
			$data['js']           = APPPATH."/views/faktur/list-js.php";
            $data['bread']        = [
              [false, "Home", base_url("dashboard")],
              [true, "Faktur", "javascript:void(0);"],
            ];
            $this->themes->primary("faktur/list", $data);
        }

        public function form(){
			$title 				  = "Faktur Baru";
			$data["edit"] 		  = false;
            $data['page_title']   = $title;
            $data['topbar_title'] = $title;
			$data['js']           = APPPATH."/views/faktur/form-js.php";
			$data["title"] 		  = $title;
			$data["barang"]		  = $this->db->get("barang")->result();
            $data['bread']        = [
              [false, "Home", base_url("dashboard")],
              [false, "Faktur", base_url("faktur")],
              [true, $title, "javascript:void(0);"],
            ];
            $this->themes->primary("faktur/form", $data);
        }

		public function editData($id){
            if($this->model_faktur->checkData($id)){
                $data["faktur"]   = $this->model_faktur->getData($id);
				$title 				  = "Edit Faktur";
				$data["edit"] 		  = true;
				$data['page_title']   = $title;
				$data['topbar_title'] = $title;
				$data['js']           = APPPATH."/views/faktur/form-js.php";
				$data["title"] 		  = $title;
				$data["barang"]		  = $this->db->get("barang")->result();
				$data['bread']        = [
					[false, "Home", base_url("dashboard")],
					[false, "Faktur", base_url("faktur")],
					[true, $title, "javascript:void(0);"],
				];

				$data["list_items"] = [];
				foreach($this->model_faktur->getFakturChild($id) as $row){
					array_push($data["list_items"], [
						"id_barang"    => $row->id_barang,
						"nama_barang"  => $row->nama_barang,
						"total_barang" => $row->total_barang,
						"total_harga"  => $row->total_harga,
					]);
				}

				$this->themes->primary("faktur/form", $data);
            }
			else{
				redirect(base_url("faktur"));
			}
        }

        public function getListFakturData(){
            $search        = $_POST['search']['value'];
            $limit         = $_POST['length'];
            $start         = $_POST['start'];
            $order_index   = $_POST['order'][0]['column'];
            $order_field   = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];

            $sql_total  = $this->model_faktur->countAllFaktur(); 
            $sql_data   = $this->model_faktur->fakturFilter($search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_faktur->countFilterFaktur($search);
            $callback   = array(
                'draw'            => $_POST['draw'],
                'recordsTotal'    => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data'            => $sql_data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
        }

        public function saveFaktur(){
            try {
				$id  = $this->uuid->v4(true);
				$set = [
					"nama_pelanggan" => $this->input->post("nama_pelanggan"),
					"total_items"    => 0,
					"total_harga"    => 0
				];

				$this->db->trans_begin();
				
				$set["id"]         = $id;
				$set["created_at"] = $this->currentTime;
				$doActions         = $this->db->insert("faktur", $set);

				if(!$doActions){
					throw new \Exception("Terjadi kesalahan dalam menyimpan data");
				}
				
				//Count Data
				$items        = json_decode($this->input->post("items"));
				$total_barang = 0;
				$total_harga  = 0;
				foreach($items as $key => $item){
					$setItem = [
						"id_faktur"    => $id,
						"id_barang"    => $item->id_barang,
						"nama_barang"  => $item->nama_barang,
						"total_barang" => $item->total_barang,
						"total_harga"  => $item->total_harga,
						"created_at"   => $this->currentTime
					];
					$actions = $this->db->insert("faktur_items", $setItem);
					if(!$actions){
						throw new \Exception("Terjadi kesalahan dalam menyimpan data");
					}

					$total_barang += $item->total_barang;
					$total_harga  += $item->total_harga;
				}

				$action = $this->db->where("id", $id)->update("faktur", [
					"total_items" => $total_barang,
					"total_harga" => $total_harga,
				]);
				if(!$action){
					throw new \Exception("Terjadi kesalahan dalam menyimpan data");
				}

				$data['result'] = true;
				$data['msg'] = "Data telah berhasil disimpan";
				$this->db->trans_commit();
            } catch (\Throwable $th) {
				$this->db->trans_rollback();
                $data['result'] = false;
                $data['msg'] = $th->getMessage();
            }
                
            echo json_encode($data);
        }

		public function updateFaktur(){
			try {
				$id  = $this->input->post("id");
				if(!$this->model_faktur->checkData($id)){
					throw new \Exception("Faktur tidak diketahui");
				}

				$set = [
					"nama_pelanggan" => $this->input->post("nama_pelanggan"),
					"total_items"    => 0,
					"total_harga"    => 0
				];

				$this->db->trans_begin();
				
				$set["updated_at"] = $this->currentTime;
				$doActions         = $this->db->where("id", $id)->update("faktur", $set);

				if(!$doActions){
					throw new \Exception("Terjadi kesalahan dalam menyimpan data");
				}
				
				//Count Data
				$items        = json_decode($this->input->post("items"));
				$total_barang = 0;
				$total_harga  = 0;

				foreach($items as $key => $item){
					//Jika item dihapus
					if(isset($item->deleted) && @$item->deleted){
						$removeItem = $this->db->delete("faktur_items", [
							"id_faktur" => $id,
							"id_barang" => $item->id_barang
						]);

						if(!$removeItem){
							throw new \Exception("Terjadi kesalahan dalam menyimpan data");
						}

						//Skip action untuk item yang telah dihapus
						continue;
					}

					$setItem = [
						"nama_barang"  => $item->nama_barang,
						"total_barang" => $item->total_barang,
						"total_harga"  => $item->total_harga,
					];

					//Check jika ada maka diupdate
					if($this->model_faktur->checkChildData($id, $item->id_barang)){
						$setItem["updated_at"] = $this->currentTime;
						$actions = $this->db->where("id_faktur", $id)
							->where("id_barang", $item->id_barang)
							->update("faktur_items", $setItem);
					}
					else{
						$setItem["id_faktur"]   = $id;
						$setItem["id_barang"]   = $item->id_barang;
						$setItem["created_at"]  = $this->currentTime;
						$actions = $this->db->insert("faktur_items", $setItem);
					}

					if(!$actions){
						throw new \Exception("Terjadi kesalahan dalam menyimpan data");
					}

					$total_barang += $item->total_barang;
					$total_harga  += $item->total_harga;
					$newItems[]   =  $item->id_barang;
				}

				$action = $this->db->where("id", $id)->update("faktur", [
					"total_items" => $total_barang,
					"total_harga" => $total_harga,
				]);
				if(!$action){
					throw new \Exception("Terjadi kesalahan dalam menyimpan data");
				}

				$data['result'] = true;
				$data['msg'] = "Data telah berhasil disimpan";
				$this->db->trans_commit();
            } catch (\Throwable $th) {
				$this->db->trans_rollback();
                $data['result'] = false;
                $data['msg'] = $th->getMessage();
            }
                
            echo json_encode($data);
		}

        public function deleteFaktur($id){
			try {
				if(!$this->model_faktur->checkData($id)){
					throw new \Exception("Faktur tidak diketahui");
				}
				$this->db->trans_begin();
				$delete = $this->db->delete("faktur", ["id" => $id]);

				if(!$delete){
					throw new \Exception("Terjadi kesalahan dalam menghapus faktur");
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
