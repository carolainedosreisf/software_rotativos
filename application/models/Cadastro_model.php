<?php

class Cadastro_model extends CI_Model {

    public function setCadastro($data)
    {
        $this->db->insert('Cadastro',$data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    public function getCidades($descricao)
    {
        $filtro = "";
        if($descricao){
            $filtro .= " WHERE NomeCidade LIKE('%{$descricao}%')";
        }

        $sql = "SELECT CidadeId
                        ,NomeCidade 
                        ,Estado
                FROM Cidade 
                {$filtro}
                ORDER BY NomeCidade ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
}

?>