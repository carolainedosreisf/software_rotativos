<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
		$this->Login_model->verificaSessao();
        $this->load->model('Home_model');
    }

    public function index()
    {
        $data['controller'] = "homeController";
        $data['PermissaoId'] = $this->session->userdata('PermissaoId');
		$this->load->view('restrita/header',$data);
		$this->load->view('restrita/home');
		$this->load->view('restrita/footer');
    }

    public function getDadosGrafico()
    {
        $Mes = $this->funcoes->get('Mes');
        $Ano = $this->funcoes->get('Ano');

        $lista = $Mes?$this->Home_model->getDadosMesGrafico($Ano,$Mes):$this->Home_model->getDadosAnoGrafico();

        $lista_grafico[] = ["Element", "Valor (R$)", ['type'=> "string", 'role'=> "tooltip"]];
        foreach ($lista as $i => $a) {
            $lista_grafico[] = [($Mes?$a['dia']:$a['mes_desc']),floatval($a['valor']),"Total: R$ ".number_format($a['valor'], 2,",",".")."\nVeículos: {$a['qtd_veiculos']}"];
            
        }
        echo json_encode($lista_grafico);
    }

    function teste()
    {
        //Se for fomatar(pra exibir) a moeda pelo back end
        $valor_do_banco = '{"valor": 5.66667, "minutos": 85, "tempoDesc": "1Hrs e 25 Min", "liberaPagarAdiantado": "N"}';
        $obj = json_decode($valor_do_banco,true);
        $obj['valorBr'] = number_format(floatval($obj['valor']), 2,",",".");
        echo json_encode($obj);

        //Se for fomatar(pra exibir) a moeda pelo front end
        $valor_do_banco = '{"valor": 5.66667, "minutos": 85, "tempoDesc": "1Hrs e 25 Min", "liberaPagarAdiantado": "N"}';
        echo $valor_do_banco;
    }
}
