<?php
    header('Access-Control-Allow-Origin: *');

    $email = utf8_encode(base64_decode($_GET['email']));
    $nome = utf8_encode(base64_decode($_GET['nome']));
    $assunto = utf8_encode(base64_decode($_GET['assunto']));
    $mensagem = utf8_encode(base64_decode($_GET['mensagem']));

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
                    <div style="font-size: 16px;line-height: 1.42857143;color: #777;">
                    <div class="bs-callout-default" style="width:80%;padding: 20px;margin: 20px 0;border: 1px solid #eee;border-left-color: #269abc;border-left-width: 5px;border-radius: 3px;">
                        <h3 style="text-align:center;">
                            Você recebeu uma mensagem através do formulário do site
                        </h3>
                        <span>
                            <b>Nome: </b>'.$nome.'<br>
                            <b>Email: </b>'.$email .'<br>
                            <b>Assunto: </b>'.$assunto.'<br>
                            <b>Mensagem: </b>'.$mensagem.'<br>
                        </span>
                    </div>
                </div>
                </body>
            </html>'; 
    $email_subject = "Contato através do site: {$nome}";
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    mail('rotativoonline@gmail.com',$email_subject,$email_content,$headers);
    return true;			
?>