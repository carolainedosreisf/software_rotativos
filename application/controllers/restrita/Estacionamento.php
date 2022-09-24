<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estacionamento extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
		$this->Login_model->verificaSessao();
        $this->load->model('Empresa_model');
        $this->load->model('Estacionamento_model');
    }

	public function index()
    {
		$data['controller'] = "estacionamentosController";
		$this->load->view('restrita/header',$data);
		$this->load->view('restrita/estacionamentos');
		$this->load->view('restrita/footer');
	}

    public function getEstacionamentos()
    {
        $EmpresaId = $this->session->userdata('EmpresaId');
        $ComPreco = $this->funcoes->get('ComPreco');
        $data['lista'] = $this->Estacionamento_model->getEstacionamento(null,$EmpresaId,null,null,$ComPreco);
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

    public function novoEstacionamento()
    {
		$data['controller'] = "novoEstacionamentoController";
        $data['EstacionamentoId'] = base64_decode($this->funcoes->get('i'));
		$this->load->view('restrita/header',$data);
		$this->load->view('restrita/novoEstacionamento');
		$this->load->view('restrita/footer');
	}

    public function getEstacionamento()
    {
        $EstacionamentoId = $this->funcoes->get('EstacionamentoId');
        $obj = $this->Estacionamento_model->getEstacionamento($EstacionamentoId);
        echo json_encode($obj);
    }

    public function getEmpresa()
    {
        $EmpresaId = $this->session->userdata('EmpresaId');
        $obj = $this->Empresa_model->getEmpresa($EmpresaId);
        $data = [
            'Nome'=>$obj['Nome'],
            'TipoEmpresa'=>$obj['TipoEmpresa'],
            'UrlLogo'=>$obj['UrlLogo'],
            'NomeEstacionamento'=>$obj['Nome']
        ];
        echo json_encode($data);
    }

    public function setEstacionamento()
    {
		$post = $this->funcoes->getPostAngular();
        $EstacionamentoId = isset($post['EstacionamentoId'])?$post['EstacionamentoId']:0;

        $data = [
            'Endereco' => $post['Endereco'],
            'NumeroEndereco' => $post['NumeroEndereco'],
            'complemento' => isset($post['complemento'])?$post['complemento']:null,
            'NumeroCep' => $post['NumeroCep'],
            'CidadeId' =>$post['CidadeId'],
            'BairroEndereco' => $post['BairroEndereco'],
            'NumeroTelefone1' => $post['NumeroTelefone1'],
            'NumeroTelefone2' => isset($post['NumeroTelefone2'])?$post['NumeroTelefone2']:null,
            'Email' => $post['Email'],
            'NumeroVagas' => $post['NumeroVagas'],
            'Sobre' => isset($post['Sobre'])?$post['Sobre']:null,
            'NomeEstacionamento' => $post['NomeEstacionamento'],
            'PrecoLivre' => $post['PrecoLivre'],
            'PrecoHora' => $post['PrecoHora']
        ];

        if(!$EstacionamentoId){
            $data += [
                'CpfCnpj'=>$post['CpfCnpj'],
                'EmpresaId'=>$this->session->userdata('EmpresaId'),
            ];
        }

        $this->Estacionamento_model->setEstacionamento($data,$EstacionamentoId);

    }

    public function listaFotos()
    {
        $data['controller'] = "fotosEstacionamentoController";
        $data['EstacionamentoId'] = base64_decode($this->funcoes->get('i'));
		$this->load->view('restrita/header',$data);
		$this->load->view('restrita/fotosEstacionamento');
		$this->load->view('restrita/footer');
    }

    public function getFotos()
    {
        $EstacionamentoId = $this->funcoes->get('EstacionamentoId');
        $lista = $this->Estacionamento_model->getFotos($EstacionamentoId);
        echo json_encode($lista);
    }

    public function setFoto()
    {
        $EstacionamentoId = $this->funcoes->get('EstacionamentoId');

        if(!empty($_FILES)){  
            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $exts = ['PNG','png','jpeg','jfif','jpg','JPEG','JPG'];
            if(array_search($ext,$exts)===false){
                echo json_encode(['erro_tipo'=>1]);
                exit;
            }
            $nome_imagem = (rand() * rand()).date("YmdHi").'.'.$ext;
            $path = UPLOAD_ARQUIVOS."/estacionamentos/{$nome_imagem}"; 
    
            if(move_uploaded_file($_FILES['file']['tmp_name'], $path)){  
                $insert = [
                    'EstacionamentoId' => $EstacionamentoId,
                    'UrlFoto' => "/estacionamentos/{$nome_imagem}" 
                ];
                $this->Estacionamento_model->setFoto($insert);
                echo 1;
            } else{
                echo 0;
            }
        }  
        else{  
            echo 0;  
        }  
    }

    public function excluirFoto()
    {
        $dados = $this->funcoes->getPostAngular();
        $this->Estacionamento_model->excluirFoto($dados['FotoEstacionamentoId']);
        unlink(UPLOAD_ARQUIVOS.$dados['UrlFoto']);
    }

    public function listaAtendentes()
    {
        $data['controller'] = "atendentesEstacionamentoController";
        $data['EstacionamentoId'] = base64_decode($this->funcoes->get('i'));
		$this->load->view('restrita/header',$data);
		$this->load->view('restrita/atendentesEstacionamento');
		$this->load->view('restrita/footer');
    }

    public function getAtendentes()
    {
        $EstacionamentoId = $this->funcoes->get('EstacionamentoId');
        $Status = $this->funcoes->get('Status');
        $lista = $this->Estacionamento_model->getAtendentes($EstacionamentoId,$Status);
        echo json_encode($lista);
    }

    public function acaoUsuario()
    {
        $dados = $this->funcoes->getPostAngular();
        $data = ['Status'=>($dados['Status']=='A'?'I':'A')];
        $this->Login_model->setLogin($data,$dados['LoginId']);
    }

    public function setAtendente()
    {

        $dados = $this->funcoes->getPostAngular();

        $erro_1 = $this->Login_model->getValidaNomeLogin($dados['NomeUsuario']);
        $erro_2 = $this->Login_model->getValidaEmail($dados['Email']);
        $lista_erros = [];

        if($erro_1>0){
            $lista_erros[] = "Este Nome Usuário já esta sendo utilizado, favor digite outro.";
        }

        if($erro_2>0){
            $lista_erros[] = "Este e-mail já esta cadastrado em nossa base de dados.";
        }

        if(count($lista_erros)>0){
            echo json_encode(['lista_erros'=>$lista_erros]);
            exit;
        }

        $insert = [
            'NomeUsuario' => $dados['NomeUsuario'],
            'Email' => $dados['Email'],
            'EstacionamentoId' => $dados['EstacionamentoId'],
            'PermissaoId' => 3
        ];

        $LoginId = $this->Login_model->setLogin($insert);
        $this->gerarToken($LoginId);
    }

    public function gerarToken($LoginId)
    {
        $token = (bin2hex(random_bytes(12))).'_'.Date('Y-m-d-H-i');
        $token_code =base64_encode($token);

        $data = ['TokenEmail' => $token];
        $this->Login_model->setLogin($data,$LoginId);

        echo json_encode([
            'token_code'=>$token_code
            ,'LoginId'=>$LoginId
            ,'lista_erros'=>[]
        ]);

    }

}