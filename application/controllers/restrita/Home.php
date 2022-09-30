<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
		$this->Login_model->verificaSessao();
    }

    public function index()
    {
        $data['controller'] = "homeController";
		$this->load->view('restrita/header',$data);
		$this->load->view('restrita/home');
		$this->load->view('restrita/footer');
    }
}
