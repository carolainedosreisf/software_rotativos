<?php

class FluxoVaga_model extends CI_Model {

    public function setFluxoVaga($data,$FluxoVagaId=0)
    {
        if($FluxoVagaId){
            $this->db->where('FluxoVagaId', $FluxoVagaId);
            $this->db->update('FluxoVaga',$data);
        }else{
            $this->db->insert('FluxoVaga',$data);
            $last_id = $this->db->insert_id();
            return $last_id;
        }
        
    }

    public function getFluxoVagas()
    {
        $sql = "";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
}



?>