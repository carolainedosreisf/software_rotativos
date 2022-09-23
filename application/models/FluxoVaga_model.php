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
        $sql = "SELECT  
                    a.FluxoVagaId
                    ,a.DataEntrada
                    ,DATE_FORMAT(a.DataEntrada, '%d/%m/%Y') AS DataEntradaBr
                    ,a.DataSaida
                    ,DATE_FORMAT(a.DataSaida, '%d/%m/%Y') AS DataSaidaBr
                    ,a.HoraEntrada
                    ,DATE_FORMAT(a.HoraEntrada, '%H:%i') AS HoraEntradaBr
                    ,a.HoraSaida
                    ,DATE_FORMAT(a.HoraSaida, '%H:%i') AS HoraSaidaBr
                    ,a.CadastroId
                    ,(SELECT c.Nome 
                        FROM Cadastro AS c
                        WHERE a.CadastroId = c.CadastroId) NomeCliente
                    ,a.PlacaVeiculo
                    ,a.Observacao
                    ,a.EstacionamentoId
                    ,(SELECT c.NomeEstacionamento 
                        FROM Estacionamento AS c
                        WHERE a.EstacionamentoId = c.EstacionamentoId) NomeEstacionamento
                    ,(SELECT c.CpfCnpj 
                        FROM Estacionamento AS c
                        WHERE a.EstacionamentoId = c.EstacionamentoId) CpfCnpjEstacionamento
                    ,a.Reserva
                    ,IF(b.ReceberId IS NULL,'A','F') AS Status
                    ,b.ReceberId
                    ,b.Valor
                    ,(SELECT c.Descricao 
                        FROM FormaPagamento AS c
                        WHERE b.FormaPagamentoId = c.FormaPagamentoId) FormaPagamentoDesc
                FROM Fluxovaga AS a
                LEFT JOIN Receber b ON a.FluxoVagaId = b.FluxoVagaId";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
}



?>