<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
    }

	public function index()
	{
		$data['controller'] = "loginController";
		$this->load->view('header',$data);
		$this->load->view('login');
		$this->load->view('footer');
	}

	public function getValidaNomeLogin()
    {
        $nome_usuario = $_GET['nome_usuario'];
        $qtd = $this->Login_model->getValidaNomeLogin($nome_usuario);
        echo $qtd;
    }
}
