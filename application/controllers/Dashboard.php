<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  public function __construct(){
    parent::__construct();
    $this->load->model("model_dashboard");
  }

  public function index()
  {
    $data['page_title'] = "Dashboard";
    $data['topbar_title'] = "Dashboard";
    $data['bread'] = [
      [true, "Dashboard", "javascript:void(0);"]
    ];
    $this->themes->primary("dashboard/content", $data);
  }
}
