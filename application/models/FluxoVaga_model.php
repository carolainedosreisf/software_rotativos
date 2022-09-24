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

    public function getFluxoVagas($params,$order=1)
    {
        $filtro = "";
        if($params['EstacionamentoId']){
            $filtro .= " AND a.EstacionamentoId = {$params['EstacionamentoId']}";
        }

        if($params['DataInicio'] && $params['DataFim']){
            $DataInicio = $this->funcoes->formataData($params['DataInicio']);
            $DataFim = $this->funcoes->formataData($params['DataFim']);
            $filtro .= " AND a.DataEntrada BETWEEN '{$DataInicio}' AND '{$DataFim}'";
        }

        if($params['Status']){
            $filtro .= " AND IF(b.ReceberId IS NULL,'A','F') = '{$params['Status']}'";
        }

        if($params['FormaPagamentoId']){
            $filtro .= " AND b.FormaPagamentoId = {$params['FormaPagamentoId']}";
        }
        $order_by = $order==1?'Status ASC':'NomeEstacionamento ASC';

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
                LEFT JOIN Receber b ON a.FluxoVagaId = b.FluxoVagaId
                WHERE (SELECT EmpresaId 
                        FROM Estacionamento AS c 
                        WHERE a.EstacionamentoId = c.EstacionamentoId) = {$this->session->userdata('EmpresaId')}
                {$filtro}
                ORDER BY {$order_by}, DataEntrada DESC,HoraEntrada DESC ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    public function getFluxoVaga($FluxoVagaId)
    {
        $sql = "SELECT  
                    a.FluxoVagaId
                    ,DATE_FORMAT(a.DataEntrada, '%d/%m/%Y') AS DataEntrada
                    ,DATE_FORMAT(a.DataSaida, '%d/%m/%Y') AS DataSaida
                    ,DATE_FORMAT(a.HoraEntrada, '%H%i') AS HoraEntrada
                    ,DATE_FORMAT(a.HoraSaida, '%H%i') AS HoraSaida
                    ,a.CadastroId
                    ,a.PlacaVeiculo
                    ,a.Observacao
                    ,a.EstacionamentoId
                    ,IF(b.ReceberId IS NULL,'A','F') AS Status
                    ,b.Valor
                    ,(SELECT c.Descricao 
                        FROM FormaPagamento AS c
                        WHERE b.FormaPagamentoId = c.FormaPagamentoId) FormaPagamentoDesc
                FROM Fluxovaga AS a
                LEFT JOIN Receber b ON a.FluxoVagaId = b.FluxoVagaId
                WHERE a.FluxoVagaId = {$FluxoVagaId}";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
    }

    public function seReceber($data,$ReceberId=0)
    {
        if($ReceberId){
            $this->db->where('ReceberId', $ReceberId);
            $this->db->update('Receber',$data);
        }else{
            $this->db->insert('Receber',$data);
            $last_id = $this->db->insert_id();
            return $last_id;
        }
    }
}



?>