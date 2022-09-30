<?php

class DiasAtendimento_model extends CI_Model {

    public function getDiasAtendimento()
    {
        $sql = "SELECT DiasAtendimentoId
                        ,DescricaoDiasAtendimento AS Descricao 
                FROM DiasAtendimento
                ORDER BY DiasAtendimentoId ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    public function setDiasAtendimento($data,$DiasAtendimentoId)
    {
        if($DiasAtendimentoId){
            $this->db->where('DiasAtendimentoId',$DiasAtendimentoId);
            $this->db->update('DiasAtendimento',$data);
        }else{
            $this->db->insert('DiasAtendimento',$data);
        }
    }
}

?>