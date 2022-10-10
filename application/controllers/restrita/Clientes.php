<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Pagamentos_model');
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
        $situacao_pagamento = $this->funcoes->get('situacao_pagamento');
        $situacao_software = $this->funcoes->get('situacao_software');
        $lista = $this->Empresa_model->getEmpresas($situacao_pagamento,$situacao_software);
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
        $situacao_pagamento = base64_decode($this->funcoes->get('p'));
        $situacao_software = base64_decode($this->funcoes->get('s'));
        $lista = $this->Empresa_model->getEmpresas($situacao_pagamento,$situacao_software);

        foreach ($lista as $i => $a) {
            $lista[$i]['CpfCnpjFormatado'] = $this->funcoes->formatar_cpf_cnpj($a['CpfCnpj']);
        }

        $data['titulo'] = 'Clientes';
        $data['lista'] = $lista;

        $html = $this->load->view('restrita/relatorioClientes',$data,true);
        $this->funcoes->gerarPdf($html);
    }

    public function setPagamento()
    {
        $post = $this->funcoes->getPostAngular();

        $data= [
            'EmpresaId'=>$post['EmpresaId'],
            'FormaPagamentoId'=>$post['FormaPagamentoId'],
            'DataPagamento' =>$post['Agora'],
            'DataVencimento'=>$post['ProxVencimento'],
            'Valor'=>VALOR_SOFTWARE,
            'Status'=>'F'
        ];

        $this->Pagamentos_model->setPagamento($data);
    }
}
