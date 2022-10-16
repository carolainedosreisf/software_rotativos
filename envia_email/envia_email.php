<?php
header('Access-Control-Allow-Origin: *');
$acao = $_GET['a']=='C'?'Cadastrar':'Redefinir';
$LoginId = base64_encode(trim($_GET['i']));
$email = $_GET['e'];
$estacionamento = isset($_GET['s'])?utf8_decode($_GET['s']):'';
$token = trim($_GET['t']);
$PermissaoId = trim($_GET['p']);
$acao_code = base64_encode($_GET['a']);

switch ($PermissaoId) {
    case '1':
        $titulo = 'E-mail para '.$acao.' a senha do acesso da sua empresa no Software Rotativo Online.';
        break;
    case '2':
        $titulo = 'E-mail para '.$acao.' a senha do acesso da sua empresa ('.$estacionamento.'), no Software Rotativo Online.';
        break;
    case '3':
        $titulo = 'E-mail para '.$acao.' a senha do seu acesso no rotativo: '.$estacionamento.', no Software Rotativo Online.';
        break;
    case '4':
        $titulo = 'E-mail para '.$acao.' a senha do seu acesso no aplicativo Rotativo Online.';
        break;
    default:
        # code...
        break;
}

$email_content = '
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Demystifying Email Design</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <html xmlns="http://www.w3.org/1999/xhtml">
            <style>
                body{
                    font-family: "Courier New"
                    , Courier;
                }
            </style>
        </head>

        <body style="width:100%;margin:0px;font-family: Courier New, Courier;">
            <div style="width:100%;padding: 25px 10px;background:#282e40;">
            </div>
            <div class="apresent" style="padding: 20px 50px;text-align: center;">
                <p style="font-size: 16px;color: #333;line-height: 150%;font-weight: bold;">
                    '.$titulo.'
                </p>
            </div>
            <div style="text-align:center;">
                <a href="http://localhost/software_rotativos/index.php/Login/novaSenha?t='.$token.'&i='.$LoginId.'&a='.$acao_code.'" style="padding: 10px 20px;border: 3px solid #282e40;font-size: 14px;color: rgb(66, 66, 66);max-width: 200px;text-align: center;text-decoration: none;cursor:pointer;">'.$acao.' a senha</a>
            </div>
            <div class="info">
                <h4 style="font-size: 16px;color: #333;line-height: 150%;font-weight: bold;padding: 0px 10px;">Depois de clicar no botão a cima, siga essas etapas:</h4>
                <p style="font-size: 14px;color: rgb(66, 66, 66);padding: 4px 0px;padding: 0px 10px";>1.Insira a nova senha.</p>
                <p style="font-size: 14px;color: rgb(66, 66, 66);padding: 4px 0px;padding: 0px 10px";>2.Confirme sua nova senha.</p>
                <p style="font-size: 14px;color: rgb(66, 66, 66);padding: 4px 0px;padding: 0px 10px";>3.Clique em “Salvar”.</p>
                <h4 style="font-size: 16px;color: #333;line-height: 150%;font-weight: bold;padding: 0px 10px;">Este link só pode ser utilizado uma única vez. Ele expirará em uma hora.</h4>
            </div>
    </body>
</html>';
    $email_subject = 'E-mail para '.$acao.' a senha do seu acesso no '.($PermissaoId==4?'Aplicativo':'Software').' Rotativo Online ';
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    mail($email,$email_subject,$email_content,$headers);
    return true;			
?>