<?php

class Login_model extends CI_Model {

    public function verificaSessao()
	{
		if(!($this->session->userdata('login_empresa'))){
			$link = base_url('index.php/Login');
			echo "<script>window.location.href = '$link'</script>";
		}
	}
    
    public function setLogin($data)
    {
        $this->db->insert('Login',$data);
    }

    public function getValidaNomeLogin($NomeUsuario)
    {
        $sql = "SELECT 1 FROM Login WHERE NomeUsuario = '{$NomeUsuario}'";
        $query = $this->db->query($sql);
        $result = $query->num_rows();
        return $result;
    }

    public function getValidaEmail($Email)
    {
        $sql = "SELECT 1 FROM Login WHERE Email = '{$Email}'";
        $query = $this->db->query($sql);
        $result = $query->num_rows();
        return $result;
    }

    public function getValidaAcesso($NomeUsuario,$Senha)
    {
        $sql = "SELECT CadastroId
                    FROM Login 
                    WHERE NomeUsuario = '{$NomeUsuario}' 
                    AND Senha = '{$Senha}' 
                    AND PermissaoId = 2";
        $query = $this->db->query($sql);
        $result = $query->num_rows()>0?$query->row('CadastroId'):0;
        return $result;
    }
}

?>