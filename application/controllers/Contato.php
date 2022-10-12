<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contato extends CI_Controller {

	public function index()
	{
		$data['EmpresaSoftware'] = $this->funcoes->getEmpresaSoftware();
		$data['controller'] = "contatoController";
		$this->load->view('header',$data);
		$this->load->view('contato');
		$this->load->view('footer');
	}
}
