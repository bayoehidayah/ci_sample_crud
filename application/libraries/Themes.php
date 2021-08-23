<?php

if(!defined('BASEPATH')) exit('no file allowed');

class Themes{

    protected $_ci;

     function __construct(){
        $this->_ci =& get_instance();
    }

    function login($theme, $data=null){
        $data['login'] = true;
        $data['error'] = false;
        $this->metronic($theme, $data);
    }
    
    function primary($theme, $data=null){
        $data['login'] = false;
        $data['error'] = false;
        $this->metronic($theme, $data);
    }

    function error_404(){
        $data['login'] = false;
        $data['error'] = true;
        $this->metronic("error_404", $data);
    }

    function error_500($msg = null){
        $data['login'] = false;
        $data['error'] = true;
        $data["msg"]   = $msg != null ? $msg : "Looks like something went wrong.";
        $this->metronic("error_500", $data);
    }

	//Metronic Themes
    function metronic($theme, $data=null){
        $data['content'] = $this->_ci->load->view($theme,$data,true);
        $data['sidebar'] = $this->_ci->load->view('template/sidebar.php',$data,true);
        $data['topbar']  = $this->_ci->load->view('template/topbar.php',$data,true);
        $data['footer']  = $this->_ci->load->view('template/footer.php',$data,true);
        $this->_ci->load->view('theme_config', $data);
    }
}
