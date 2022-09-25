<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FluxoVaga extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
		$this->Login_model->verificaSessao();
        $this->load->model('FluxoVaga_model');
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
        $params = json_decode($this->funcoes->get('params'),true);
        $lista = $this->FluxoVaga_model->getFluxoVagas($params);
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

        if($Entrada>$Saida){
            echo json_encode(['erro'=>1]);
            exit;
        }
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
            ,'erro'=>0
        ]);
    }

    public function setFinalizarLocacao()
    {
        $post = $this->funcoes->getPostAngular();
        $FluxoVagaId = $post['FluxoVagaId'];

        $data_receber = [
            'FormaPagamentoId'=>$post['FormaPagamentoId']
            ,'FluxoVagaId'=>$post['FluxoVagaId']
            ,'Valor'=>$post['Valor']
        ];

        $this->FluxoVaga_model->seReceber($data_receber);

        $data_fluxo = [
            'DataSaida'=>$this->funcoes->formataData($post['DataSaida'])
            ,'HoraSaida'=>$this->funcoes->formataHora($post['HoraSaida'])
        ];

        $this->FluxoVaga_model->setFluxoVaga($data_fluxo,$FluxoVagaId);
    }

    public function novoFluxoVaga()
    {
		$data['controller'] = "novoFluxoVagaController";
        $data['FluxoVagaId'] = base64_decode($this->funcoes->get('i'));
		$this->load->view('restrita/header',$data);
		$this->load->view('restrita/novoFluxoVaga');
		$this->load->view('restrita/footer');
	}

    public function getFluxoVaga()
    {
        $FluxoVagaId = $this->funcoes->get('FluxoVagaId');
        $obj = $this->FluxoVaga_model->getFluxoVaga($FluxoVagaId);
        echo json_encode($obj);
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
        ];

        if(isset($post['DataSaida'])){
            $data['DataSaida'] = $this->funcoes->formataData($post['DataSaida']);
        }

        if(isset($post['HoraEntrada'])){
            $data['HoraEntrada'] = $this->funcoes->formataHora($post['HoraEntrada']);
        }

        $this->FluxoVaga_model->setFluxoVaga($data,$FluxoVagaId);

    }

    public function relatorio()
    {
        $params = json_decode(base64_decode($this->funcoes->get('p')),true);
        $lista = $this->FluxoVaga_model->getFluxoVagas($params,2);

        $data['titulo'] = 'Fluxo de Vagas';
        $data['lista'] = [];

        foreach ($lista as $i => $a) {
            $a['PlacaVeiculoFormatada'] = $this->funcoes->formataPlacaVeiculo($a['PlacaVeiculo']);
            $a['CpfCnpjFormatado'] = $this->funcoes->formatar_cpf_cnpj($a['CpfCnpjEstacionamento']);
            $data['lista'][$a['EstacionamentoId']][] = $a;
        }

        $html = $this->load->view('restrita/relatorioFluxoVagas',$data,true);

        $this->funcoes->gerarPdf($html);
    }

    public function gerarFluxos()
    {
        $alfabeto = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $EstacionamentoId = 8;
        $data = "2022-09-22";
        $gerar = 50;
        $fechar = 1;

        for ($i=0; $i <$gerar ; $i++) { 
            $modelo = rand(1,2);
            $placa = "";
            for ($x=1; $x <=7 ; $x++) { 
                if($x<=3){
                    $placa .= $alfabeto[rand(0,25)];
                }else{
                    if($modelo==2 && $x==5){
                        $placa .= $alfabeto[rand(0,25)]; 
                    }else{
                        $placa .= rand(1,9);
                    }
                    
                }
            }
            $HoraEntrada = rand(8,19);
            $MinEntrada = rand(1,59);

            $HoraSaida = rand(($HoraEntrada+1),21);
            $MinSaida = rand(1,59);


            $dados[$i] = [
                'EstacionamentoId'=>$EstacionamentoId
                ,'PlacaVeiculo'=>$placa
                ,'DataEntrada'=>$data
                ,'HoraEntrada'=>($HoraEntrada<10?'0':'').$HoraEntrada.":".($MinEntrada<10?'0':'').$MinEntrada.":00"
                ,'DataSaida'=>$data
                ,'HoraSaida'=>($HoraSaida<10?'0':'').$HoraSaida.":".($MinSaida<10?'0':'').$MinSaida.":00"
            ];
            $FluxoVagaId = $this->FluxoVaga_model->setFluxoVaga($dados[$i]);

            $Entrada = $dados[$i]['DataEntrada']." ".$dados[$i]['HoraEntrada'];
            $Saida = $dados[$i]['DataSaida']." ".$dados[$i]['HoraSaida'];

            $objEstacionamento = $this->Estacionamento_model->getEstacionamento($EstacionamentoId,null,$Entrada,$Saida);
            $horas_totais = $objEstacionamento['minutos']/60;
            $ValorHora =  $objEstacionamento['PrecoHora']>0?($horas_totais*$objEstacionamento['PrecoHora']):0;
            $ValorLivre =  $objEstacionamento['PrecoLivre']>0?$objEstacionamento['PrecoLivre']:0;
            $valor = $ValorLivre;
            if(($ValorHora>0 && $ValorLivre>0 && $ValorLivre > $ValorHora) || $ValorLivre<=0){
                $valor = $ValorHora;
            }

            $dados_receber[$i] = [
                'FormaPagamentoId'=>rand(1,4)
                ,'FluxoVagaId'=>$FluxoVagaId
                ,'Valor'=> number_format(floatval($valor), 2, '.', '')
            ];

            $this->FluxoVaga_model->seReceber($dados_receber[$i]);

            $dados_geral[$i] = $dados[$i];
            $dados_geral[$i] += $dados_receber[$i];

        }

        echo "<pre>";
        print_r($dados_geral);

    }
}