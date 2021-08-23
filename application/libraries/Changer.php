<?php
    if(!defined('BASEPATH')) exit('no file allowed');

    class Changer{
        protected $_ci;

        function __construct(){
            $this->_ci =& get_instance();
        }

        function currency($number, $mataUang = '', $separate = 0){
            $result = '';

            if($mataUang != ''){
                $result .= $mataUang." ";
            }

            $result .= number_format($number,$separate,',','.');

            return $result;
        }

        function date($date, $changeTo){
            $convertDate = strtotime($date);
            return date($changeTo, $convertDate);
        }

        function monthToNum($month){
            switch($month){
                case "Januari" : $bulan = 1;
                    break;
                case "Februari" : $bulan = 2;
                    break;
                case "Maret" : $bulan = 3;
                    break;
                case "April" : $bulan = 4;
                    break;
                case "Mei" : $bulan = 5;
                    break;
                case "Juni" : $bulan = 6;
                    break;
                case "Juli" : $bulan = 7;
                    break;
                case "Agustus" : $bulan = 8;
                    break;
                case "September" : $bulan = 9;
                    break;
                case "Oktober" : $bulan = 10;
                    break;
                case "November" : $bulan = 11;
                    break;
                case "Desember" : $bulan = 12;
                    break;
                default : $bulan = 0;
            }

            return $bulan;
        }

        function numToMonth($num){
            switch($num){
			    case 1 : $bulan="Januari";
			        break;
			    case 2 : $bulan="Februari";
			        break;
			    case 3 : $bulan="Maret";
			        break;
			    case 4 : $bulan="April";
			        break;
			    case 5 : $bulan="Mei";
			        break;
			    case 6 : $bulan="Juni";
			        break;
			    case 7 : $bulan="Juli";
			        break;
			    case 8 : $bulan="Agustus";
			        break;
			    case 9 : $bulan="September";
			        break;
			    case 10 : $bulan="Oktober";
			        break;
			    case 11 : $bulan="November";
			        break;
			    case 12 : $bulan="Desember";
			        break;
			    default : $bulan = "";
            }

            return $bulan;
        }

        function day($dateSet){
          $dayDate = date('D', strtotime($dateSet));
          $fullDayList = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu'
          );

          return $fullDayList[$dayDate];
        }

        function month($dateSet, $day=false, $date=false, $month=false, $year=false, $space=false){
            $result = '';
            $dayDate = date('D', strtotime($dateSet));
			$fullDayList = array(
				'Sun' => 'Minggu',
				'Mon' => 'Senin',
				'Tue' => 'Selasa',
				'Wed' => 'Rabu',
				'Thu' => 'Kamis',
				'Fri' => 'Jumat',
				'Sat' => 'Sabtu'
			);

            $hari = $fullDayList[$dayDate];


			$tgl = date("d", strtotime($dateSet));
			$bulan = date("m", strtotime($dateSet));
			$tahun = date("Y", strtotime($dateSet));
			switch($bulan){
			    case 1 : $bulan="Januari";
			        break;
			    case 2 : $bulan="Februari";
			        break;
			    case 3 : $bulan="Maret";
			        break;
			    case 4 : $bulan="April";
			        break;
			    case 5 : $bulan="Mei";
			        break;
			    case 6 : $bulan="Juni";
			        break;
			    case 7 : $bulan="Juli";
			        break;
			    case 8 : $bulan="Agustus";
			        break;
			    case 9 : $bulan="September";
			        break;
			    case 10 : $bulan="Oktober";
			        break;
			    case 11 : $bulan="November";
			        break;
			    case 12 : $bulan="Desember";
			        break;
			    default : $bulan = "";
			}

            if($day){
                $result .= $hari.",";
                if($space){$result .= " ";}
            }

            if($date){
                $result .= $tgl;
                if($space){$result .= " ";}
            }

            if($month){
                $result .= $bulan;
                if($space){$result .= " ";}
            }

            if($year){
                $result .= $tahun;
            }

			// $data = $hari.", ".$tgl." ".$bulan." ".$tahun;
			return $result;
        }

        function terbilang($nilai) {
            $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
            if($nilai == 0){
                return "Rupiah";
            }
            else if ($nilai < 12) {
                return "" . $huruf[$nilai];
            } elseif ($nilai < 20) {
                return $this->terbilang($nilai - 10) . " Belas ";
            } elseif ($nilai < 100) {
                return $this->terbilang($nilai / 10) . " Puluh " . $this->terbilang($nilai % 10);
            } elseif ($nilai < 200) {
                return " Seratus " . $this->terbilang($nilai - 100);
            } elseif ($nilai < 1000) {
                return $this->terbilang($nilai / 100) . " Ratus " . $this->terbilang($nilai % 100);
            } elseif ($nilai < 2000) {
                return " Seribu " . terbilang($nilai - 1000);
            } elseif ($nilai < 1000000) {
                return $this->terbilang($nilai / 1000) . " Ribu " . $this->terbilang($nilai % 1000);
            } elseif ($nilai < 1000000000) {
                return $this->terbilang($nilai / 1000000) . " Juta " . $this->terbilang($nilai % 1000000);
            }elseif ($nilai < 1000000000000) {
                return $this->terbilang($nilai / 1000000000) . " Milyar " . $this->terbilang($nilai % 1000000000);
            }elseif ($nilai < 100000000000000) {
                return $this->terbilang($nilai / 1000000000000) . " Trilyun " . $this->terbilang($nilai % 1000000000000);
            }elseif ($nilai <= 100000000000000) {
                return "Maaf Tidak Dapat di Prose Karena Jumlah nilai Terlalu Besar ";
            }
        }
    }
?>
