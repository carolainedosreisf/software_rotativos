<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Empresa_model');
        $this->load->model('Estacionamento_model');
    }

	public function index()
	{
		$data['EmpresaSoftware'] = $this->funcoes->getEmpresaSoftware();
		$data['controller'] = "loginController";
		$this->load->view('header',$data);
		$this->load->view('login');
		$this->load->view('footer');
	}

	public function getValidaAcesso()
	{
		$post = $this->funcoes->getPostAngular();
		$NomeUsuario = $post['NomeUsuario'];
		$Senha = MD5($post['Senha']);

        $login = $this->Login_model->getValidaAcesso($NomeUsuario,$Senha);

		if(!$login){
			echo 0;
			exit;
		}
		if($login['EstacionamentoId']){
			$estacionamento = $this->Estacionamento_model->getEstacionamento($login['EstacionamentoId']);
		}
		
		$sessao= [
			'EstacionamentoId' => $login['EstacionamentoId'],
			'PermissaoId' => $login['PermissaoId'],
			'TempoInatividadeSessao' => strtotime(date("Y-m-d H:i:s")."+30 minutes")
		];
		
		if(isset($estacionamento)){
			$sessao +=[
				'nome' => $estacionamento['Nome'],
				'CpfCnpj' => $estacionamento['CpfCnpj'],
				'TipoEmpresa' => $estacionamento['TipoEmpresa'],
				'EmpresaId' => $estacionamento['EmpresaId'],
				'DataCadastro' => $estacionamento['DataCadastro']
			];
		}else{
			$sessao +=[
				'EmpresaId' => $login['EmpresaId']
				,'nome' => $login['NomeEmpresa']
			];
		}

		
		$this->session->set_userdata($sessao);
		echo 1;
	}

	public function sair()
	{
		$this->session->sess_destroy();
		$link = base_url('index.php/Login');
		echo "<script>window.location.href = '$link'</script>";
	}

	public function gerarToken()
    {
		$Email = $this->funcoes->get('Email');
		$Login = $this->Login_model->getLogin(0,$Email);

		if(!isset($Login['LoginId'])){
			echo json_encode(['erro'=>1]);
		}elseif($Login['Status']!='A'){
			echo json_encode(['erro'=>2]);
		}else{
			$token = (bin2hex(random_bytes(12))).'_'.Date('Y-m-d-H-i');
			$token_code =base64_encode($token);
			$data = ['TokenEmail' => $token];
			$this->Login_model->setLogin($data,$Login['LoginId']);
	
			echo json_encode([
				'token_code'=>$token_code
				,'PermissaoId'=>$Login['PermissaoId']
				,'Email'=>$Login['Email']
				,'LoginId'=>$Login['LoginId']
				,'NomeEstacionamento'=>$Login['NomeEstacionamento']
				,'erro'=>0
			]);
		}
    }

	public function novaSenha()
	{
		$data['EmpresaSoftware'] = $this->funcoes->getEmpresaSoftware();
		$data['LoginId'] = base64_decode($this->funcoes->get('i'));
		$data['token'] = base64_decode($this->funcoes->get('t'));

		$LoginId = $data['LoginId'];
		$token = $data['token'];
		$data_ = isset(explode('_',$token)[1])?explode('_',$token)[1]:'';
		$data['retorno'] = 3;

		if($LoginId && $token && $data){
			$login = $this->Login_model->getLogin($LoginId);
			if(isset($login['TokenEmail'])){
				if($token==$login['TokenEmail']){
					$data_ = explode('-',$data_);
					if(count($data_) == 5){
						$data_format = $data_[0].'-'.$data_[1].'-'.$data_[2].' '.$data_[3].':'.$data_[4];
						$data_hoje = Date('Y-m-d H:i');
						$data_limite = date("Y-m-d H:i",strtotime($data_format."+1 hour"));

						if($data_hoje>$data_limite){
							$data['retorno'] = 2;
						}else{
							$data['retorno'] = 1;
						}
					}
				}
			}
		}

		$data['controller'] = "novaSenhaController";
		$this->load->view('novaSenha',$data);
		$this->load->view('footer');
	}

	public function setNovaSenha()
	{
		$post = $this->funcoes->getPostAngular();

		$data = [
			'Senha'=>md5($post['Senha'])
			,'TokenEmail'=>NULL
		];

		$this->Login_model->setLogin($data,$post['LoginId']);
	}
}
