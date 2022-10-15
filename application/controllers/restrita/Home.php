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

        $lista = $this->Home_model->getMesEmpresas();

        $lista_grafico[] = ["Element", "Qtd. Cadastros (R$)", ['type'=> "string", 'role'=> "tooltip"]];
        foreach ($lista as $i => $a) {
            $mes_desc = $this->funcoes->getMeses($a['mes']);
            $lista_grafico[] = [$mes_desc,(int) $a['qtd'],"Qtd. Cadastros: ".$a['qtd']];
            
        }
        echo json_encode($lista_grafico);
    }

    public function teste()
    {
        $email = utf8_encode(base64_decode($_GET['email']));
        $nome = utf8_encode(base64_decode($_GET['nome']));
        $assunto = utf8_encode(base64_decode($_GET['assunto']));
        $mensagem = utf8_encode(base64_decode($_GET['mensagem']));

        $email_content = '
                    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                    <html xmlns="http://www.w3.org/1999/xhtml">
                        <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                            <title>Demystifying Email Design</title>
                            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                            <html xmlns="http://www.w3.org/1999/xhtml">
                            <style>
                                body{
                                    font-family: "Courier New"
                                    , Courier;
                                }
                            </style>
                        </head>

                        <body style="width:100%;margin:0px;font-family: Courier New, Courier;">
                        <div style="font-size: 16px;line-height: 1.42857143;color: #777;">
                        <div class="bs-callout-default" style="width:80%;padding: 20px;margin: 20px 0;border: 1px solid #eee;border-left-color: #269abc;border-left-width: 5px;border-radius: 3px;">
                            <h3 style="text-align:center;">
                                Você recebeu uma mensagem através do formulário do site
                            </h3>
                            <span>
                                <b>Nome: </b>'.$nome.'<br>
                                <b>Email: </b>'.$email .'<br>
                                <b>Assunto: </b>'.$assunto.'<br>
                                <b>Mensagem: </b>'.$mensagem.'<br>
                            </span>
                        </div>
                    </div>
                    </body>
                </html>'; 
            echo $email_content;
    }

}
