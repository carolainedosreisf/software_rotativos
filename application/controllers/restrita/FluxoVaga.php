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
        $this->load->model('Estacionamento_model');
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
        $id = $this->funcoes->get('EstacionamentoId');
        $Entrada = $this->funcoes->formataData($this->funcoes->get('DataEntrada')).' '.$this->funcoes->get('HoraEntrada').':00';
        $Saida = $this->funcoes->formataData($this->funcoes->get('DataSaida')).' '.$this->funcoes->formataHora($this->funcoes->get('HoraSaida')).':00';

        $objEstacionamento = $this->Estacionamento_model->getEstacionamento($id,null,$Entrada,$Saida);
        $horas_totais = $objEstacionamento['minutos']/60;
        $horas = (int) ($objEstacionamento['minutos']/60);
        $minutos = $objEstacionamento['minutos']%60;

        $ValorHora =  $objEstacionamento['PrecoHora']>0?($horas_totais*$objEstacionamento['PrecoHora']):0;
        $ValorLivre =  $objEstacionamento['PrecoLivre']>0?$objEstacionamento['PrecoLivre']:0;

        $valor = $ValorLivre;
        if(($ValorHora>0 && $ValorLivre>0 && $ValorLivre > $ValorHora) || $ValorLivre<=0){
            $valor = $ValorHora;
        }

        echo json_encode([
            'valor'=>number_format(floatval($valor), 2, '.', '')
            ,'tempo'=>$horas.'Hrs'. ' e '.$minutos.'Min'
        ]);
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