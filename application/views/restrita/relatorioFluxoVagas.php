<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $titulo;?></title>
    <style>
        .text-center{
            text-align:center;
        }
        .text-left{
            text-align:left;
        }
        .text-right{
            text-align:right;
        }
        .dados{
            width:100%;
            border: 1px solid #ddd;
            border-spacing: 0;
            border-collapse: collapse;
            margin-bottom:10px;
            margin-top:30px;
        }
        .dados th, .dados td{
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: middle;
            border: 1px solid #ddd;
            font-size:13px;
        }
    </style>
</head>
<body>
  
<div class="container">
    <h2 class="text-center"><?php echo $titulo;?></h2>
    <?php foreach ($lista as $estacionamento) {?>
    <table class="dados">
        <thead>
            <tr>
                <th colspan="6">
                    <?php echo $estacionamento[0]['NomeEstacionamento']; ?> - <?php echo $estacionamento[0]['CpfCnpjFormatado']; ?>
                </th>
            </tr>
            <tr>
                <th class="text-left" width="25%">Período</th>
                <th class="text-left" width="28%">Cliente/Placa</th>
                <th class="text-center" width="12%">Reserva</th>
                <th class="text-left" width="20%">Pagamento</th>
                <th class="text-center" width="15%">Status Locação</th>  
            </tr>
        </thead>
        <tbody>
            <?php 
                $valor = 0;
                foreach ($estacionamento as $i => $a) {
                    if($a['Valor']>0){
                        $valor += $a['Valor'];
                    }
            ?>
            <tr>
                <td>
                    <?php echo $a['DataEntrada'].' '.$a['HoraEntrada']; ?> <br>
                    <?php echo $a['DataSaida']?($a['DataSaida'].' '.$a['HoraSaida']):'-'; ?>
                </td>
                <td>
                    <?php echo $a['NomeCliente']?($a['NomeCliente'].'<br>'):''; ?>
                    <?php echo $a['PlacaVeiculoFormatada']; ?>
                </td>
                <td class="text-center">
                    <?php echo $a['IsReserva']=='S'?'Sim':'Não'; ?>
                </td>
                <td>
                    <?php 
                        if($a['JaPagou']=='S'){
                          echo number_format($a['Valor'],2,",",".").' ('.$a['FormaPagamentoDesc'].')';
                        }else{
                            echo $a['StatusDesc'];
                        }
                    ?>
                </td>
                <td class="text-center">
                    <?php echo $a['StatusFluxoDesc']; ?>
                </td>
            </tr>
            <?php } ?>

        </tbody>
    </table>
    <p class="text-right"><b>Total: R$ <?php echo number_format($valor,2,",","."); ?></b></p>
    <?php } ?>

  
</div>
  
</body>
</html>