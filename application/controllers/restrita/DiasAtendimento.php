<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DiasAtendimento extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
		$this->Login_model->verificaSessao();

		if($this->session->userdata('PermissaoId')!=2){
            $link = base_url('index.php/Restrita/Home');
			echo "<script>window.location.href = '$link'</script>";
        }

        $this->load->model('DiasAtendimento_model');
    }

	public function setDiasAtendimento()
	{
		$post = $this->funcoes->getPostAngular();

		$lista = $post['lista'];
		$EstacionamentoId = $post['EstacionamentoId'];

		foreach ($lista as $a) {
			$DiasAtendimentoId = $a['DiasAtendimentoId'];
			$data = [
				'Aberto'=>$a['Aberto']
				,'HoraEntrada'=>$a['HoraEntrada']?$this->funcoes->formataHora($a['HoraEntrada']):null
				,'HoraSaida'=>$a['HoraSaida']?$this->funcoes->formataHora($a['HoraSaida']):null
			];

			if($DiasAtendimentoId==0){
				$data += [
					'Dia'=>$a['Dia']
					,'DiaDesc'=>$a['DiaDesc']
					,'EstacionamentoId'=>(int) $EstacionamentoId
				];
			}

			$this->DiasAtendimento_model->setDiasAtendimento($data,$DiasAtendimentoId);
			
		}
		
	}
}
