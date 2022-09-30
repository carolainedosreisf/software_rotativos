<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
		$this->Login_model->verificaSessao();

        if($this->session->userdata('PermissaoId')!=1){
            $link = base_url('index.php/Restrita/Home');
			echo "<script>window.location.href = '$link'</script>";
        }

        $this->load->model('Empresa_model');
    }

    public function index()
    {
        $data['controller'] = "clientesController";
		$this->load->view('restrita/header',$data);
		$this->load->view('restrita/clientes');
		$this->load->view('restrita/footer');
    }

    public function getClientes()
    {
        $lista = $this->Empresa_model->getEmpresas();
        foreach ($lista as $i => $a) {
            $lista[$i]['CpfCnpjFormatado'] = $this->funcoes->formatar_cpf_cnpj($a['CpfCnpj']);
        }
        echo json_encode($lista);
    }

    public function relatorio()
    {
        if($this->session->userdata('PermissaoId')!=1){ 
            exit;
        }
        $lista = $this->Empresa_model->getEmpresas();

        foreach ($lista as $i => $a) {
            $lista[$i]['CpfCnpjFormatado'] = $this->funcoes->formatar_cpf_cnpj($a['CpfCnpj']);
        }

        $data['titulo'] = 'Clientes';
        $data['lista'] = $lista;

        $html = $this->load->view('restrita/relatorioClientes',$data,true);
        $this->funcoes->gerarPdf($html);
    }
}
