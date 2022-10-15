<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FluxoVaga extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
		$this->Login_model->verificaSessao();

        if(($this->session->userdata('PermissaoId')!=2&&$this->session->userdata('PermissaoId')!=3)||$this->funcoes->verificaSituacaoEmpresa()>2){
            $link = base_url('index.php/Restrita/Home');
			echo "<script>window.location.href = '$link'</script>";
        }

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
            $lista[$i]['StatusDesc'] = $this->funcoes->getStatusClasse($a['Status'],'S');
            $lista[$i]['ClassBtn'] = $this->funcoes->getStatusClasse($a['Status'],'C');
            $lista[$i]['StatusFluxoDesc'] = $this->funcoes->getStatusClasse($a['StatusFluxo'],'S','F');
            $lista[$i]['ClassBtnFluxo'] = $this->funcoes->getStatusClasse($a['StatusFluxo'],'C','F');
        }
        echo json_encode($lista);
    }

    public function calculaValor()
    {
        $FluxoVagaId = $this->funcoes->get('FluxoVagaId');
        $EstacionamentoId = $this->funcoes->get('EstacionamentoId');

        $Entrada = $this->funcoes->formataData($this->funcoes->get('DataEntrada')).' '.$this->funcoes->formataHora($this->funcoes->get('HoraEntrada')).':00';
        $Saida = $this->funcoes->formataData($this->funcoes->get('DataSaida')).' '.$this->funcoes->formataHora($this->funcoes->get('HoraSaida')).':00';

        if($Entrada>=$Saida){
            echo json_encode(['erro'=>1]);
            exit;
        }

        if($FluxoVagaId){
            $FluxoVaga = $this->FluxoVaga_model->getFluxoVaga($FluxoVagaId);
        }

        $dados = $this->FluxoVaga_model->getDadosCalculo($EstacionamentoId,$Entrada,$Saida);
        $dadosCalculo = json_decode($dados['json'],true);
       
        echo json_encode([
            'valor'=>number_format(floatval($dadosCalculo['valor']), 2, '.', '')
            ,'tempo'=>$dadosCalculo['tempoDesc']
            ,'liberaPagamento'=>$dadosCalculo['liberaPagarAdiantado']
            ,'NomeEstacionamento'=>$dadosCalculo['NomeEstacionamento']
            ,'JaPagou'=>isset($FluxoVaga['JaPagou'])?$FluxoVaga['JaPagou']:'N'
            ,'erro'=>0
        ]);
    }

    public function setFinalizarLocacao()
    {
        $post = $this->funcoes->getPostAngular();
        $FluxoVagaId = $post['FluxoVagaId'];

        if($post['JaPagou']=='N'){
            $data_receber = [
                'FormaPagamentoId'=>$post['FormaPagamentoId']
                ,'FluxoVagaId'=>$post['FluxoVagaId']
                ,'Valor'=>$post['Valor']
                ,'Status'=>'F'
            ];
            $this->FluxoVaga_model->seReceber($data_receber);
        }

        $data_fluxo = [
            'DataSaida'=>$this->funcoes->formataData($post['DataSaida'])
            ,'HoraSaida'=>$this->funcoes->formataHora($post['HoraSaida'])
            ,'Status'=>'F'
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
        $obj['StatusFluxoDesc'] = $this->funcoes->getStatusClasse($obj['StatusFluxo'],'S','F');
        echo json_encode($obj);
    }

    public function getCadastros()
    {
        $Ativos = $this->funcoes->get('Ativos');
        $lista = $this->FluxoVaga_model->getCadastros($Ativos);
        foreach ($lista as $i => $a) {
            $lista[$i]['CpfFormatado'] = $this->funcoes->formatar_cpf_cnpj($a['Cpf']);
        }
        echo json_encode($lista);
    }

    public function setFluxoVaga()
    {
        $post = $this->funcoes->getPostAngular();
        $FluxoVagaId = isset($post['FluxoVagaId'])?$post['FluxoVagaId']:0;
        $ReservaId = isset($post['ReservaId'])?$post['ReservaId']:0;
        
        $data = [
            'EstacionamentoId'=>$post['EstacionamentoId']
            ,'DataEntrada'=>$this->funcoes->formataData($post['DataEntrada'])
            ,'HoraEntrada'=>$this->funcoes->formataHora($post['HoraEntrada'])
            ,'Observacao'=>isset($post['Observacao'])?$post['Observacao']:null
        ];

        if(isset($post['CadastroId'])){
            if($post['CadastroId']){
                $data['CadastroId'] = $post['CadastroId'];
            }
        }

        if($post['Tipo']=='F'){
            $data['PlacaVeiculo'] = $post['PlacaVeiculo'];
            if(isset($post['ReservaId'])){
                if($post['ReservaId']){
                    $data['ReservaId'] = $post['ReservaId'];
                }
            }

            $this->FluxoVaga_model->setFluxoVaga($data,$FluxoVagaId);
        }else{
            $data['DataSaida'] = $this->funcoes->formataData($post['DataSaida']);
            $data['HoraSaida'] = $this->funcoes->formataHora($post['HoraSaida']);
            
            $entrada = $data['DataEntrada'].' '.$data['HoraEntrada'].':00';
            $saida = $data['DataSaida'].' '.$data['HoraSaida'].':00';

            if($entrada>=$saida){
                echo 2;
                exit;
            }else if($entrada < Date('Y-m-d H:i:s')){
                echo 3;
                exit;
            }

            $ReservaId = $this->FluxoVaga_model->setReserva($data,$ReservaId);

            if($post['PagarAgora']=='S'){
                $data_receber = [
                    'FormaPagamentoId'=>$post['FormaPagamentoId']
                    ,'ReservaId'=>$ReservaId
                    ,'Valor'=>$post['Valor']
                    ,'Status'=>'F'
                ];
                $this->FluxoVaga_model->seReceber($data_receber);
            }

            echo 1;
        }

    }

    public function relatorio()
    {
        if($this->session->userdata('PermissaoId')!=2||$this->funcoes->verificaSituacaoEmpresa()>2){ 
            exit;
        }
        $params = json_decode(base64_decode($this->funcoes->get('p')),true);
        $lista = $this->FluxoVaga_model->getFluxoVagas($params,2);

        $data['titulo'] = 'Locações de Vagas';
        $data['lista'] = [];

        foreach ($lista as $i => $a) {
            $a['PlacaVeiculoFormatada'] = $this->funcoes->formataPlacaVeiculo($a['PlacaVeiculo']);
            $a['CpfCnpjFormatado'] = $this->funcoes->formatar_cpf_cnpj($a['CpfCnpjEstacionamento']);
            $a['StatusDesc'] = $this->funcoes->getStatusClasse($a['Status'],'S');
            $a['StatusFluxoDesc'] = $this->funcoes->getStatusClasse($a['StatusFluxo'],'S','F');
            $data['lista'][$a['EstacionamentoId']][] = $a;
        }

        $html = $this->load->view('restrita/relatorioFluxoVagas',$data,true);

        $this->funcoes->gerarPdf($html);
    }

    public function reservas()
    {
        $data['controller'] = "reservasController";
		$this->load->view('restrita/header',$data);
		$this->load->view('restrita/reservas');
		$this->load->view('restrita/footer');
    }

    public function novaReserva()
    {
        $data['controller'] = "novaReservaController";
        $data['ReservaId'] = base64_decode($this->funcoes->get('i'));
		$this->load->view('restrita/header',$data);
		$this->load->view('restrita/novaReserva');
		$this->load->view('restrita/footer');
    }

    public function setCliente()
    {
        $post = $this->funcoes->getPostAngular();
        $CadastroId = isset($post['CadastroId'])?$post['CadastroId']:0;

        $data = [
            'Nome'=>$post['Nome']
            ,'Cpf'=>$post['Cpf']
            ,'NumeroTelefone'=>$post['NumeroTelefone']
        ];

        $this->FluxoVaga_model->setCliente($data,$CadastroId);
    }

    public function getReservas()
    {
        $params = json_decode($this->funcoes->get('params'),true);
        $lista = $this->FluxoVaga_model->getReservas($params);
        foreach ($lista as $i => $a) {
            $lista[$i]['CpfCnpjFormatado'] = $this->funcoes->formatar_cpf_cnpj($a['CpfCnpjEstacionamento']);
            $lista[$i]['CpfClienteFormatado'] = $this->funcoes->formatar_cpf_cnpj($a['CpfCliente']);
            $lista[$i]['StatusDesc'] = $this->funcoes->getStatusClasse($a['Status'],'S');
            $lista[$i]['ClassBtn'] = $this->funcoes->getStatusClasse($a['Status'],'C');
            $lista[$i]['StatusFluxoDesc'] = $this->funcoes->getStatusClasse($a['StatusFluxo'],'S','F');
            $lista[$i]['ClassBtnFluxo'] = $this->funcoes->getStatusClasse($a['StatusFluxo'],'C','F');
        }
        echo json_encode($lista);
    }

    public function getReserva()
    {
        $ReservaId = $this->funcoes->get('ReservaId');
        $obj = $this->FluxoVaga_model->getReserva($ReservaId);
        $obj['StatusDesc'] = $this->funcoes->getStatusClasse($obj['Status'],'S');
        $obj['StatusFluxoDesc'] = $this->funcoes->getStatusClasse($obj['StatusFluxo'],'S','F');
        echo json_encode($obj);
    }

    public function getInfoLotacao()
    {
        $EstacionamentoId = $this->funcoes->get('EstacionamentoId');
        $DataEntrada = $this->funcoes->formataData($this->funcoes->get('DataEntrada'));
        $HoraEntrada = $this->funcoes->formataHora($this->funcoes->get('HoraEntrada'));
        $HoraSaida = $this->funcoes->formataHora($this->funcoes->get('HoraSaida'));

        $filtros = [
            'EstacionamentoId'=> $EstacionamentoId
            ,'DataInicio'=> ""
            ,'DataFim'=> ""
            ,'CadastroId'=> ""
            ,'Reservado'=> ""
            ,'StatusFluxo'=> "E"
            ,'FormaPagamentoId'=> ""
            ,'StatusPagamento'=> ""
        ];
        $locacoes = $this->FluxoVaga_model->getFluxoVagas($filtros);
        $reservas_proximas = $this->FluxoVaga_model->getReservasProximas($EstacionamentoId,$DataEntrada,$HoraEntrada,$HoraSaida);

        echo json_encode([
                'QtdLocacoes'=> count($locacoes)
                ,'reservas_proximas'=> $reservas_proximas
            ]);
    }

    public function gerarFluxos()
    {
        $alfabeto = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $EstacionamentoId = 8;
        $data = "2022-10-15";
        $gerar = 30;
        $fechar = 1;
        $somente_fechar = 0;
        $Reserva = 0;

        if($somente_fechar==1){
            $dados_geral = [];

            $filtros = [
                'EstacionamentoId'=> $EstacionamentoId
                ,'DataInicio'=> ""
                ,'DataFim'=> ""
                ,'CadastroId'=> ""
                ,'Reservado'=> ""
                ,'StatusFluxo'=> "E"
                ,'FormaPagamentoId'=> ""
                ,'StatusPagamento'=> ""
            ];
            $lista = $this->FluxoVaga_model->getFluxoVagas($filtros);

            foreach ($lista as $i => $a) {
                if($gerar>=$i){
                    $HoraSaida = rand(($a['HoraEntradaDb']+1),21);
                    $MinSaida = rand(1,59);

                    $dados[$i] = [
                        'Status'=>'F'
                        ,'DataSaida'=>$a['DataEntradaDb']
                        ,'HoraSaida'=>($HoraSaida<10?'0':'').$HoraSaida.":".($MinSaida<10?'0':'').$MinSaida.":00"
                    ];

                    $dados_geral[$i] = $dados[$i];

                    $this->FluxoVaga_model->setFluxoVaga($dados[$i],$a['FluxoVagaId']);

                    if($a['JaPagou']=='N'){
                        $Entrada = $a['DataEntradaDb']." ".$a['HoraEntrada'].":00";
                        $Saida = $dados[$i]['DataSaida']." ".$dados[$i]['HoraSaida'];

                        $dadosCalculo = $this->FluxoVaga_model->getDadosCalculo($EstacionamentoId,$Entrada,$Saida);
                        $objEstacionamento = json_decode($dadosCalculo['json'],true);

                        $dados_receber[$i] = [
                            'FormaPagamentoId'=>rand(1,4)
                            ,'FluxoVagaId'=>$a['FluxoVagaId']
                            ,'Status'=>'F'
                            ,'Valor'=> number_format(floatval($objEstacionamento['valor']), 2, '.', '')
                        ];

                        $this->FluxoVaga_model->seReceber($dados_receber[$i]);

                        $dados_geral[$i] += $dados_receber[$i];
                    }
                }
            }

            echo "<pre>";
            print_r($dados_geral);
        }else{
            
            for ($i=0; $i <$gerar ; $i++) { 
                if($Reserva==0){
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
                }
                $possiveis_minutos = [15,30,45,00];

                $HoraEntrada = rand(8,19);
                $MinEntrada = $Reserva==0?rand(1,59):$possiveis_minutos[rand(1,3)];

                if($fechar==1||$Reserva==1){
                    $HoraSaida = rand(($HoraEntrada+1),21);
                    $MinSaida = $Reserva==0?rand(1,59):$possiveis_minutos[rand(1,3)];
                }
                
                if($Reserva==0){
                   $dados[$i] = [
                        'EstacionamentoId'=>$EstacionamentoId
                        ,'PlacaVeiculo'=>$placa
                        ,'Status'=>$fechar==1?'F':'E'
                        ,'DataEntrada'=>$data
                        ,'HoraEntrada'=>($HoraEntrada<10?'0':'').$HoraEntrada.":".($MinEntrada<10?'0':'').$MinEntrada.":00"
                    
                    ]; 
                }else{
                    $dados[$i] = [
                        'EstacionamentoId'=>$EstacionamentoId
                        ,'CadastroId'=>rand(1,18)
                        ,'DataEntrada'=>$data
                        ,'HoraEntrada'=>($HoraEntrada<10?'0':'').$HoraEntrada.":".($MinEntrada<10?'0':'').$MinEntrada.":00"
                    ]; 
                }
                
                if($fechar==1||$Reserva==1){
                    $dados[$i] += [
                        'DataSaida'=>$data
                        ,'HoraSaida'=>($HoraSaida<10?'0':'').$HoraSaida.":".($MinSaida<10?'0':'').$MinSaida.":00"
                    ];
                }
                if($Reserva==0){
                    $FluxoVagaId = $this->FluxoVaga_model->setFluxoVaga($dados[$i]);
                }else{
                    $ReservaId = $this->FluxoVaga_model->setReserva($dados[$i]); 
                }

                $dados_geral[$i] = $dados[$i];

                if($fechar==1){
                    $Entrada = $dados[$i]['DataEntrada']." ".$dados[$i]['HoraEntrada'];
                    $Saida = $dados[$i]['DataSaida']." ".$dados[$i]['HoraSaida'];

                    $dadosCalculo = $this->FluxoVaga_model->getDadosCalculo($EstacionamentoId,$Entrada,$Saida);
                    $objEstacionamento = json_decode($dadosCalculo['json'],true);

                    $dados_receber[$i] = [
                        'FormaPagamentoId'=>rand(1,4)
                        ,'FluxoVagaId'=>$FluxoVagaId
                        ,'Status'=>'F'
                        ,'Valor'=> number_format(floatval($objEstacionamento['valor']), 2, '.', '')
                    ];

                    $this->FluxoVaga_model->seReceber($dados_receber[$i]);

                    $dados_geral[$i] += $dados_receber[$i];
                }


            }

            echo "<pre>";
            print_r($dados_geral);
        }

    }
}