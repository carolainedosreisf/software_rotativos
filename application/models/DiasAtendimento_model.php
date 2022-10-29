<?php

class DiasAtendimento_model extends CI_Model {

    public function getDiasAtendimento($EstacionamentoId)
    {
        $sql = "SELECT DiasAtendimentoId
                        ,EstacionamentoId
                        ,HoraEntrada
                        ,HoraSaida
                        ,DATE_FORMAT(HoraEntrada, '%H%i') AS HoraEntrada
                        ,DATE_FORMAT(HoraSaida, '%H%i') AS HoraSaida
                        ,Dia
                        ,DiaDesc
                        ,Aberto
                FROM DiasAtendimento
                WHERE EstacionamentoId = $EstacionamentoId
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