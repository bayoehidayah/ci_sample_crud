<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Directing extends CI_Controller{
        
        function not_found(){
            $this->themes->error_404();
        }

        function error(){
            $this->themes->error_500();
        }
    }
?>