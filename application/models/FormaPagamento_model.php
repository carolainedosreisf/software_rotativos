<?php

class FormaPagamento_model extends CI_Model {

    public function getFormasPagamento()
    {
        $sql = "SELECT FormaPagamentoId
                        ,Descricao 
                FROM FormaPagamento 
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