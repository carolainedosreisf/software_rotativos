<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagamentos extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
		$this->Login_model->verificaSessao();

        if($this->session->userdata('PermissaoId')!=2){
            $link = base_url('index.php/Restrita/Home');
			echo "<script>window.location.href = '$link'</script>";
        }
        
        $this->load->model('Pagamentos_model');
    }

    public function index()
    {
        $data['controller'] = "pagamentosController";
		$this->load->view('restrita/header',$data);
		$this->load->view('restrita/pagamentos');
		$this->load->view('restrita/footer');
    }

    public function getVerificaPagamento()
    {
        $obj = $this->Pagamentos_model->getVerificaPagamento();
        echo json_encode($obj);
    }

    public function setPagamento()
    {
        $post = $this->funcoes->getPostAngular();
        $obj = $this->Pagamentos_model->getVerificaPagamento();

        $data_carteira = [
            'EmpresaId'=>$this->session->userdata('EmpresaId'),
        ];

        if($post['TipoCartao']=='P'){
            $data_carteira +=[
                'CodigoPix'=>$post['CodigoPix']
            ];
        }else{
            $data_carteira +=[
                'TipoCartao'=>$post['TipoCartao'],
                'NumeroCartao'=>$post['NumeroCartao'],
                'NomeCartao'=>$post['NomeCartao'],
                'DataExpiracaoCartao'=>str_replace('/','',$post['DataExpiracaoCartao']),
                'CodigoSegurancaoCartao'=>$post['CodigoSegurancaoCartao']
            ];
        }

        $CarteiraId = $this->Pagamentos_model->setCarteira($data_carteira);

        $data_atual = Date('Y-m-d');
        $data_receber = [
            'EmpresaId'=>$this->session->userdata('EmpresaId'),
            'FormaPagamentoId'=>5,
            'CarteiraId'=>$CarteiraId,
            'DataPagamento' =>$data_atual,
            'DataConsiderar'=>$obj['VencUltPagamento']>$data_atual?$obj['VencUltPagamento']:$data_atual,
            'Valor'=>25,
            'Status'=>'F'
        ];

        $this->Pagamentos_model->setPagamento($data_receber);
    }

}