<section class="fale_conosco">
    <div class="container">
        <div class="map" id="map"></div>
        


        <?php
            if(isset($_POST['acao']) && $_POST['identificador'] == 'form_contato'){
                if($_POST['email'] || $_POST['nome'] || $_POST['mensagem'] != ''){
                    $nome = $_POST['nome'];
                    $email = $_POST['email'];
                    $mensagem = $_POST['mensagem'];
                    /**Olhar no formulário da pasta ajax
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
                        echo 'Mensagem enviada com sucesso!';
                    }else{
                        echo 'Erro ao enviar a mensagem.';
                    }
                    */
                }else{
                    echo 'Campos em branco';
                }
            }
        
        ?>
        <div class="formulario">
            <div class="container">
                <h2>Entre em contato conosco</h2>
                <form method="post">
                    <div class="input_groups">
                        <input required type="text" name="nome" placeholder="Seu nome">
                    </div>
                    <div class="input_groups">
                        <input required type="email" name="email" placeholder="Seu melhor email">
                    </div>
                    <div class="input_groups">
                        <textarea required name="mensagem" placeholder="Sua mensagem"></textarea>
                    </div> 
                    <input type="hidden" name="identificador" value="form_contato">
                    <div class="input_groups">
                        <input type="submit" name="acao" value="Enviar">
                    </div>   
                </form>
            </div>
        </div>

    </div>
</section>