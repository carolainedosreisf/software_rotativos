<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cadastro_model');
        $this->load->model('Login_model');
        $this->load->model('Empresa_model');
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

    public function getValidaDados()
    {
        $NomeUsuario = $_GET['NomeUsuario'];
        $Email = $_GET['Email'];
        $CpfCnpj = $_GET['CpfCnpj'];
        $TipoEmpresa = $_GET['TipoEmpresa'];
        $lista_erros = [];

        $erro_1 = $this->Login_model->getValidaNomeLogin($NomeUsuario);
        $erro_2 = $this->Login_model->getValidaEmail($Email);
        $erro_3 = $this->Empresa_model->getValidaCpfCnpj($CpfCnpj);

        if($erro_1>0){
            $lista_erros[] = "Este Nome Usuário já esta sendo utilizado, favor digite outro.";
        }

        if($erro_2>0){
            $lista_erros[] = "Este e-mail já esta cadastrado em nossa base de dados.";
        }

        if($erro_3>0){
            $lista_erros[] = "Este ".($TipoEmpresa=='J'?'CNPJ':'CPF')." já esta cadastrado em nossa base de dados.";
        }

        echo json_encode($lista_erros);
    }

    public function setCadastro()
    {
        $post = $this->funcoes->getPostAngular();

        $data_cadastro = [
            'Nome' => $post['Nome'],
            'RazaoSocial' => $post['RazaoSocial'],
            'TipoCadastro' => 'E',
            'CpfCnpj' => $post['TipoEmpresa']=='J'?$post['Cnpj']:$post['Cpf'],
            'NumeroCelular' => $post['NumeroTelefone1'],
            'NumeroTelefone' => isset($post['NumeroTelefone2'])?$post['NumeroTelefone2']:null,
            'NumeroCep' => $post['NumeroCep'],
            'CidadeId' =>$post['CidadeId'],
            'NumeroEndereco' => $post['NumeroEndereco'],
            'BairroEndereco' => $post['BairroEndereco'],
            'Endereco' => $post['Endereco'],
        ];

        $CadastroId = $this->Cadastro_model->setCadastro($data_cadastro);

        $data_login = [
            'Email' => $post['Email'],
            'NomeUsuario' => $post['NomeUsuario'],
            'Senha' => md5($post['Senha']),
            'CadastroId' => $CadastroId,
            'PermissaoId' => 2
        ];

        $data_empresa = [
            'Nome' => $post['Nome'],
            'RazaoSocial' => $post['RazaoSocial'],
            'TipoEmpresa' => $post['TipoEmpresa'],
            'CpfCnpj' => $post['TipoEmpresa']=='J'?$post['Cnpj']:$post['Cpf'],
            'Endereco' => $post['Endereco'],
            'NumeroEndereco' => $post['NumeroEndereco'],
            'NumeroCep' => $post['NumeroCep'],
            'CidadeId' =>$post['CidadeId'],
            'BairroEndereco' => $post['BairroEndereco'],
            'NumeroTelefone1' => $post['NumeroTelefone1'],
            'NumeroTelefone2' => isset($post['NumeroTelefone2'])?$post['NumeroTelefone2']:null,
        ];
        
        $this->Login_model->setLogin($data_login);
        $this->Empresa_model->setEmpresa($data_empresa);
    }
}
