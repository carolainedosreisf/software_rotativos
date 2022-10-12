<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PerfilEmpresa extends CI_Controller {

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
        $data['controller'] = "perfilEmpresaController";
		$this->load->view('restrita/header',$data);
		$this->load->view('restrita/perfilEmpresa');
		$this->load->view('restrita/footer');
    }

    public function getEmpresa()
    {
        $EmpresaId = $this->session->userdata('EmpresaId');
        $obj = $this->Empresa_model->getEmpresa($EmpresaId);
        echo json_encode($obj);
    }

    public function setEmpresa()
    {
        $post = $this->funcoes->getPostAngular();

        $data = [
            'Nome' => $post['Nome'],
            'RazaoSocial' => $post['RazaoSocial'],
            'Sobre' => $post['Sobre'],
            'NumeroEndereco' => $post['NumeroEndereco'],
            'complemento' => isset($post['complemento'])?$post['complemento']:null,
            'NumeroCep' => $post['NumeroCep'],
            'CidadeId' =>$post['CidadeId'],
            'BairroEndereco' => $post['BairroEndereco'],
            'NumeroTelefone1' => $post['NumeroTelefone1'],
            'NumeroTelefone2' => isset($post['NumeroTelefone2'])?$post['NumeroTelefone2']:null,
            'Email' => $post['Email']
        ];

        $this->Empresa_model->setEmpresa($data,$post['EmpresaId']);
    }
}