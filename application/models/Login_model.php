<?php

class Login_model extends CI_Model {

    public function setLogin($data)
    {
        $this->db->insert('login',$data);
    }

    public function getValidaNomeLogin($nome_usuario)
    {
        $sql = "SELECT 1 AS id FROM login WHERE NomeUsuario = '{$nome_usuario}'";
        $query = $this->db->query($sql);
        $result = $query->num_rows();
        return $result;
    }

    public function getUltimoLogin()
    {
        $sql = "SELECT IFNULL((max(LoginId)+1),1) AS id FROM login";
        $query = $this->db->query($sql);
        $result = $query->row()->id;
        return $result;
    }
}

?>