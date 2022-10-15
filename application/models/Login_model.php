<?php

class Login_model extends CI_Model {

    public function verificaSessao()
	{
		if(!($this->session->userdata('EstacionamentoId')) && $this->session->userdata('PermissaoId')!=1){
			$link = base_url('index.php/Login');
			echo "<script>window.location.href = '$link'</script>";
		}
	}
    
    public function setLogin($data,$LoginId=0)
    {
        if($LoginId){
            $this->db->where('LoginId', $LoginId);
            $this->db->update('Login',$data);
        }else{
            $this->db->insert('Login',$data);
            $last_id = $this->db->insert_id();
            return $last_id;
        }
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
        $sql = "SELECT 
                        EstacionamentoId
                        ,a.EmpresaId
                        ,PermissaoId
                        ,(SELECT nome FROM Empresa AS b WHERE b.EmpresaId = a.EmpresaId) AS NomeEmpresa
                    FROM Login AS a
                    WHERE NomeUsuario = '{$NomeUsuario}' 
                    AND Senha = '{$Senha}' 
                    AND PermissaoId IN(1,2,3) 
                    AND Status = 'A'";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
    }

    public function getLogin($LoginId)
    {
        $sql = "SELECT EstacionamentoId,PermissaoId,TokenEmail
                    FROM Login 
                    WHERE LoginId = {$LoginId}
                    AND Status = 'A'";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
    }
}

?>