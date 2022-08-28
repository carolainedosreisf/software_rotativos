<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormaPagamento extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
		$this->Login_model->verificaSessao();
        $this->load->model('FormaPagamento_model');
    }

	public function index()
	{
		$data['controller'] = "formaPagamentoController";
		$this->load->view('restrita/header',$data);
		$this->load->view('restrita/formaPagamento');
		$this->load->view('restrita/footer');
	}

	public function getFormasPagamento()
	{
		$lista = $this->FormaPagamento_model->getFormasPagamento();
		echo json_encode($lista);
	}

	public function setFormaPagamento()
	{
		$post = $this->funcoes->getPostAngular();

		$FormaPagamentoId = isset($post['FormaPagamentoId'])?$post['FormaPagamentoId']:0;
		$data = ['Descricao' => $post['Descricao']];

		$this->FormaPagamento_model->setFormaPagamento($data,$FormaPagamentoId);
		
	}
}
