<?php

include "PHPMailer-master/PHPMailerAutoload.php"; 

$mail = new PHPMailer(); 
$mail->IsSMTP(); 
$mail->Host = "smtp.gmail.com"; 
$mail->Port = 587; 
$mail->SMTPAuth = true; 
$mail->Username = ''; 
$mail->Password = ''; 
$mail->SMTPSecure = 'ssl';
$mail->SMTPKeepAlive = true;   
$mail->Mailer = 'smtp'; // don't change the quotes!
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

// Define o(s) destinatário(s) 
$mail->addAddress('caroldosreis97@gmail.com'); 
$mail->IsHTML(true); 
$mail->CharSet = 'UTF-8'; 
$mail->Subject = "Assunto da mensagem"; 
$mail->Body = 'Aqui entra o conteudo texto do email'; 
$enviado = $mail->Send(); 

// Exibe uma mensagem de resultado 
if ($enviado) 
{ 
    echo "Seu email foi enviado com sucesso!"; 
} else { 
    echo "Houve um erro enviando o email: ".$mail->ErrorInfo; 
} 