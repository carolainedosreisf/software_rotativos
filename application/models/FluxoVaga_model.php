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

        if($params['StatusFluxo']){
            $filtro .= " AND a.Status = '{$params['StatusFluxo']}'";
        }

        if($params['CadastroId']){
            $filtro .= " AND a.CadastroId = {$params['CadastroId']}";
        }

        if($params['Reservado']){
            $filtro .= " AND IF(c.ReservaId IS NOT NULL, 'S','N') = '{$params['Reservado']}'";
        }

        if($params['StatusPagamento']){
            $filtro .= " AND IF(b.ReceberId IS NULL AND d.ReceberId IS NULL,'B',IF(d.ReceberId IS NOT NULL, d.Status,b.Status)) = '{$params['StatusPagamento']}'";
        }

        if($params['FormaPagamentoId']){
            $filtro .= " AND IF(d.ReceberId IS NOT NULL, d.FormaPagamentoId,b.FormaPagamentoId) = {$params['FormaPagamentoId']}";
        }

        if($this->session->userdata('PermissaoId')==3){
            $filtro .= " AND a.EstacionamentoId = {$this->session->userdata('EstacionamentoId')}";
        }

        $order_by = $order==1?'Status ASC':'NomeEstacionamento ASC';

        $sql = "SELECT  
                    a.FluxoVagaId
                    ,a.DataEntrada AS DataEntradaDb
                    ,DATE_FORMAT(a.HoraEntrada, '%H')AS HoraEntradaDb
                    ,DATE_FORMAT(a.DataEntrada, '%d/%m/%Y') AS DataEntrada
                    ,DATE_FORMAT(a.DataSaida, '%d/%m/%Y') AS DataSaida
                    ,DATE_FORMAT(a.HoraEntrada, '%H:%i') AS HoraEntrada
                    ,DATE_FORMAT(a.HoraSaida, '%H:%i') AS HoraSaida
                    ,a.CadastroId
                    ,e.Nome AS NomeCliente
                    ,a.PlacaVeiculo
                    ,a.Observacao
                    ,a.Status AS StatusFluxo
                    ,a.EstacionamentoId
                    ,f.NomeEstacionamento
                    ,f.CpfCnpj AS CpfCnpjEstacionamento
                    ,IF(b.ReceberId IS NULL AND d.ReceberId IS NULL,'B',IF(d.ReceberId IS NOT NULL, d.Status,b.Status)) AS Status
                    ,IF(d.ReceberId IS NOT NULL, d.ReceberId,b.ReceberId) AS ReceberId
                    ,IF(d.ReceberId IS NOT NULL, d.Valor,b.Valor) AS Valor
                    ,(SELECT g.Descricao 
                        FROM FormaPagamento AS g
                        WHERE IF(d.ReceberId IS NOT NULL, d.FormaPagamentoId,b.FormaPagamentoId) = g.FormaPagamentoId
                    ) FormaPagamentoDesc
                    ,IF(c.ReservaId IS NOT NULL, 'S','N') AS IsReserva
                    ,DATE_FORMAT(c.DataEntrada, '%d/%m/%Y') AS DataEntradaReserva
                    ,DATE_FORMAT(c.DataSaida, '%d/%m/%Y') AS DataSaidaReserva
                    ,DATE_FORMAT(c.HoraEntrada, '%H:%i') AS HoraEntradaReserva
                    ,DATE_FORMAT(c.HoraSaida, '%H:%i') AS HoraSaidaReserva
                    ,IF(d.ReceberId IS NOT NULL OR b.ReceberId IS NOT NULL,'S','N') JaPagou
                FROM Fluxovaga AS a
                LEFT JOIN Receber b ON a.FluxoVagaId = b.FluxoVagaId
                LEFT JOIN Reserva c ON a.ReservaId = c.ReservaId
                LEFT JOIN Receber d ON c.ReservaId = d.ReservaId
                LEFT JOIN Cadastro e ON a.CadastroId = e.CadastroId
                LEFT JOIN Estacionamento f ON a.EstacionamentoId = f.EstacionamentoId
                WHERE f.EmpresaId = {$this->session->userdata('EmpresaId')}
                {$filtro}
                ORDER BY {$order_by}, a.DataEntrada DESC,a.HoraEntrada DESC ";
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
                    ,a.ReservaId
                    ,DATE_FORMAT(c.DataEntrada, '%d/%m/%Y') AS DataEntradaReserva
                    ,DATE_FORMAT(c.HoraEntrada, '%H:%i') AS HoraEntradaReserva
                    ,DATE_FORMAT(c.DataSaida, '%d/%m/%Y') AS DataSaidaReserva
                    ,DATE_FORMAT(c.HoraSaida, '%H:%i') AS HoraSaidaReserva
                    ,a.PlacaVeiculo
                    ,a.Observacao
                    ,a.EstacionamentoId
                    ,IF(b.ReceberId IS NULL AND d.ReceberId IS NULL,'B',IF(d.ReceberId IS NOT NULL, d.Status,b.Status)) AS Status
                    ,a.Status AS StatusFluxo
                    ,IF(d.ReceberId IS NOT NULL, d.Valor,b.Valor) AS Valor
                    ,(SELECT e.Descricao 
                        FROM FormaPagamento AS e
                        WHERE IF(d.ReceberId IS NOT NULL, d.FormaPagamentoId,b.FormaPagamentoId) = e.FormaPagamentoId
                    ) FormaPagamentoDesc
                    ,IF(d.ReceberId IS NOT NULL OR b.ReceberId IS NOT NULL,'S','N') AS JaPagou
                FROM Fluxovaga AS a
                LEFT JOIN Receber b ON a.FluxoVagaId = b.FluxoVagaId
                LEFT JOIN Reserva c ON a.ReservaId = c.ReservaId
                LEFT JOIN Receber d ON a.ReservaId = d.ReservaId
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

    public function getCadastros($Ativos)
    {
        $filtro = "";
        if($Ativos){
            $filtro .= "AND ((EXISTS(SELECT 1 
                                    FROM FluxoVaga AS b 
                                    WHERE a.CadastroId = b.CadastroId
                                    AND (SELECT c.EmpresaId 
                                            FROM Estacionamento AS c
                                            WHERE c.EstacionamentoId = b.EstacionamentoId) = {$this->session->userdata('EmpresaId')}))
                                OR (EXISTS(SELECT 1 
                                        FROM Reserva AS b 
                                        WHERE a.CadastroId = b.CadastroId
                                        AND (SELECT c.EmpresaId 
                                                FROM Estacionamento AS c
                                                WHERE c.EstacionamentoId = b.EstacionamentoId) = {$this->session->userdata('EmpresaId')})))";
        }

        $sql = "SELECT  
                    a.CadastroId
                    ,a.Cpf
                    ,a.Nome
                    ,a.NumeroTelefone
                    ,a.NumeroCelular
                FROM Cadastro AS a
                WHERE 1=1
                {$filtro}
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
            return $ReservaId;
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

    public function getReservas($params)
    {
        $filtro = "";
        if($params['CadastroId']){
            $filtro .= " AND a.CadastroId = {$params['CadastroId']}";
        }

        if($params['EstacionamentoId']){
            $filtro .= " AND a.EstacionamentoId = {$params['EstacionamentoId']}";
        }

        if($params['DataInicio'] && $params['DataFim']){
            $DataInicio = $this->funcoes->formataData($params['DataInicio']);
            $DataFim = $this->funcoes->formataData($params['DataFim']);
            $filtro .= " AND a.DataEntrada BETWEEN '{$DataInicio}' AND '{$DataFim}'";
        }
      
        if($params['StatusFluxo']){
            $filtro .= " AND IF(c.FluxoVagaId IS NULL,'N',c.Status) = '{$params['StatusFluxo']}'";
        }

        if($params['StatusPagamento']){
            $filtro .= " AND IF(b.ReceberId IS NULL AND d.ReceberId IS NULL,'B',IF(d.ReceberId IS NOT NULL, d.Status,b.Status)) = '{$params['StatusPagamento']}'";
        }

        if($params['FormaPagamentoId']){
            $filtro .= " AND IF(d.ReceberId IS NOT NULL, d.FormaPagamentoId,b.FormaPagamentoId) = {$params['FormaPagamentoId']}";
        }

        if($this->session->userdata('PermissaoId')==3){
            $filtro .= " AND a.EstacionamentoId = {$this->session->userdata('EstacionamentoId')}";
        }

        $sql = "SELECT  
                    a.ReservaId
                    ,DATE_FORMAT(a.DataEntrada, '%d/%m/%Y') AS DataEntrada
                    ,DATE_FORMAT(a.DataSaida, '%d/%m/%Y') AS DataSaida
                    ,DATE_FORMAT(a.HoraEntrada, '%H:%i') AS HoraEntrada
                    ,DATE_FORMAT(a.HoraSaida, '%H:%i') AS HoraSaida
                    ,a.CadastroId
                    ,e.Nome AS NomeCliente
                    ,e.Cpf AS CpfCliente
                    ,e.NumeroTelefone AS TelefoneCliente
                    ,a.EstacionamentoId
                    ,f.NomeEstacionamento
                    ,f.CpfCnpj AS CpfCnpjEstacionamento
                    ,IF(b.ReceberId IS NULL AND d.ReceberId IS NULL,'B',IF(d.ReceberId IS NOT NULL, d.Status,b.Status)) AS Status
                    ,IF(d.ReceberId IS NOT NULL, d.Valor,b.Valor) AS Valor
                    ,(SELECT g.Descricao 
                        FROM FormaPagamento AS g
                        WHERE IF(d.ReceberId IS NOT NULL, d.FormaPagamentoId,b.FormaPagamentoId) = g.FormaPagamentoId
                    ) FormaPagamentoDesc
                    ,DATE_FORMAT(c.DataEntrada, '%d/%m/%Y') AS DataEntradaFluxo
                    ,DATE_FORMAT(c.DataSaida, '%d/%m/%Y') AS DataSaidaFluxo
                    ,DATE_FORMAT(c.HoraEntrada, '%H:%i') AS HoraEntradaFluxo
                    ,DATE_FORMAT(c.HoraSaida, '%H:%i') AS HoraSaidaFluxo
                    ,IF(c.FluxoVagaId IS NULL,'N',c.Status) AS StatusFluxo
                FROM Reserva AS a
                LEFT JOIN Receber b ON a.ReservaId = b.ReservaId
                LEFT JOIN FluxoVaga c ON a.ReservaId = c.ReservaId
                LEFT JOIN Receber d ON c.FluxoVagaId = d.FluxoVagaId
                LEFT JOIN Cadastro e ON a.CadastroId = e.CadastroId
                LEFT JOIN Estacionamento f ON a.EstacionamentoId = f.EstacionamentoId
                WHERE f.EmpresaId  = {$this->session->userdata('EmpresaId')}
                {$filtro}
                ORDER BY  a.DataEntrada DESC,a.HoraEntrada DESC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    public function getReserva($ReservaId)
    {
        $filtro = "";

        $sql = "SELECT  
                    a.ReservaId
                    ,a.EstacionamentoId
                    ,a.CadastroId
                    ,DATE_FORMAT(a.DataEntrada, '%d/%m/%Y') AS DataEntrada
                    ,DATE_FORMAT(a.HoraSaida, '%H%i') AS HoraSaida
                    ,DATE_FORMAT(a.DataSaida, '%d/%m/%Y') AS DataSaida
                    ,DATE_FORMAT(a.HoraEntrada, '%H%i') AS HoraEntrada
                    ,a.Observacao
                    ,IF(b.ReceberId IS NULL AND d.ReceberId IS NULL,'B',IF(d.ReceberId IS NOT NULL, d.Status,b.Status)) AS Status
                    ,IF(c.FluxoVagaId IS NULL,'N',c.Status) AS StatusFluxo
                    ,IF(d.ReceberId IS NOT NULL, d.Valor,b.Valor) AS Valor
                    ,(SELECT g.Descricao 
                        FROM FormaPagamento AS g
                        WHERE IF(d.ReceberId IS NOT NULL, d.FormaPagamentoId,b.FormaPagamentoId) = g.FormaPagamentoId
                    ) FormaPagamentoDesc
                    ,'R' AS Tipo
                    ,'N' AS PagarAgora
                FROM Reserva AS a
                LEFT JOIN Receber b ON a.ReservaId = b.ReservaId
                LEFT JOIN FluxoVaga c ON a.ReservaId = c.ReservaId
                LEFT JOIN Receber d ON c.FluxoVagaId = d.FluxoVagaId
                WHERE a.ReservaId = {$ReservaId}";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
    }

    public function getDadosCalculo($EstacionamentoId,$Entrada,$Saida)
    {
        $sql = "SELECT f_verificaCalculaValor($EstacionamentoId,'{$Entrada}','{$Saida}') AS json";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
    }

    // public function getDadosCalculo($FluxoVagaId=0,$EstacionamentoId=0,$Entrada,$Saida)
    // {
    //     if($FluxoVagaId){
    //         $sql = "SELECT 
    //                     e.NomeEstacionamento
    //                     ,IFNULL(e.PrecoLivre,0) AS PrecoLivre
    //                     ,IFNULL(e.PrecoHora,0) AS PrecoHora 
    //                     ,IF(d.ReceberId IS NOT NULL OR b.ReceberId IS NOT NULL,'S','N') AS JaPagou
    //                     ,timestampdiff(MINUTE, '{$Entrada}', '{$Saida}') as minutos
    //                 FROM Fluxovaga AS a
    //                 LEFT JOIN Receber b ON a.FluxoVagaId = b.FluxoVagaId
    //                 LEFT JOIN Reserva c ON a.ReservaId = c.ReservaId
    //                 LEFT JOIN Receber d ON c.ReservaId = d.ReservaId
    //                 LEFT JOIN Estacionamento e ON a.EstacionamentoId = e.EstacionamentoId
    //                 WHERE a.FluxoVagaId = {$FluxoVagaId}";
    //     }else{
    //         $sql = "SELECT 
    //                     a.NomeEstacionamento
    //                     ,IFNULL(a.PrecoLivre,0) AS PrecoLivre
    //                     ,IFNULL(a.PrecoHora,0) AS PrecoHora 
    //                     ,'N' AS JaPagou
    //                     ,timestampdiff(MINUTE, '{$Entrada}', '{$Saida}') as minutos
    //                 FROM Estacionamento AS a
    //                 WHERE a.EstacionamentoId = {$EstacionamentoId}";
    //     }
    //     $query = $this->db->query($sql);
    //     $result = $query->row_array();
    //     return $result;
        
    // }

    public function getReservasProximas($EstacionamentoId,$DataEntrada,$HoraEntrada,$HoraSaida)
    {
        if($HoraSaida){
            $filtro = "AND ((a.HoraEntrada >= '{$HoraEntrada}' AND a.HoraEntrada <= '{$HoraSaida}') 
                                OR (a.HoraSaida >= '{$HoraEntrada}' AND a.HoraEntrada <= '{$HoraSaida}'))";
        }else{
            $filtro = "AND a.HoraEntrada >= '{$HoraEntrada}'";
        }

        $sql = "SELECT 
                    a.ReservaId
                    ,a.HoraEntrada
                    ,a.HoraSaida
                    ,DATE_FORMAT(a.HoraEntrada, '%H:%i') AS HoraEntradaBr
                    ,DATE_FORMAT(a.HoraSaida, '%H:%i') AS HoraSaidaBr
                    ,a.EstacionamentoId
                    ,if((a.HoraEntrada > '{$HoraEntrada}'),1,0) AS chegaraDepois
                FROM reserva AS a
                LEFT JOIN FluxoVaga b ON a.ReservaId = b.ReservaId
                WHERE a.EstacionamentoId = {$EstacionamentoId}
                AND b.FluxoVagaId IS NULL
                AND a.DataEntrada = '{$DataEntrada}' 
                {$filtro}
                ORDER BY a.HoraEntrada ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    public function getInfoLotacaoLocacao($EstacionamentoId,$Entrada)
    {
        $sql = "SELECT f_vagasLocacao({$EstacionamentoId},'{$Entrada}','D') AS QtdVagasDisponiveisLocacao
                        , f_vagasLocacao({$EstacionamentoId},'{$Entrada}','L') AS QtdLocacoes
                        , f_vagasLocacao({$EstacionamentoId},'{$Entrada}','R') AS QtdReservas
                        ,(EXISTS(SELECT *	
                                FROM diasatendimento AS b
                                WHERE b.EstacionamentoId = {$EstacionamentoId}
                                AND f_diaSemana(DATE_FORMAT('{$Entrada}', '%Y-%m-%d'))  = Dia
                                AND HoraEntrada <= DATE_FORMAT('{$Entrada}', '%H:%i:%s')  
                                AND HoraSaida > DATE_FORMAT('{$Entrada}', '%H:%i:%s')
                                AND Aberto = 'S')
                        ) AS AbertoAgora";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
    }

    public function getInfoLotacaoReserva($EstacionamentoId,$Entrada,$Saida)
    {
        $sql = "SELECT f_vagasReserva({$EstacionamentoId},'{$Entrada}','{$Saida}','D') AS QtdVagasDisponiveisReservar
                        , f_vagasReserva({$EstacionamentoId},'{$Entrada}','{$Saida}','L') AS QtdLocacoes
                        , f_vagasReserva({$EstacionamentoId},'{$Entrada}','{$Saida}','R') AS QtdReservas
                        ,(EXISTS(SELECT *	
                            FROM diasatendimento AS b
                            WHERE b.EstacionamentoId = {$EstacionamentoId}
                            AND f_diaSemana(DATE_FORMAT('{$Entrada}', '%Y-%m-%d')) = Dia
                            AND HoraEntrada <= DATE_FORMAT('{$Entrada}', '%H:%i:%s') 
                            AND HoraSaida > DATE_FORMAT('{$Entrada}', '%H:%i:%s')
                            AND HoraSaida >= DATE_FORMAT('{$Saida}', '%H:%i:%s') 
                            AND Aberto = 'S')
                        ) AS Aberto";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
    }

}



?>