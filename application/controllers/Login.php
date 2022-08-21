<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Cadastro_model');
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

        $CadastroId = $this->Login_model->getValidaAcesso($NomeUsuario,$Senha);

		if($CadastroId==0){
			echo 0;
			exit;
		}

		$cadastro = $this->Cadastro_model->getCadastro($CadastroId);
		session_start();
		$_SESSION['login_empresa'] = $cadastro;
        $_SESSION['login_empresa']['tempo_inatividade'] = strtotime(date("Y-m-d H:i:s")."+30 minutes");

		echo 1;
	}
}
