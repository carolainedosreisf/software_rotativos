<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FluxoVaga extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
		$this->Login_model->verificaSessao();
        $this->load->model('FluxoVaga_model');
        //$this->load->model('Empresa_model');
        //$this->load->model('Estacionamento_model');
    }
    
    public function index()
    {
		$data['controller'] = "fluxoVagaController";
		$this->load->view('restrita/header',$data);
		$this->load->view('restrita/fluxoVaga');
		$this->load->view('restrita/footer');
	}
}