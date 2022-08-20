<?php

class Login_model extends CI_Model {

    public function setLogin($data)
    {
        $this->db->insert('Login',$data);
    }

    public function getValidaNomeLogin($nome_usuario)
    {
        $sql = "SELECT 1 FROM Login WHERE NomeUsuario = '{$nome_usuario}'";
        $query = $this->db->query($sql);
        $result = $query->num_rows();
        return $result;
    }
}

?>