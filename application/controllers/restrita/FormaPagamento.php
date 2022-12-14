<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormaPagamento extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
		$this->Login_model->verificaSessao();

		if($this->session->userdata('PermissaoId')!=1){
            $link = base_url('index.php/Restrita/Home');
			echo "<script>window.location.href = '$link'</script>";
        }

        $this->load->model('FormaPagamento_model');
    }

	public function index()
	{
		$data['controller'] = "formaPagamentoController";
		$this->load->view('restrita/header',$data);
		$this->load->view('restrita/formaPagamento');
		$this->load->view('restrita/footer');
	}

	public function setFormaPagamento()
	{
		$post = $this->funcoes->getPostAngular();

		$FormaPagamentoId = isset($post['FormaPagamentoId'])?$post['FormaPagamentoId']:0;
		$data = ['Descricao' => $post['Descricao']];

		$this->FormaPagamento_model->setFormaPagamento($data,$FormaPagamentoId);
		
	}
}
