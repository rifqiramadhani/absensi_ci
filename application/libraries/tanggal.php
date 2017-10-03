<?php

/** libraries/tanggal.php
 * @author soniibrol
 * @copyright 2013
 */

class Tanggal{
	function tanggal_indo($tanggal){
		$hari = substr($tanggal,8,2);
		$bulan = substr($tanggal,5,2);
		$tahun = substr($tanggal,0,4);
		$tgl = $hari."/".$bulan."/".$tahun;
		return $tgl;
	}

	function get_only_date($tanggal){
		$hari = substr($tanggal,8,2);
		$bulan = substr($tanggal,5,2);
		$tahun = substr($tanggal,0,4);
		return $hari;	
	}

	function get_only_month($tanggal){
		$hari = substr($tanggal,8,2);
		$bulan = substr($tanggal,5,2);
		$tahun = substr($tanggal,0,4);
		return $bulan;
	}

	function get_only_year($tanggal){
		$hari = substr($tanggal,8,2);
		$bulan = substr($tanggal,5,2);
		$tahun = substr($tanggal,0,4);
		return $tahun;
	}

	function tanggal_indo_monthtext($tanggal){
		$hari = substr($tanggal,8,2);
		$bulan = substr($tanggal,5,2);
		$tahun = substr($tanggal,0,4);
		
		$bulantext = $this->get_bulan(intval($bulan));

		$tgl = $hari." ".$bulantext." ".$tahun;
		return $tgl;	
	}

	function get_selisih($tanggal1,$tanggal2){
		$date1 = new DateTime($tanggal1);
		$date2 = new DateTime($tanggal2);
		$diff = $date1->diff($date2);

		return $diff->days;
	}
	
	function tanggal_jam_indo($tanggal){
		$hari = substr($tanggal,8,2);
		$bulan = substr($tanggal,5,2);
		$tahun = substr($tanggal,0,4);
		$tgl = $hari."/".$bulan."/".$tahun;
		$jam = substr($tanggal,11,8);
		return $tgl." ".$jam;
	}

	function get_jam($tanggaljam){
		$temp = explode(" ", $tanggaljam);
		$tgl = $temp[0];
		$jam = $temp[0];

		return $jam;
	}
	
	function tanggal_simpan_db($tanggal){
		$hari = substr($tanggal,0,2);
		$bulan = substr($tanggal,3,2);
		$tahun = substr($tanggal,6,4);
		$tgl = $tahun."-".$bulan."-".$hari;
		return $tgl;
	}

	function get_hari($tanggal){
		$dt = strtotime($tanggal);
		$day = date('D',$dt);

		switch ($day) {
			case 'Sun':
				$hari = 'Minggu';
				break;
			case 'Mon':
				$hari = 'Senin';
				break;
			case 'Tue':
				$hari = 'Selasa';
				break;
			case 'Wed':
				$hari = 'Rabu';
				break;
			case 'Thu':
				$hari = 'Kamis';
				break;
			case 'Fri':
				$hari = 'Jum\'at';
				break;
			case 'Sat':
				$hari = 'Sabtu';
				break;
			default:
				# code...
				$hari = 'Tidak terdefinisi';
				break;
		}

		return $hari;
	}

	function get_bulan($bulan){
		switch ($bulan) {
            case '1':
                $nama_bulan = 'JANUARI';
                break;
            case '2':
                $nama_bulan = 'FEBRUARI';
                break;
            case '3':
                $nama_bulan = 'MARET';
                break;
            case '4':
                $nama_bulan = 'APRIL';
                break;
            case '5':
                $nama_bulan = 'MEI';
                break;
            case '6':
                $nama_bulan = 'JUNI';
                break;
            case '7':
                $nama_bulan = 'JULI';
                break;
            case '8':
                $nama_bulan = 'AGUSTUS';
                break;
            case '9':
                $nama_bulan = 'SEPTEMBER';
                break;
            case '10':
                $nama_bulan = 'OKTOBER';
                break;
            case '11':
                $nama_bulan = 'NOVEMBER';
                break;
            case '12':
                $nama_bulan = 'DESEMBER';
                break;
            default:
                $nama_bulan = 'ERROR FUNCTION';
                break;
        }

        return $nama_bulan;
	}

	function convert_to_24($timestring,$ampm){
		if(!$timestring||!$ampm){
			return false;
		}else{
			$tmp = explode(':', $timestring);
			$hour = $tmp[0];
			$minute = $tmp[1];

			if($ampm=='PM'){
				$hour = intval($hour) + 12;
			}

			return $hour.':'.$minute;
		}
	}

	function convert_to_12($timestring){
		$tmp = explode(':', $timestring);
		$hour = $tmp[0];
		$minute = $tmp[1];
		$second = $tmp[2];

		if(intval($hour) > 12){
			$hour = intval($hour) - 12;

			return $hour.':'.$minute.' PM';
		}else{
			return $hour.':'.$minute.' AM';
		}
	}
}

?>