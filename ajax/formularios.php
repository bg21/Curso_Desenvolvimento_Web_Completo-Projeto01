<?php
    include('../config.php');
    $data = [];
    $assunto = "Nova mensagem";
    $corpo = "<h4>Um usuário enviou uma nova mensagem para você.</h4><hr>";
    foreach ($_POST as $key => $value) {
        $corpo.='<b>'.ucfirst($key)."</b>: ".$value;
        $corpo.="<br>";
    }
    $informacoes = ["Assunto"=>$assunto, "Corpo"=>$corpo];
    $mail = new Email('smtp.gmail.com','missgacy@gmail.com','batman23','Nome da minha empresa');
    $mail->enviarPara('missgacy@gmail.com','Nome da minha empresa');
    $mail->formatarEmail($informacoes);
    if($mail->enviarEmail()){
        //echo 'Mensagem enviada com sucesso!';
        $data['sucesso'] = true;
    }else{
        //echo 'Erro ao enviar a mensagem.';
        $data['erro'] = true;
    }
    
    die(json_encode($data));
?>