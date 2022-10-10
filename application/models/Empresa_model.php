<?php

class Empresa_model extends CI_Model {

    public function setEmpresa($data,$EmpresaId=0)
    {
        if($EmpresaId){
            $this->db->where('EmpresaId', $EmpresaId);
            $this->db->update('Empresa',$data);
        }else{
            $this->db->insert('Empresa',$data);
            $last_id = $this->db->insert_id();
            return $last_id;
        }
    }

    public function getCidades($descricao)
    {
        $filtro = "";
        if($descricao){
            $filtro .= " WHERE NomeCidade LIKE('%{$descricao}%')";
        }

        $sql = "SELECT CidadeId
                        ,NomeCidade 
                        ,Estado
                FROM Cidade 
                {$filtro}
                ORDER BY NomeCidade ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }


    public function getEmpresa($EmpresaId)
    {
        $sql = "SELECT 
                        a.EmpresaId
                        ,a.Nome
                        ,a.RazaoSocial 
                        ,a.CpfCnpj
                        ,a.TipoEmpresa
                        ,a.Endereco
                        ,a.NumeroEndereco
                        ,a.Complemento
                        ,a.NumeroCep
                        ,b.CidadeId
                        ,b.NomeCidade
                        ,b.Estado
                        ,a.BairroEndereco
                        ,a.UrlLogo
                        ,a.Sobre
                        ,a.NumeroTelefone1
                        ,a.NumeroTelefone2
                        ,a.Email
                FROM Empresa AS a
                LEFT JOIN Cidade AS b ON a.CidadeId = b.CidadeId
                WHERE a.EmpresaId = {$EmpresaId}";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
    }

    public function getEmpresas($situacao_pagamento="",$situacao_software="")
    {
        $filtro = "";
        if($situacao_pagamento){
            $filtro .= " AND f_SituacaoEmpresa(a.EmpresaId,1) = {$situacao_pagamento}";
        }

        if($situacao_software=="B"){
            $filtro .= " AND f_SituacaoEmpresa(a.EmpresaId,1) > 2";
        }elseif($situacao_software=="L"){
            $filtro .= " AND f_SituacaoEmpresa(a.EmpresaId,1) <= 2";
        }

        $sql = "SELECT  
                    a.EmpresaId
                    ,a.Nome
                    ,a.CpfCnpj
                    ,a.TipoEmpresa
                    ,a.DataCadastro
                    ,DATE_FORMAT(a.DataCadastro, '%d/%m/%Y %H:%i') AS DataCadastroBr
                    ,(SELECT 
                        COUNT(*) 
                        FROM estacionamento AS c
                        WHERE c.EmpresaId = a.EmpresaId) AS QtdEstacionamentos
                    ,(SELECT 
                        COUNT(*) 
                        FROM ReceberEmpresa AS c
                        WHERE c.EmpresaId = a.EmpresaId) AS QtdMensalidades
                    , f_SituacaoEmpresa(a.EmpresaId,1) AS Situacao
                    ,(SELECT 
                        SUM(c.Valor) 
                        FROM ReceberEmpresa AS c
                        WHERE c.EmpresaId = a.EmpresaId
                        AND Status = 'F') AS Valor
                    ,(CASE f_SituacaoEmpresa(a.EmpresaId,1)
                            WHEN '1' THEN 'Dentro do Experimental'
                            WHEN '2' THEN 'Em dia'
                            WHEN '3' THEN 'Experimental Expirado'
                            WHEN '4' THEN 'Último pagamento Vencido'
                            ELSE ''
                        END) AS DescSituacao
                    ,(CASE f_SituacaoEmpresa(a.EmpresaId,1)
                            WHEN '1' THEN 'btn-info'
                            WHEN '2' THEN 'btn-success'
                            WHEN '3' THEN 'btn-danger'
                            WHEN '4' THEN 'btn-danger'
                            ELSE ''
                        END) AS ClassSituacao
                FROM Empresa AS a
                WHERE 1=1
                {$filtro}
                ORDER BY Nome ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
}

?>