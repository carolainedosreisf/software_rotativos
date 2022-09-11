<?php

class Estacionamento_model extends CI_Model {

    public function setEstacionamento($data,$EstacionamentoId=0)
    {
        if($EstacionamentoId){
            $this->db->where('EstacionamentoId', $EstacionamentoId);
            $this->db->update('Estacionamento',$data);
        }else{
            $this->db->insert('Estacionamento',$data);
            $last_id = $this->db->insert_id();
            return $last_id;
        }
        
    }

    public function getValidaCpfCnpj($CpfCnpj)
    {
        $sql = "SELECT 1 FROM Estacionamento WHERE CpfCnpj = '{$CpfCnpj}'";
        $query = $this->db->query($sql);
        $result = $query->num_rows();
        return $result;
    }

    public function getEstacionamento($EstacionamentoId=null,$EmpresaId=null)
    {
        $result = 'result_array';
        $filtro = "";
        if($EstacionamentoId){
            $filtro .= " AND a.EstacionamentoId = {$EstacionamentoId}";
            $result = 'row_array';
        }
        if($EmpresaId){
            $filtro .= " AND a.EmpresaId = {$EmpresaId}";
        }
        $sql = "SELECT 
                        a.EstacionamentoId
                        ,b.Nome
                        ,a.NomeEstacionamento
                        ,a.CpfCnpj
                        ,IF((a.CpfCnpj = b.CpfCnpj),'S','N') AS Matriz
                        ,b.TipoEmpresa
                        ,a.Endereco
                        ,a.NumeroEndereco
                        ,a.Complemento
                        ,a.NumeroCep
                        ,c.CidadeId
                        ,c.NomeCidade
                        ,c.Estado
                        ,a.BairroEndereco
                        ,b.UrlLogo
                        ,a.NumeroVagas
                        ,a.Sobre
                        ,a.NumeroTelefone1
                        ,a.NumeroTelefone2
                        ,a.Email
                        ,a.DiasAtendimentoId
                        ,IFNULL(a.PrecoLivre,0) AS PrecoLivre
                        ,IFNULL(a.PrecoHora,0) AS PrecoHora
                        ,a.EmpresaId
                        ,a.DataCadastro
                        ,(SELECT COUNT(*) FROM FotoEstacionamento AS d WHERE a.EstacionamentoId = d.EstacionamentoId) AS QtdFotos
                        ,(SELECT COUNT(*) FROM Login AS d WHERE a.EstacionamentoId = d.EstacionamentoId AND d.PermissaoId = 3) AS QtdAtendentes
                FROM Estacionamento AS a
                LEFT JOIN Empresa AS b ON a.EmpresaId = b.EmpresaId
                LEFT JOIN Cidade AS c ON a.CidadeId = c.CidadeId
                WHERE 1=1
                {$filtro}";
        $query = $this->db->query($sql);
        $result = $query->$result();
        return $result;
    }

    public function getFotos($EstacionamentoId)
    {
        $sql = "SELECT 
                        FotoEstacionamentoId
                        ,EstacionamentoId
                        ,UrlFoto 
                    FROM FotoEstacionamento 
                    WHERE EstacionamentoId = {$EstacionamentoId}
                    ORDER BY FotoEstacionamentoId ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    public function setFoto($data)
    {
        $this->db->insert('FotoEstacionamento',$data);
    }

    public function excluirFoto($FotoEstacionamentoId)
    {
        $this->db->where('FotoEstacionamentoId',$FotoEstacionamentoId);
        $this->db->delete('FotoEstacionamento');
    }

    public function getAtendentes($EstacionamentoId)
    {
        $sql = "SELECT 
                        LoginId
                        ,Email
                        ,NomeUsuario 
                        ,IF(Senha IS NULL,'Não','Sim') AS SenhaCadastrada
                    FROM Login 
                    WHERE EstacionamentoId = {$EstacionamentoId}
                    AND PermissaoId = 3
                    ORDER BY LoginId ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
}

?>