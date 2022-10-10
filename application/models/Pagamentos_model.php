<?php

class Pagamentos_model extends CI_Model {

    public function getPagamentos($EmpresaId)
    {
        $sql = "SELECT  
                    a.ReceberEmpresaId
                    ,a.Valor
                    ,a.Status
                    ,DATE_FORMAT(a.DataPagamento, '%d/%m/%Y') AS DataPagamento
                    ,DATE_FORMAT(a.DataVencimento, '%d/%m/%Y') AS DataVencimento
                    ,a.FormaPagamentoId
                    ,IF(c.TipoCartao IS NULL,'P',c.TipoCartao) AS TipoCartao
                    ,(SELECT b.Descricao 
                        FROM FormaPagamento AS b
                        WHERE a.FormaPagamentoId = b.FormaPagamentoId) FormaPagamentoDesc
                FROM ReceberEmpresa AS a
                LEFT JOIN Carteira AS c ON c.CarteiraId = a.CarteiraId
                WHERE a.EmpresaId = {$EmpresaId}
                ORDER BY a.ReceberEmpresaId DESC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    public function getVerificaPagamento($EmpresaId)
    {
        $sql = "SELECT 
                    f_SituacaoEmpresa(a.EmpresaId,1) AS Situacao
                    ,f_SituacaoEmpresa(a.EmpresaId,2) AS DescSituacao
                    ,CompetenciaAtual
                    ,VencExperimental
                    ,VencUltpagamentoBr
                    ,DATE_FORMAT(NOW(), '%Y-%m-%d') AS Agora
                    ,DATE_FORMAT(NOW(), '%d/%m/%Y') AS AgoraBr
                    ,DATE_ADD(
                            IF((DATE_FORMAT(NOW(), '%Y-%m-%d') < IF(PagouAlgumaVez=1,VencUltpagamento,DATE_FORMAT(VencExperimental, '%Y-%m-%d'))),
                                IF(PagouAlgumaVez=1,VencUltpagamento,DATE_FORMAT(VencExperimental, '%Y-%m-%d'))
                                ,DATE_FORMAT(NOW(), '%Y-%m-%d')
                                ), INTERVAL 1 MONTH
                    ) AS ProxVencimento
                    ,PagouAlgumaVez
                    ,(CASE f_SituacaoEmpresa(a.EmpresaId,1)
                            WHEN '1' THEN 'alert-info'
                            WHEN '2' THEN 'alert-success'
                            WHEN '3' THEN 'alert-warning'
                            WHEN '4' THEN 'alert-warning'
                            ELSE ''
                        END) AS alert
                FROM view_pagamento_empresa AS a
                WHERE a.EmpresaId = {$EmpresaId}";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
    }

    public function setCarteira($data,$CarteiraId=0)
    {
        if($CarteiraId){
            $this->db->where('CarteiraId', $CarteiraId);
            $this->db->update('Carteira',$data);
            return $CarteiraId;
        }else{
            $this->db->insert('Carteira',$data);
            $last_id = $this->db->insert_id();
            return $last_id;
        }
    }

    public function setPagamento($data,$ReceberEmpresaId=0)
    {
        if($ReceberEmpresaId){
            $this->db->where('ReceberEmpresaId', $ReceberEmpresaId);
            $this->db->update('ReceberEmpresa',$data);
            return $ReceberEmpresaId;
        }else{
            $this->db->insert('ReceberEmpresa',$data);
            $last_id = $this->db->insert_id();
            return $last_id;
        }
    }
}