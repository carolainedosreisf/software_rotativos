<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estacionamento extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
		$this->Login_model->verificaSessao();
        $this->load->model('Empresa_model');
        $this->load->model('Estacionamento_model');
    }

	public function index()
    {
		$data['controller'] = "estacionamentosController";
		$this->load->view('restrita/header',$data);
		$this->load->view('restrita/estacionamentos');
		$this->load->view('restrita/footer');
	}

    public function getEstacionamentos()
    {
        $EmpresaId = $this->session->userdata('EmpresaId');
        $lista = $this->Estacionamento_model->getEstacionamento(null,$EmpresaId);

        foreach ($lista as $i => $a) {
            $lista[$i]['CpfCnpjFormatado'] = $this->funcoes->formatar_cpf_cnpj($a['CpfCnpj']);
            $lista[$i]['NumeroTelefone1Formatado'] = $this->funcoes->formatar_telefone($a['NumeroTelefone1']);
            $lista[$i]['NumeroTelefone2Formatado'] = $this->funcoes->formatar_telefone($a['NumeroTelefone2']);
        }

        echo json_encode($lista);
    }

    public function novoEstacionamento()
    {
		$data['controller'] = "novoEstacionamentoController";
        $data['EstacionamentoId'] = base64_decode($this->funcoes->get('i'));
		$this->load->view('restrita/header',$data);
		$this->load->view('restrita/novoEstacionamento');
		$this->load->view('restrita/footer');
	}

    public function getEstacionamento()
    {
        $EstacionamentoId = $this->funcoes->get('EstacionamentoId');
        $obj = $this->Estacionamento_model->getEstacionamento($EstacionamentoId);
        echo json_encode($obj);
    }

    public function setEstacionamento()
    {
		$post = $this->funcoes->getPostAngular();
        $EstacionamentoId = isset($post['EstacionamentoId'])?$post['EstacionamentoId']:0;

        $data = [
            'RazaoSocial' => $post['RazaoSocial'],
            'Endereco' => $post['Endereco'],
            'NumeroEndereco' => $post['NumeroEndereco'],
            'complemento' => isset($post['complemento'])?$post['complemento']:null,
            'NumeroCep' => $post['NumeroCep'],
            'CidadeId' =>$post['CidadeId'],
            'BairroEndereco' => $post['BairroEndereco'],
            'NumeroTelefone1' => $post['NumeroTelefone1'],
            'NumeroTelefone2' => isset($post['NumeroTelefone2'])?$post['NumeroTelefone2']:null,
            'Email' => $post['Email'],
            'NumeroVagas' => $post['NumeroVagas'],
            'Sobre' => isset($post['Sobre'])?$post['Sobre']:null,
        ];

        if($post['Matriz']=='S'){
            $EmpresaId = $post['EmpresaId'];
            $this->Empresa_model->setEmpresa($data,$EmpresaId);
        }

        $data += [
            'PrecoLivre' => $post['PrecoLivre'],
            'PrecoHora' => $post['PrecoHora']
        ];

        $this->Estacionamento_model->setEstacionamento($data,$EstacionamentoId);

        echo "<pre>";
        print_r($post);

    }

}