<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Empresa_model');
        $this->load->model('Estacionamento_model');
    }

	public function index()
	{
		$data['controller'] = "empresaController";
		$this->load->view('header',$data);
		$this->load->view('empresa');
		$this->load->view('footer');
	}

    public function getCidades()
    {
        $descricao = $_GET['desc'];
        $lista = $this->Empresa_model->getCidades($descricao);
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
        $erro_3 = $this->Estacionamento_model->getValidaCpfCnpj($CpfCnpj);

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
            'Email' => $post['Email'],
        ];

        $EmpresaId = $this->Empresa_model->setEmpresa($data_empresa);

        $data_estacionamento = [
            'RazaoSocial' => $post['RazaoSocial'],
            'CpfCnpj' => $post['TipoEmpresa']=='J'?$post['Cnpj']:$post['Cpf'],
            'Endereco' => $post['Endereco'],
            'NumeroEndereco' => $post['NumeroEndereco'],
            'NumeroCep' => $post['NumeroCep'],
            'CidadeId' =>$post['CidadeId'],
            'BairroEndereco' => $post['BairroEndereco'],
            'NumeroTelefone1' => $post['NumeroTelefone1'],
            'NumeroTelefone2' => isset($post['NumeroTelefone2'])?$post['NumeroTelefone2']:null,
            'Email' => $post['Email'],
            'EmpresaId' => $EmpresaId,
        ];

        $EstacionamentoId = $this->Estacionamento_model->setEstacionamento($data_estacionamento);

        $data_login = [
            'Email' => $post['Email'],
            'NomeUsuario' => $post['NomeUsuario'],
            'Senha' => md5($post['Senha']),
            'EstacionamentoId' => $EstacionamentoId,
            'PermissaoId' => 2
        ];
        
        $this->Login_model->setLogin($data_login);
    }
}
