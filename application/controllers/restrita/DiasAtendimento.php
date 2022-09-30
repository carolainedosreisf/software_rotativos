<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DiasAtendimento extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
		$this->Login_model->verificaSessao();

		if($this->session->userdata('PermissaoId')!=1){
            $link = base_url('index.php/Restrita/Home');
			echo "<script>window.location.href = '$link'</script>";
        }

        $this->load->model('DiasAtendimento_model');
    }

	public function index()
	{
		$data['controller'] = "diasAtendimentoController";
		$this->load->view('restrita/header',$data);
		$this->load->view('restrita/diasAtendimento');
		$this->load->view('restrita/footer');
	}

	public function setDiasAtendimento()
	{
		$post = $this->funcoes->getPostAngular();

		$DiasAtendimentoId = isset($post['DiasAtendimentoId'])?$post['DiasAtendimentoId']:0;
		$data = ['DescricaoDiasAtendimento' => $post['Descricao']];

		$this->DiasAtendimento_model->setDiasAtendimento($data,$DiasAtendimentoId);
		
	}
}
