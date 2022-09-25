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
                <th class="text-center">Entrada</th>
                <th class="text-center">Saída</th>
                <th class="text-left">Cliente/Placa</th>
                <th class="text-center">Valor</th>
                <th class="text-left">Forma de Pagamento</th>
                <th class="text-center">Status</th>  
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
                <td class="text-center">
                    <?php echo $a['DataEntradaBr'].' '.$a['HoraEntradaBr']; ?>
                </td>
                <td class="text-center">
                    <?php echo $a['DataSaidaBr']?($a['DataSaidaBr'].' '.$a['HoraSaidaBr']):'-'; ?>
                </td>
                <td>
                    <?php echo $a['NomeCliente']?($a['NomeCliente'].'<br>'):''; ?>
                    <?php echo $a['PlacaVeiculoFormatada']; ?>
                </td>
                <td class="text-center">
                    <?php echo number_format($a['Valor'],2,",","."); ?>
                </td>
                <td>
                    <?php echo $a['FormaPagamentoDesc']?$a['FormaPagamentoDesc']:'-'; ?>
                </td>
                <td class="text-center">
                    <?php echo $a['StatusDesc']; ?>
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