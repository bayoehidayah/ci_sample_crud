<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Model_aktivitas extends CI_Model{

        function getNkpPegawai($kdepeg, $pir){
            $dataPegawai = $this->model_remun->getPegawaiRem($kdepeg);
            $totalPoinAktivitas = $this->model_transaksi->getTotalPoinAktivitas($kdepeg);
            if($dataPegawai['kdejnspeg'] == "DB"){ 
                $kdeklsjb = $dataPegawai['kdeklsjabf']; 
            }
            else if($dataPegawai['kdejnspeg'] == "DT" && $totalPoinAktivitas > 40){ 
                $kdeklsjb = $dataPegawai['kdeklsjabf']; 
            }
            else{ 
                $kdeklsjb = $dataPegawai['kdeklsjab']; 
            }

            $dataKlsJab = $this->model_transaksi->getKlsJab($kdeklsjb);
            $koefisien = $dataKlsJab['koefisien'];
            $hargaJabatan = $dataKlsJab['nilaijabatan'];
            return $hargaJabatan*$koefisien*$pir;
        }

        function getRekapitulasiPeg($kdepeg, $periode){
            //Data Periode
            $dataPeriode = $this->db->get_where("tr_periode", ["periode" => $periode])->row_array();
            $pir = $dataPeriode['pir'];

            //Get UDI Penghargaan
            $dataPenghargaan = $this->penghargaan_aktivitas($kdepeg, $periode);
            $arrPenghargaan = array();
            foreach($dataPenghargaan as $row){
                $arrPenghargaan[] = $row->udi;
            }

            //Get Total Poin Except Penghargaan
            $dataAktivitas = $this->getAktivitasNotPenghargaan($kdepeg, $arrPenghargaan);
            $totalPoin = 0;
            foreach($dataAktivitas as $row){
                $totalPoin += $row->poinaktivitas;
            }   

            //Data Pegawai
            $dataPegawai = $this->model_remun->getPegawaiRem($kdepeg);
            $kdejnspeg = $dataPegawai['kdejnspeg'];
            $kdeklsjab = $dataPegawai['kdeklsjab'];
            $kdeklsjabf = $dataPegawai['kdeklsjabf'];
            $totalPoin = 85;
            //Calculate Poin
            if($kdejnspeg == "DT"){
                if($totalPoin <= 40){
                    $poin = $totalPoin;
                    $sisa_poin = 0;
                }
                else{
                    $poin = 40;
                    $sisa_poin = $totalPoin - 40;
                    if($sisa_poin > 56){
                        $sisa_poin = 56;
                    }
                }
            }
            else if($kdejnspeg == "DB"){
                if($totalPoin <= 68){
                    $poin = $totalPoin;
                }
                else{
                    $poin = 68;
                }
            }
            else if($kdejnspeg == "PJFT" || $kdejnspeg == "PJFU" || $kdejnspeg == "PST"){
                if($totalPoin <= 54){
                    $poin = $totalPoin;
                }
                else{
                    $poin = 54;
                }
            }
            else{
                $poin = 0;
            }

            if($poin >= 12){
                $poin = $poin - 12;
            }

            //Poin Penghargaan
            $dataPenghargaan = $this->penghargaan_aktivitas($kdepeg, $periode);
            $totalPoinPenghargaan = 0;
            foreach($dataPenghargaan as $row){
                $totalPoinPenghargaan += $row->poinaktivitas;
            }

            //Calculate Rekap
            if($kdejnspeg == "DT"){
                //Rekapitulasi
                $remunDt = $poin * $this->calKdeKlsJab($kdeklsjab, $pir);
                $remunDb = $sisa_poin * $this->calKdeKlsJab($kdeklsjabf, $pir);
                $remunPeg = 0;
                $total_remun = $remunDt + $remunDb;
                $nilai_maksimal = $this->getRemMaxPeg($kdeklsjab);

                //Gaji Remun
                // $gaji_remun = $remunDt * 30 / 100;
                $gaji_remun = 12 * $this->calKdeKlsJab($kdeklsjab, $pir);
                $nilai = $gaji_remun / 6;

                //Insentif
                $insentifDt = $remunDt * 70 / 100;
                $insentifDb = $remunDb;
                $insentifPeg = 0;
                $remunPenghargaan = $totalPoinPenghargaan * $this->calKdeKlsJab($kdeklsjabf, $pir);
                $remunDibayar = $insentifDt + $insentifDb + $remunPenghargaan;
                if($remunDibayar > $nilai_maksimal){
                    $remunDibayar = $nilai_maksimal;
                }
            }
            else if($kdejnspeg == "DB"){
                //Rekapitulasi
                $remunDt = 0;
                $remunDb = $poin * $this->calKdeKlsJab($kdeklsjabf, $pir);
                $remunPeg = 0;
                $total_remun = 0;
                $nilai_maksimal = $this->getRemMaxPeg($kdeklsjabf);

                //Gaji Remun
                // $gaji_remun = $remunDb * 30 / 100;
                $gaji_remun = 12 * $this->calKdeKlsJab($kdeklsjabf, $pir);
                $nilai = $gaji_remun / 6;

                //Insentif
                $insentifDt = 0;
                $insentifDb = $remunDb * 70 / 100;
                $insentifPeg = 0;
                $remunPenghargaan = $totalPoinPenghargaan * $this->calKdeKlsJab($kdeklsjabf, $pir);
                $remunDibayar = $insentifDb + $remunPenghargaan;
                if($remunDibayar > $nilai_maksimal){
                    $remunDibayar = $nilai_maksimal;
                }
            }
            else if($kdejnspeg == "PJFT" || $kdejnspeg == "PJFU" || $kdejnspeg == "PST"){
                //Rekapitulasi
                $remunDt = 0;
                $remunDb = 0;
                $remunPeg = $poin * $this->calKdeKlsJab($kdeklsjab, $pir);
                $total_remun = 0;
                $nilai_maksimal = $this->getRemMaxPeg($kdeklsjab);

                //Gaji Remun
                // $gaji_remun = $remunPeg * 30 / 100;
                $gaji_remun = 12 * $this->calKdeKlsJab($kdeklsjab, $pir);
                $nilai = $gaji_remun / 6;

                //Insentif
                $insentifDt = 0;
                $insentifDb = 0;
                $insentifPeg = $remunPeg * 70 / 100;
                $remunPenghargaan = $totalPoinPenghargaan * $this->calKdeKlsJab($kdeklsjab, $pir);
                $remunDibayar = $insentifPeg + $remunPenghargaan;
                if($remunDibayar > $nilai_maksimal){
                    $remunDibayar = $nilai_maksimal;
                }
            }

            return [
                "kdejnspeg" => $kdejnspeg,
                "total_poin" => $totalPoin,
                "poin" => $poin,
                "sisa_poin" => $sisa_poin,
                "poin_penghargaan" => $totalPoinPenghargaan,
                "remun_dt" => $remunDt,
                "remun_db" => $remunDb,
                "remun_peg" => $remunPeg,
                "total_remun" => $total_remun,
                "nilai_maksimal" => $nilai_maksimal,
                "gaji_remun" => $gaji_remun,
                "nilai" => $nilai,
                "insentif_dt" => $insentifDt,
                "insentif_db" => $insentifDb,
                "insentif_peg" => $insentifPeg,
                "remun_penghargaan" => $remunPenghargaan,
                "remun_dibayar" => $remunDibayar
            ];
        }

        private function getAktivitasNotPenghargaan($kdepeg, $dataPenghargaan){
            if(sizeof($dataPenghargaan) > 0){
                return $this->db
                ->where("kdepeg='$kdepeg' AND (appvukerja1='1' OR appvukerja2='1')")
                ->where_not_in("udi", $dataPenghargaan)
                ->get("tr_aktivitas")
                ->result();

            }
            else{
                return $this->db
                ->where("kdepeg='$kdepeg' AND (appvukerja1='1' OR appvukerja2='1')")
                ->get("tr_aktivitas")->result();
            }
        }

        private function getRemMaxPeg($kdeklsjab){
            $dataKelasJab = $this->db->get_where("tbklsjabcount", ["kdeklsjab" => $kdeklsjab])->row_array();
            return $dataKelasJab['remmaxpthn'] / 2;
        }

        private function calKdeKlsJab($kdeklsjab, $pir){
            $dataKlsJab = $this->model_transaksi->getKlsJab($kdeklsjab);
            $koefisien = $dataKlsJab['koefisien'];
            $hargaJabatan = $dataKlsJab['nilaijabatan'];
            $harga = (int) ($hargaJabatan*$koefisien);
            // return ($hargaJabatan*$koefisien*$pir*6)/40;
            return ($harga*$pir*6)/40;
        }

        function tusi_aktivitas($kdepeg, $periode){
            return $this->db
            ->select("tr10_tusi.periode, tr10_tusi.hargaaktivitas, tr10_tusi.kdepeg, tr10_tusi.bulan, tr10_tusi.capaian,tr10_tusi.poinaktivitas, tr_aktivitas.udi, tbperan.nmaperan, tr_dokumen.nomskdokumen, tr_dokumen.judul")
            ->join("tr_aktivitas", "tr_aktivitas.udi=tr10_tusi.udi AND tr_aktivitas.periode=tr10_tusi.periode AND (tr_aktivitas.appvukerja1='1' OR tr_aktivitas.appvukerja2='1')")
            ->join("tbperan", "tbperan.kdeperan=tr_aktivitas.kdeperan")
            ->join("tr_dokumen", "tr_dokumen.udi=tr_aktivitas.udi_trdokumen")
            ->group_by("tr_aktivitas.udi")
            ->get_where("tr10_tusi", [
                "tr10_tusi.periode" => $periode, 
                "tr10_tusi.kdepeg" => $kdepeg
            ])->result();
        }
        
        function pendikajar_aktivitas($kdepeg, $periode){
            return $this->db
            ->select("tr21_pendikajar.periode, tr21_pendikajar.hargaaktivitas, tr21_pendikajar.kdepeg, tr21_pendikajar.poinaktivitas, tr21_pendikajar.jlhmhs, tr_aktivitas.udi, tbperan.nmaperan, tr_dokumen.nomskdokumen, tr_dokumen.judul, tbmtnkul.nmamtnkul")
            ->join("tr_aktivitas", "tr_aktivitas.udi=tr21_pendikajar.udi AND tr_aktivitas.periode=tr21_pendikajar.periode AND (tr_aktivitas.appvukerja1='1' OR tr_aktivitas.appvukerja2='1')")
            ->join("tr_dokumen", "tr_dokumen.udi=tr_aktivitas.udi_trdokumen")
            ->join("tbperan", "tbperan.kdeperan=tr_aktivitas.kdeperan")
            ->join("tbmtnkul", "tbmtnkul.kdemtnkul=tr21_pendikajar.kdemtnkul")
            ->group_by("tr_aktivitas.udi")
            ->get_where("tr21_pendikajar", [
                "tr21_pendikajar.periode" => $periode, 
                "tr21_pendikajar.kdepeg" => $kdepeg
            ])->result();
        }

        function pendikinst_aktivitas($kdepeg, $periode){
            return $this->db
            ->select("tr22_pendikinst.periode, tr22_pendikinst.hargaaktivitas, tr22_pendikinst.kdepeg, tr22_pendikinst.poinaktivitas, tr22_pendikinst.jlhmhs, tr_aktivitas.udi, tbperan.nmaperan, tr_dokumen.nomskdokumen, tr_dokumen.judul")
            ->join("tr_aktivitas", "tr_aktivitas.udi=tr22_pendikinst.udi AND tr_aktivitas.periode=tr22_pendikinst.periode AND (tr_aktivitas.appvukerja1='1' OR tr_aktivitas.appvukerja2='1')")
            ->join("tr_dokumen", "tr_dokumen.udi=tr_aktivitas.udi_trdokumen")
            ->join("tbperan", "tbperan.kdeperan=tr_aktivitas.kdeperan")
            ->group_by("tr_aktivitas.udi")
            ->get_where("tr22_pendikinst", [
                "tr22_pendikinst.periode" => $periode, 
                "tr22_pendikinst.kdepeg" => $kdepeg
            ])->result();
        }

        function penlit_aktivitas($kdepeg, $periode){
            return $this->db
            ->select("tr31_penlit.periode, tr31_penlit.hargaaktivitas, tr31_penlit.kdepeg, tr31_penlit.poinaktivitas, tr_aktivitas.udi, tbperan.nmaperan, tr_dokumen.nomskdokumen, tr_dokumen.judul, tbperan.nmaperan")
            ->join("tr_aktivitas", "tr_aktivitas.udi=tr31_penlit.udi AND tr_aktivitas.periode=tr31_penlit.periode AND (tr_aktivitas.appvukerja1='1' OR tr_aktivitas.appvukerja2='1')")
            ->join("tr_dokumen", "tr_dokumen.udi=tr_aktivitas.udi_trdokumen")
            ->join("tbperan", "tbperan.kdeperan=tr_aktivitas.kdeperan")
            ->group_by("tr_aktivitas.udi")
            ->get_where("tr31_penlit", [
                "tr31_penlit.periode" => $periode, 
                "tr31_penlit.kdepeg" => $kdepeg
            ])->result();
        }

        function pengabdian_aktivitas($kdepeg, $periode){
            return $this->db
            ->select("tr32_pengabdian.periode, tr32_pengabdian.hargaaktivitas, tr32_pengabdian.kdepeg, tr32_pengabdian.poinaktivitas, tr_aktivitas.udi, tbperan.nmaperan, tr_dokumen.nomskdokumen, tr_dokumen.judul, tbperan.nmaperan")
            ->join("tr_aktivitas", "tr_aktivitas.udi=tr32_pengabdian.udi AND tr_aktivitas.periode=tr32_pengabdian.periode AND (tr_aktivitas.appvukerja1='1' OR tr_aktivitas.appvukerja2='1')")
            ->join("tr_dokumen", "tr_dokumen.udi=tr_aktivitas.udi_trdokumen")
            ->join("tbperan", "tbperan.kdeperan=tr_aktivitas.kdeperan")
            ->group_by("tr_aktivitas.udi")
            ->get_where("tr32_pengabdian", [
                "tr32_pengabdian.periode" => $periode, 
                "tr32_pengabdian.kdepeg" => $kdepeg
            ])->result();
        }

        function penghargaan_aktivitas($kdepeg, $periode){
            return $this->db
            ->select("tr40_penghargaan.periode, tr40_penghargaan.hargaaktivitas, tr40_penghargaan.kdepeg, tr40_penghargaan.poinaktivitas, tr_aktivitas.udi, tbperan.nmaperan, tr_dokumen.nomskdokumen, tr_dokumen.judul, tbperan.nmaperan")
            ->join("tr_aktivitas", "tr_aktivitas.udi=tr40_penghargaan.udi AND tr_aktivitas.periode=tr40_penghargaan.periode AND (tr_aktivitas.appvukerja1='1' OR tr_aktivitas.appvukerja2='1')")
            ->join("tr_dokumen", "tr_dokumen.udi=tr_aktivitas.udi_trdokumen")
            ->join("tbperan", "tbperan.kdeperan=tr_aktivitas.kdeperan")
            ->group_by("tr_aktivitas.udi")
            ->get_where("tr40_penghargaan", [
                "tr40_penghargaan.periode" => $periode, 
                "tr40_penghargaan.kdepeg" => $kdepeg
            ])->result();
        }

        function penunjang_aktivitas($kdepeg, $periode){
            return $this->db
            ->select("tr50_penunjang.periode, tr50_penunjang.hargaaktivitas, tr50_penunjang.kdepeg, tr50_penunjang.poinaktivitas, tr_aktivitas.udi, tbperan.nmaperan, tr_dokumen.nomskdokumen, tr_dokumen.judul, tbperan.nmaperan")
            ->join("tr_aktivitas", "tr_aktivitas.udi=tr50_penunjang.udi AND tr_aktivitas.periode=tr50_penunjang.periode AND (tr_aktivitas.appvukerja1='1' OR tr_aktivitas.appvukerja2='1')")
            ->join("tr_dokumen", "tr_dokumen.udi=tr_aktivitas.udi_trdokumen")
            ->join("tbperan", "tbperan.kdeperan=tr_aktivitas.kdeperan")
            ->group_by("tr_aktivitas.udi")
            ->get_where("tr50_penunjang", [
                "tr50_penunjang.periode" => $periode, 
                "tr50_penunjang.kdepeg" => $kdepeg
            ])->result();
        }
    }
?>