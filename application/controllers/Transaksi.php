<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Transaksi extends CI_Controller{

        private $currentTime;
        private $kdepeg;
        private $akses;

        function __construct(){
            parent::__construct();
            check_session();
            date_default_timezone_set("Asia/Jakarta");
            $this->currentTime = date("Y-m-d H:i:s");
            $this->kdepeg = $this->session->userdata("kdepeg");
            $this->akses = $this->session->userdata("tipe");
        }

        function generateNewId(){
            try {
                $data = $this->model_transaksi->generateNewID();
                echo json_encode([
                    "result" => true,
                    "msg"    => "Berhasil memuat ulang kode faktur",
                    "data"   => $data
                ]);
            } catch (\Throwable $th) {
                echo json_encode([
                    "result" => false,
                    "msg" => $th->getMessage()
                ]);
            }
        }

        //Transaksi ------------------------------------------------------------------
        function showAll(){
            $data['page_title']   = "Transaksi";
            $data['topbar_title'] = "Transaksi";
            $data['bread']        = [
                [true, "Transaksi", "javascript:void(0);"]
            ];

            $data["barang"]      = $this->db->get("barang")->result();
            $data["users"]        = $this->db->get("users")->result();
            $data["faktur_code"] = $this->model_transaksi->generateNewID();

            $data["count_transaksi"] = $this->db->count_all("transaksi");
            $data['js'] = APPPATH."views/transaksi/list/list_js.php";
            $this->themes->primary("transaksi/list/list", $data);
        }

        function getDataTransaksi(){
            $search = $_POST['search']['value'];
            $limit = $_POST['length'];
            $start = $_POST['start'];
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];

            $sql_total = $this->model_transaksi->countAllTransaksi();
            $sql_data = $this->model_transaksi->transaksiFilter($search, $limit, $start, $order_field, $order_ascdesc);
            $sql_filter = $this->model_transaksi->countFilterTransaksi($search);

            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );
            header('Content-Type: application/json');
            echo json_encode($callback, JSON_PRETTY_PRINT);
        }

        function saveTransaksi(){
            try {
                $faktur = $this->input->post("id");
                if($this->model_transaksi->isUsed($faktur) && $this->input->post("edit") == "false"){
                    $faktur = $this->model_transaksi->generateNewId();
                }

                $id_barang = $this->input->post("id_barang");
                if(!$this->model_barang->checkData(["id" => $id_barang])){
                    throw new \Exception("Barang tidak diketahui");
                }
                $tanggal    = $this->input->post("tanggal");
                $dataBarang = $this->model_barang->getData($id_barang);
                $hargaJual  = $dataBarang->harga_jual;

                // $last_stok = $this->model_barang->getStockBasedOnDate($tanggal, $id_barang);

                $jumlah    = $this->input->post("jumlah");
                $totalJual = $hargaJual * $jumlah;

                $set = [
                    "id_barang"  => $id_barang,
                    "tanggal"    => $tanggal,
                    "jumlah"     => $jumlah,
                    "harga_jual" => $hargaJual,
                    "total_jual" => $totalJual,
                    "updated_at" => $this->currentTime,
                ];

                $user = $this->input->post("id_users");
                if($user == "non-registered-user"){
                    $set["id_user"]   = null;
                    $set["nama_user"] = $this->input->post("nama_user");
                }else{
                    if($this->model_users->checkData(["id" => $user])){
                        $dataUser         = $this->model_users->getData($user);
                        $set["id_user"]   = $user;
                        $set["nama_user"] = $dataUser->nama;
                    }
                }

                if($this->input->post("edit") == "false"){
                    $set["id"]         = $faktur;
                    $set["created_at"] = $this->currentTime;
                    $save = $this->db->insert("transaksi", $set);
                }
                else{
                    $save = $this->db->update("transaksi", $set, ["id" => $faktur]);
                    // throw new \Exception("Terjadi kesalahan dalam menyimpan data");
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

        function showTransaksi($id_transaksi){
            try {
                if(!$this->model_transaksi->isUsed($id_transaksi)){
                    throw new \Exception("Transaksi tidak ditemukan");
                }

                $data = $this->db->select("transaksi.id, barang.nama, transaksi.id_barang, transaksi.tanggal, transaksi.jumlah, transaksi.harga_jual, transaksi.total_jual, transaksi.id_user, transaksi.nama_user, transaksi.created_at, transaksi.updated_at")
                    ->join("barang", "barang.id=transaksi.id_barang")
                    ->get_where("transaksi", ["transaksi.id" => $id_transaksi])
                    ->row_array();

                $data = [
                    "result" => true,
                    "msg"    => "Berhasil mengambil data",
                    "data"   => $data
                ];

            } catch (\Throwable $th) {
                $data = [
                    "result" => false,
                    "msg"    => $th->getMessage()
                ];
            }

            echo json_encode($data);
        }

        function deleteTransaksi($id){
            try {
                if(!$this->model_transaksi->isUsed($id)){
                    throw new \Exception("Transaksi tidak diketahui");
                }

                $this->db->delete("transaksi", ["id" => $id]);
                $data['result'] = true;
            } catch (\Throwable $th) {
                $data = [
                    "result" => false,
                    "msg"    => $th->getMessage()
                ];
            }

            echo json_encode($data);
        }
        //End --------------------------------------------------------------

        function laporanKoperasiShowAll(){
            $data['page_title']   = "Laporan Penjualan Koperasi";
            $data['topbar_title'] = "Laporan Penjualan Koperasi";
            $data['bread']        = [
                [false, "Laporan", "javascript:void(0);"],
                [false, "Penjualan", "javascript:void(0);"],
                [true, "Koperasi", "javascript:void(0);"]
            ];

            $data['js'] = APPPATH."views/reports/penjualan/koperasi_js.php";
            $this->themes->primary("reports/penjualan/koperasi", $data);
        }

        function laporanKoperasiProcessData(){
            $tanggal = $this->input->post_get("tanggal");
            try {
                $items   = $this->db->select("id, nama, harga_modal, harga_jual")
                    ->get("barang")
                    ->result();

                $results = [
                    "tanggal" => $tanggal,
                    "transaksi"    => []
                ];
                
                $total_modals     = 0;
                $total_penjualans = 0;
                foreach($items as $item){
                    $idBarang      = $item->id;
                    $stok          = $this->model_barang->getStockBasedOnDate($tanggal, $idBarang, true);
                    $incoming_stok = $this->model_barang->getIncomingStock($tanggal, $idBarang);
                    $sold_stok     = $this->model_barang->getSoldStock($tanggal, $idBarang);
                    $last_stok     = $this->model_barang->getStockBasedOnDate($tanggal, $idBarang);

                    $total_modal     = $sold_stok * $item->harga_modal;
                    $total_penjualan = $sold_stok * $item->harga_jual;

                    $total_modals     += $total_modal;
                    $total_penjualans += $total_penjualan;

                    $item->harga_modal = "Rp ".number_format($item->harga_modal,0,",",".");
                    $item->harga_jual  = "Rp ".number_format($item->harga_jual,0,",",".");

                    array_push($results["transaksi"], [
                        "info_barang"     => $item,
                        "stok"            => $stok,
                        "incoming_stok"   => $incoming_stok,
                        "sold_stok"       => $sold_stok,
                        "last_stok"       => $last_stok,
                        "total_modal"     => "Rp ".number_format($total_modal,0,",","."),
                        "total_penjualan" => "Rp ".number_format($total_penjualan,0,",",".")
                    ]);
                }
                $results["total_modal"]     = "Rp ".number_format($total_modals,0,",",".");
                $results["total_penjualan"] = "Rp ".number_format($total_penjualan,0,",",".");
                $results["keuntungan"]      = "Rp ".number_format($total_penjualan - $total_modals,0,",",".");

                $returns = [
                    "result" => true,
                    "msg"    => "Berhasil menghitung laporan",
                    "data"   => $results
                ];
            } catch (\Throwable $th) {
                $returns = [
                    "result" => false,
                    "msg" => "Gagal menghitung laporan"
                ];
            }

            echo json_encode($returns);
        }

        function laporanByFakturShowAll(){
            $data['page_title']   = "Laporan Penjualan By Faktur";
            $data['topbar_title'] = "Laporan Penjualan By Faktur";
            $data['bread']        = [
                [false, "Laporan", "javascript:void(0);"],
                [false, "Penjualan", "javascript:void(0);"],
                [true, "By Faktur", "javascript:void(0);"]
            ];

            $data['js'] = APPPATH."views/reports/penjualan/by-faktur_js.php";
            $this->themes->primary("reports/penjualan/by-faktur", $data);
        }

        function laporanByFakturProcessData(){
            $tanggal = $this->input->post_get("tanggal");
            try {
                $items   = $this->db->get_where("transaksi", [
                        "tanggal" => $tanggal
                    ])
                    ->result();

                $results = [
                    "tanggal"   => $tanggal,
                    "transaksi" => $items
                ];

                $i = 1;
                $total_penjualans = 0;
                foreach($items as $item){
                    $item->no = $i;
                    $info_barang = $this->db->select("id, nama, harga_modal, harga_jual")->get_where("barang", ["id" => $item->id_barang])->first_row();

                    
                    if($info_barang){
                        $item->barang = $info_barang->id." | ".$info_barang->nama;
                    }
                    
                    $total_penjualans += $item->total_jual;
                    $item->total_jual = "Rp ".number_format($item->total_jual,0,",",".");
                    $item->harga_jual  = "Rp ".number_format($item->harga_jual,0,",",".");
                    $i++;
                }
                
                $results["total_penjualan"] = "Rp ".number_format($total_penjualans,0,",",".");

                $returns = [
                    "result" => true,
                    "msg"    => "Berhasil menghitung laporan",
                    "data"   => $results
                ];
            } catch (\Throwable $th) {
                $returns = [
                    "result" => false,
                    "msg" => $th->getMessage()
                ];
            }

            echo json_encode($returns);
        }

        function laporanBagiHasilShowAll(){
            $data['page_title']   = "Laporan Bagi Hasil";
            $data['topbar_title'] = "Laporan Bagi Hasil";
            $data['bread']        = [
                [false, "Laporan", "javascript:void(0);"],
                [true, "Bagi Hasil", "javascript:void(0);"]
            ];

            $data['js'] = APPPATH."views/reports/bagi-hasil_js.php";
            $this->themes->primary("reports/bagi-hasil", $data);
        }

        function laporanBagiHasilProcessData(){

        }
    }
?>
