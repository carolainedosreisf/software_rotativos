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
            $filtro .= " AND IF(b.ReceberId IS NULL,'B',b.Status) = '{$params['Status']}'";
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
                    ,IF(b.ReceberId IS NULL,'B',b.Status) AS Status
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
                    ,IF(b.ReceberId IS NULL,'B',b.Status) AS Status
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

    public function getClientes()
    {
        $sql = "SELECT  
                    a.CadastroId
                    ,a.Cpf
                    ,a.Nome
                    ,a.NumeroTelefone
                    ,a.NumeroCelular
                FROM Cadastro AS a
                ORDER BY a.Nome ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    public function setReserva($data,$ReservaId=0)
    {
        if($ReservaId){
            $this->db->where('ReservaId', $ReservaId);
            $this->db->update('Reserva',$data);
        }else{
            $this->db->insert('Reserva',$data);
            $last_id = $this->db->insert_id();
            return $last_id;
        }
    }

    public function setCliente($data,$CadastroId=0)
    {
        if($CadastroId){
            $this->db->where('CadastroId', $CadastroId);
            $this->db->update('Cadastro',$data);
        }else{
            $this->db->insert('Cadastro',$data);
            $last_id = $this->db->insert_id();
            return $last_id;
        }
    }

    public function getReservas()
    {
        $sql = "SELECT  
                    a.ReservaId
                    ,DATE_FORMAT(a.DataEntrada, '%d/%m/%Y') AS DataEntradaBr
                    ,DATE_FORMAT(a.DataSaida, '%d/%m/%Y') AS DataSaidaBr
                    ,DATE_FORMAT(a.HoraEntrada, '%H:%i') AS HoraEntradaBr
                    ,DATE_FORMAT(a.HoraSaida, '%H:%i') AS HoraSaidaBr
                    ,a.CadastroId
                    ,f.Nome AS NomeCliente
                    ,f.Cpf AS CpfCliente
                    ,f.NumeroTelefone AS TelefoneCliente
                    ,a.EstacionamentoId
                    ,(SELECT e.NomeEstacionamento 
                        FROM Estacionamento AS e
                        WHERE a.EstacionamentoId = e.EstacionamentoId) NomeEstacionamento
                    ,(SELECT e.CpfCnpj 
                        FROM Estacionamento AS e
                        WHERE a.EstacionamentoId = e.EstacionamentoId) CpfCnpjEstacionamento
                    ,IF(b.ReceberId IS NULL,'B',b.Status) AS StatusReserva
                    ,b.Valor AS ValorReserva
                    ,(SELECT e.Descricao 
                        FROM FormaPagamento AS e
                        WHERE b.FormaPagamentoId = e.FormaPagamentoId) FormaPagamentoReservaDesc
                    ,DATE_FORMAT(c.DataEntrada, '%d/%m/%Y') AS DataEntradaFluxoBr
                    ,DATE_FORMAT(c.DataSaida, '%d/%m/%Y') AS DataSaidaFluxoBr
                    ,DATE_FORMAT(c.HoraEntrada, '%H:%i') AS HoraEntradaFluxoBr
                    ,DATE_FORMAT(c.HoraSaida, '%H:%i') AS HoraSaidaFluxoBr
                    ,IF(d.ReceberId IS NULL,'B',d.Status) AS StatusFluxo
                    ,d.Valor AS ValorFluxo
                    ,(SELECT e.Descricao 
                        FROM FormaPagamento AS e
                        WHERE d.FormaPagamentoId = e.FormaPagamentoId) FormaPagamentoFluxoDesc
                FROM Reserva AS a
                LEFT JOIN Receber b ON a.ReservaId = b.ReservaId
                LEFT JOIN FluxoVaga  c ON a.ReservaId = c.ReservaId
                LEFT JOIN Receber d ON c.FluxoVagaId = d.FluxoVagaId
                LEFT JOIN Cadastro f ON a.CadastroId = f.CadastroId
                WHERE (SELECT EmpresaId 
                        FROM Estacionamento AS e
                        WHERE a.EstacionamentoId = e.EstacionamentoId) = {$this->session->userdata('EmpresaId')}
                ORDER BY  a.DataEntrada DESC,a.HoraEntrada DESC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    
}



?>