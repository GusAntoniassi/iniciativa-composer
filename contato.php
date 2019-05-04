<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$mail = new PHPMailer(TRUE);

$config = require('mailer.config.php');

$dados = array_merge([
    'nome' => 'Nome default',
    'email' => 'fulano@default.com',
    'assunto' => 'Assunto default',
    'mensagem' => 'Esqueci de preencher o formulário corretamente'
], $_POST);

try {
   
   $mail->setFrom($config['from'], $dados['nome']);
   $mail->addAddress($config['to']);
   $mail->Subject = $dados['assunto'];
   $mail->Body = $dados['mensagem'];
   
   /* SMTP parameters. */
   
   /* Tells PHPMailer to use SMTP. */
   $mail->isSMTP();
   
   /* SMTP server address. */
   $mail->Host = $config['host'];

   /* Use SMTP authentication. */
   $mail->SMTPAuth = TRUE;
   
   /* Set the encryption system. */
   $mail->SMTPSecure = 'tls';
   
   /* SMTP authentication username. */
   $mail->Username = $config['username'];
   
   /* SMTP authentication password. */
   $mail->Password = $config['password'];
   
   /* Set the SMTP port. */
   $mail->Port = $config['port'];
   
   /* Finally send the mail. */
   $mail->send();

   echo 'email enviado com sucesso';
}
catch (\Exception $e)
{
    echo 'Erro ao enviar o email';
    echo $e->getMessage();
}

