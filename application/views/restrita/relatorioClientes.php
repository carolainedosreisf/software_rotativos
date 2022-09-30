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
    <table class="dados">
        <thead>
            <tr>
            <td>Empresa</td>
            <td class="text-center">Tipo</td>
            <td class="text-center">Cadastro</td>
            <td class="text-center">Estacionamentos</td>
            <td class="text-center">Mensalidades</td> 
            </tr>
        </thead>
        <tbody>
            <?php 
                $valor = 0;
                foreach ($lista as $i => $a) {
                    if($a['Valor']>0){
                        $valor += $a['Valor'];
                    }
            ?>
            <tr>
                <td>
                    <?php echo $a['Nome'].'<br>'.$a['CpfCnpjFormatado'] ?> 
                </td>
                <td class="text-center">
                    <?php echo $a['TipoEmpresa']=='J'?'Jurídica':'Física'; ?>
                </td>
                <td class="text-center">
                    <?php echo $a['DataCadastroBr']; ?>
                </td>
                <td class="text-center">
                    <?php echo $a['QtdEstacionamentos']; ?>
                </td>
                <td class="text-center">
                    <?php echo number_format($a['Valor'],2,",",".").' ('.$a['QtdMensalidades'].')'; ?>
                </td>
            </tr>
            <?php } ?>

        </tbody>
    </table>
    <p class="text-right"><b>Total: R$ <?php echo number_format($valor,2,",","."); ?></b></p>

  
</div>
  
</body>
</html>