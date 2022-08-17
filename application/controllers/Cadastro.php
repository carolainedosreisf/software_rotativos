<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cadastro_model');
        $this->load->model('Login_model');
    }

	public function index()
	{
		$data['controller'] = "cadastroController";
		$this->load->view('header',$data);
		$this->load->view('cadastro');
		$this->load->view('footer');
	}

    public function getCidades()
    {
        $descricao = $_GET['desc'];
        $lista = $this->Cadastro_model->getCidades($descricao);
        echo json_encode($lista);
    }

    public function setCadastro()
    {
        $post = $this->funcoes->getPostAngular();
        $CadastroId = $this->Cadastro_model->getUltimoCadastro();

        $data_cadastro = [
            'CadastroId'=>$CadastroId,
            'Nome' => $post['Nome'],
            'RazaoSocial' => $post['RazaoSocial'],
            'TipoCadastro' => $post['TipoCadastro'],
            'CpfCnpj' => $post['TipoCadastro']=='J'?$post['Cnpj']:$post['Cpf'],
            'NumeroTelefone' => isset($post['NumeroTelefone'])?$post['NumeroTelefone']:null,
            'NumeroCelular' => $post['NumeroCelular'],
            'NumeroCep' => $post['NumeroCep'],
            'CidadeId' =>$post['CidadeId'],
            'NumeroEndereco' => $post['NumeroEndereco'],
            'BairroEndereco' => $post['BairroEndereco'],
            'PermissaoId' => 2
        ];

        $data_login = [
            'LoginId' => $this->Login_model->getUltimoLogin(),
            'Email' => $post['Email'],
            'NomeUsuario' => $post['NomeUsuario'],
            'Senha' => md5($post['Senha']),
            'CadastroId' => $CadastroId
        ];

        $this->Cadastro_model->setCadastro($data_cadastro);
        $this->Login_model->setLogin($data_login);
    }
}
