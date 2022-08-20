<?php

class Empresa_model extends CI_Model {

    public function setEmpresa($data)
    {
        $this->db->insert('Empresa',$data);
    }

    public function getValidaCpfCnpj($CpfCnpj)
    {
        $sql = "SELECT 1 FROM Empresa WHERE CpfCnpj = '{$CpfCnpj}'";
        $query = $this->db->query($sql);
        $result = $query->num_rows();
        return $result;
    }
}

?>