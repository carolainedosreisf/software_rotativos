<?php

class FormaPagamento_model extends CI_Model {

    public function getFormasPagamento($todos='')
    {
        $filtro = "";
        if(!$todos){
            $filtro .= " AND FormaPagamentoId NOT IN(5)";
        }
        $sql = "SELECT FormaPagamentoId
                        ,Descricao 
                FROM FormaPagamento 
                WHERE 1=1
                {$filtro}
                ORDER BY FormaPagamentoId ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    public function setFormaPagamento($data,$FormaPagamentoId)
    {
        if($FormaPagamentoId){
            $this->db->where('FormaPagamentoId',$FormaPagamentoId);
            $this->db->update('FormaPagamento',$data);
        }else{
            $this->db->insert('FormaPagamento',$data);
        }
    }
}

?>