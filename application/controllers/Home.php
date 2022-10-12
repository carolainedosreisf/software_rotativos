<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['EmpresaSoftware'] = $this->funcoes->getEmpresaSoftware();
		$data['controller'] = "indexController";
		$this->load->view('header',$data);
		$this->load->view('index');
		$this->load->view('footer');
	}
}
