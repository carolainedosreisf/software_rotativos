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
        $data['lista_meses'] = $this->funcoes->getMeses();
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
            $mes_desc = $Mes?'':$this->funcoes->getMeses($a['mes']);
            $lista_grafico[] = [($Mes?$a['dia']:$mes_desc),floatval($a['valor']),"Total: R$ ".number_format($a['valor'], 2,",",".")."\nVeículos: {$a['qtd_veiculos']}"];
            
        }
        echo json_encode($lista_grafico);
    }

    public function getDadosGraficoEmpresas()
    {
        $Ano = $this->funcoes->get('Ano');

        $lista = $this->Home_model->getMesEmpresas($Ano);

        $lista_grafico[] = ["Element", "Qtd. Cadastros (R$)", ['type'=> "string", 'role'=> "tooltip"]];
        foreach ($lista as $i => $a) {
            $mes_desc = $this->funcoes->getMeses($a['mes']);
            $lista_grafico[] = [$mes_desc,(int) $a['qtd'],"Qtd. Cadastros: ".$a['qtd']];
            
        }
        echo json_encode($lista_grafico);
    }

}
