<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagamentos extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
		$this->Login_model->verificaSessao();
        
        $this->load->model('Pagamentos_model');
    }

    public function index()
    {
        if($this->session->userdata('PermissaoId')!=2){
            $link = base_url('index.php/Restrita/Home');
			echo "<script>window.location.href = '$link'</script>";
        }

        $data['controller'] = "pagamentosController";
		$this->load->view('restrita/header',$data);
		$this->load->view('restrita/pagamentos');
		$this->load->view('restrita/footer');
    }

    public function getVerificaPagamento()
    {
        $Empresa = $this->funcoes->get('EmpresaId');
        $EmpresaId = $Empresa?$Empresa:$this->session->userdata('EmpresaId');
        $obj = $this->Pagamentos_model->getVerificaPagamento($EmpresaId);
        $obj['DescSituacao'] = str_replace("{ADM_OU_EMPRESA}",$Empresa?"A":"Sua",$obj['DescSituacao']);
        $explode_data = explode("-",$obj['ProxVencimento']);
        $obj['ProxVencimentoBr'] = $explode_data[2]."/".$explode_data[1]."/".$explode_data[0];
        echo json_encode($obj);
    }

}