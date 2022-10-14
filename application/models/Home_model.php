<?php

class Home_model extends CI_Model {


    public function getDadosAnoGrafico($Ano=2022)
    {
        $sql ="SELECT 
                    MONTH(DataEntrada) mes
                    ,(CASE MONTH(DataEntrada)
                            WHEN '1' THEN 'Janeiro'
                            WHEN '2' THEN 'Fevereiro'
                            WHEN '3' THEN 'Março'
                            WHEN '4' THEN 'Abril'
                            WHEN '5' THEN 'Maio'
                            WHEN '6' THEN 'Junho'
                            WHEN '7' THEN 'Julho'
                            WHEN '8' THEN 'Agosto'
                            WHEN '9' THEN 'Setembro'
                            WHEN '10' THEN 'Outubro'
                            WHEN '11' THEN 'Novembro'
                            WHEN '12' THEN 'Dezembro'
                        END) AS mes_desc
                    ,COUNT(*) AS qtd_veiculos
                    ,SUM(b.valor) AS valor
                FROM fluxovaga  AS a
                LEFT JOIN Receber b ON a.FluxoVagaId = b.FluxoVagaId
                WHERE YEAR(DataEntrada) = {$Ano}
                AND b.status = 'F'
                AND EXISTS(SELECT 1 
                                FROM Estacionamento c 
                                WHERE a.EstacionamentoId = c.EstacionamentoId
                                AND c.EmpresaId = {$this->session->userdata('EmpresaId')})
                GROUP BY MONTH(DataEntrada)
                ORDER BY mes DESC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    public function getDadosMesGrafico($Ano,$Mes)
    {
        $sql ="SELECT 
                    DAY(DataEntrada) dia
                    ,COUNT(*) AS qtd_veiculos
                    ,SUM(b.valor) AS valor
                FROM fluxovaga  AS a
                LEFT JOIN Receber b ON a.FluxoVagaId = b.FluxoVagaId
                WHERE YEAR(DataEntrada) = {$Ano} 
                AND MONTH(DataEntrada) = {$Mes}
                AND b.status = 'F'
                AND EXISTS(SELECT 1 
                                FROM Estacionamento c 
                                WHERE a.EstacionamentoId = c.EstacionamentoId
                                AND c.EmpresaId = {$this->session->userdata('EmpresaId')})
                GROUP BY DAY(DataEntrada)
                ORDER BY dia DESC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
}

?>