<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FluxoVaga extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
		$this->Login_model->verificaSessao();
        $this->load->model('FluxoVaga_model');
        //$this->load->model('Empresa_model');
        //$this->load->model('Estacionamento_model');
    }
    
    public function index()
    {
		$data['controller'] = "fluxoVagaController";
		$this->load->view('restrita/header',$data);
		$this->load->view('restrita/fluxoVaga');
		$this->load->view('restrita/footer');
	}

    public function getFluxoVagas()
    {
        $lista = $this->FluxoVaga_model->getFluxoVagas();
        foreach ($lista as $i => $a) {
            $lista[$i]['PlacaVeiculoFormatada'] = $this->funcoes->formataPlacaVeiculo($a['PlacaVeiculo']);
            $lista[$i]['CpfCnpjFormatado'] = $this->funcoes->formatar_cpf_cnpj($a['CpfCnpjEstacionamento']);
        }
        echo json_encode($lista);
    }

    public function calclulaValor()
    {
        $EstacionamentoId = $this->funcoes->get('EstacionamentoId');
        $DataEntrada = $this->funcoes->get('DataEntrada');
        $HoraEntrada = $this->funcoes->get('HoraEntrada');
        $DataSaida = $this->funcoes->get('DataSaida');
        $HoraSaida = $this->funcoes->get('HoraSaida');
    }

    public function novoFluxoVaga()
    {
		$data['controller'] = "novoFluxoVagaController";
        $data['FluxoVagaId'] = base64_decode($this->funcoes->get('i'));
		$this->load->view('restrita/header',$data);
		$this->load->view('restrita/novoFluxoVaga');
		$this->load->view('restrita/footer');
	}

    public function setFluxoVaga()
    {
        $post = $this->funcoes->getPostAngular();
        $FluxoVagaId = isset($post['FluxoVagaId'])?$post['FluxoVagaId']:0;

        $data = [
            'EstacionamentoId'=>$post['EstacionamentoId']
            ,'CadastroId'=>isset($post['CadastroId'])?$post['CadastroId']:null
            ,'PlacaVeiculo'=>$post['PlacaVeiculo']
            ,'DataEntrada'=>$this->funcoes->formataData($post['DataEntrada'])
            ,'HoraEntrada'=>$this->funcoes->formataHora($post['HoraEntrada'])
            ,'Observacao'=>isset($post['Observacao'])?$post['Observacao']:null
            ,'Reserva'=>'N'
        ];

        if(isset($post['DataSaida'])){
            $data['DataSaida'] = $this->funcoes->formataData($post['DataSaida']);
        }

        if(isset($post['HoraEntrada'])){
            $data['HoraEntrada'] = $this->funcoes->formataHora($post['HoraEntrada']);
        }

        $this->FluxoVaga_model->setFluxoVaga($data,$FluxoVagaId);

    }
}