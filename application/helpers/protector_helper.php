<?php
if(!defined('BASEPATH')) exit('no file allowed');
function check_login(){
	$Ci =& get_instance();
	$Ci->load->library('Session'); 
	$session = $Ci->session->userdata('status_login');
	if($session){
		redirect("dashboard");
	}
}

function check_session(){
	$Ci =& get_instance();
	$Ci->load->library('Session'); 
	$session = $Ci->session->userdata('status_login');
	if(!$session){
		redirect(base_url());
	}
}
?>