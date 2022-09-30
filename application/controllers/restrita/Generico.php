<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generico extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
		$this->Login_model->verificaSessao();
    }

    public function getEstacionamentos()
    {
        $EmpresaId = $this->funcoes->get('EmpresaId')?$this->funcoes->get('EmpresaId'):$this->session->userdata('EmpresaId');
        $ComPreco = $this->funcoes->get('ComPreco');

        $this->load->model('Estacionamento_model');
        $data['lista'] = $this->Estacionamento_model->getEstacionamento(null,$EmpresaId,$ComPreco);
        $data['tem_sem_preco'] = 0;

        foreach ($data['lista'] as $i => $a) {
            if($a['PrecoHora']<=0 && $a['PrecoLivre']<=0){
                $data['tem_sem_preco'] = 1;
            }
            $data['lista'][$i]['CpfCnpjFormatado'] = $this->funcoes->formatar_cpf_cnpj($a['CpfCnpj']);
            $data['lista'][$i]['NumeroTelefone1Formatado'] = $this->funcoes->formatar_telefone($a['NumeroTelefone1']);
            $data['lista'][$i]['NumeroTelefone2Formatado'] = $this->funcoes->formatar_telefone($a['NumeroTelefone2']);
        }

        echo json_encode($data);
    }

    public function getPagamentos()
    {
        $EmpresaId = $this->funcoes->get('EmpresaId')?$this->funcoes->get('EmpresaId'):$this->session->userdata('EmpresaId');
        $this->load->model('Pagamentos_model');
        $lista = $this->Pagamentos_model->getPagamentos($EmpresaId);
        foreach ($lista as $i => $a) {
            $lista[$i]['StatusDesc'] = $this->funcoes->getStatusClasse($a['Status'],'S');
            $lista[$i]['ClassBtn'] = $this->funcoes->getStatusClasse($a['Status'],'C');
        }
        echo json_encode($lista);
    }

    public function getFormasPagamento()
	{
		$todos = $this->funcoes->get('todos');
        $this->load->model('FormaPagamento_model');
		$lista = $this->FormaPagamento_model->getFormasPagamento($todos);
		echo json_encode($lista);
	}

    public function getDiasAtendimento()
	{
        $this->load->model('DiasAtendimento_model');
		$lista = $this->DiasAtendimento_model->getDiasAtendimento();
		echo json_encode($lista);
	}
}