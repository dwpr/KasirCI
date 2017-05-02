<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function getURLFriendly($str) {
	$string = preg_replace("/[-]+/", "-", preg_replace("/[^a-z0-9-]/", "", strtolower( str_replace(" ", "-", $str) ) ) );
		return $string;
}

function slugKategori($str){
	$string = preg_replace("/[^a-z0-9-]/", "", str_replace("dan", "", $str));
	return $string;
}

function UangRP($angka){
	$hasil = "Rp ".number_format($angka,0,',','.');
	return $hasil;
}

function Bayar($jumlah,$uang){
	$total = $jumlah*$uang;
	return $total;
}

function tanggal($tgl, $tipe) {
	$tgl_pc 		= explode(" ", $tgl);
	$tgl_depan		= $tgl_pc[0];
	
	$tgl_depan_pc	= explode("-", $tgl_depan);
	$tgl			= $tgl_depan_pc[2];
	$bln			= $tgl_depan_pc[1];
	$thn			= $tgl_depan_pc[0];
	
	if ($tipe == "lm") {
		if ($bln == "01") { $bln_txt = "Januari"; }  
		else if ($bln == "02") { $bln_txt = "Februari"; }  
		else if ($bln == "03") { $bln_txt = "Maret"; }  
		else if ($bln == "04") { $bln_txt = "April"; }  
		else if ($bln == "05") { $bln_txt = "Mei"; }  
		else if ($bln == "06") { $bln_txt = "Juni"; }  
		else if ($bln == "07") { $bln_txt = "Juli"; }  
		else if ($bln == "08") { $bln_txt = "Agustus"; }  
		else if ($bln == "09") { $bln_txt = "September"; }  
		else if ($bln == "10") { $bln_txt = "Oktober"; }  
		else if ($bln == "11") { $bln_txt = "November"; }  
		else if ($bln == "12") { $bln_txt = "Desember"; }  
	} else if ($tipe == "sm") {
		if ($bln == "01") { $bln_txt = "Jan"; }  
		else if ($bln == "02") { $bln_txt = "Feb"; }  
		else if ($bln == "03") { $bln_txt = "Mar"; }  
		else if ($bln == "04") { $bln_txt = "Apr"; }  
		else if ($bln == "05") { $bln_txt = "Mei"; }  
		else if ($bln == "06") { $bln_txt = "Jun"; }  
		else if ($bln == "07") { $bln_txt = "Jul"; }  
		else if ($bln == "08") { $bln_txt = "Ags"; }  
		else if ($bln == "09") { $bln_txt = "Sep"; }  
		else if ($bln == "10") { $bln_txt = "Okt"; }  
		else if ($bln == "11") { $bln_txt = "Nov"; }  
		else if ($bln == "12") { $bln_txt = "Des"; }  	
	}
	return $tgl." ".$bln_txt." ".$thn;
}
