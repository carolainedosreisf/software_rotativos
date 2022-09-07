<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Empresa_model');
        $this->load->model('Estacionamento_model');
    }

	public function index()
	{
		$data['controller'] = "loginController";
		$this->load->view('header',$data);
		$this->load->view('login');
		$this->load->view('footer');
	}

	public function getValidaAcesso()
	{
		$post = $this->funcoes->getPostAngular();
		$NomeUsuario = $post['NomeUsuario'];
		$Senha = MD5($post['Senha']);

        $login = $this->Login_model->getValidaAcesso($NomeUsuario,$Senha);

		if(!$login){
			echo 0;
			exit;
		}

		$estacionamento = $this->Estacionamento_model->getEstacionamento($login['EstacionamentoId']);
		
		$sessao= [
			'EstacionamentoId' => $login['EstacionamentoId'],
			'PermissaoId' => $login['PermissaoId'],
			'nome' => $estacionamento['Nome'],
			'CpfCnpj' => $estacionamento['CpfCnpj'],
			'TipoEmpresa' => $estacionamento['TipoEmpresa'],
			'EmpresaId' => $estacionamento['EmpresaId'],
			'DataCadastro' => $estacionamento['DataCadastro'],
			'TempoInatividadeSessao' => strtotime(date("Y-m-d H:i:s")."+30 minutes")
		];
		
		$this->session->set_userdata($sessao);
		echo 1;
	}

	public function sair()
	{
		$this->session->sess_destroy();
		$link = base_url('index.php/Login');
		echo "<script>window.location.href = '$link'</script>";
	}
}
