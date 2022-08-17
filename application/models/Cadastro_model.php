<?php

class Cadastro_model extends CI_Model {

    public function setCadastro($data)
    {
        $this->db->insert('cadastro',$data);
    }

    public function getCidades($descricao)
    {
        $filtro = "";
        if($descricao){
            $filtro .= " WHERE NomeCidade LIKE('%{$descricao}%')";
        }

        $sql = "SELECT CidadeId
                        ,NomeCidade 
                FROM cidade 
                {$filtro}
                ORDER BY NomeCidade ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    public function getUltimoCadastro()
    {
        $sql = "SELECT IFNULL((max(CadastroId)+1),1) AS id FROM cadastro";
        $query = $this->db->query($sql);
        $result = $query->row()->id;
        return $result;
    }
}

?>