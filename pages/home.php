<?php
    $sql_site = Conexao::conectar()->prepare("SELECT * FROM tb_site_config");
    $sql_site->execute();
    $info_site = $sql_site->fetch();
    /*Quando só tem uma linha no bd não precisa do foreach*/ 
?>
    
    <section class="bg">
    <div style="background-image: url('imgs/bg.jpg')" class="bg_single"></div>
    <div style="background-image: url('imgs/bg2.jpg')" class="bg_single"></div>
    <div style="background-image: url('<?php echo INCLUDE_PATH; ?>imgs/bg3.jpg')" class="bg_single"></div>
    <div class="overlay"></div>
    <div class="container">
        <div class="content">
        <?php
            if(isset($_POST['acao']) && $_POST['identificador'] == 'form_home'){
                if($_POST['email'] != ''){
                    $email = $_POST['email'];
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        
                        $mail = new Email('smtp.gmail.com','missgacy@gmail.com','batman23','Nome da minha empresa');
                        $mail->enviarPara('missgacy@gmail.com','Nome da minha empresa');
                        //$mail->enviarPara('outroemail','Nome da minha empresa');
                        $corpo = '<h2>Olá, um novo usuário se cadastrou no seu site!</h2>'.'<b>Email cadastrado:</b> '.$email; 
                        $informacoes = ['Assunto'=>'Novo email cadastrado', 'Corpo'=>$corpo];
                        $mail->formatarEmail($informacoes);
                        if($mail->enviarEmail()){
                            echo 'Email cadastrado com sucesso!';
                        }else{
                            echo 'Erro ao cadastrar o email.';
                        }
                    
                    }else{
                        echo 'Não é um email válido.';
                    }
                }else{
                    echo 'Insira um email válido.';
                }
            } 
        ?>
            <h2>Qual o seu melhor email?</h2>
                <form method="post">
                    <input type="email" name="email" required placeholder="Seu melhor email">
                    <input type="hidden" name="identificador" value="form_home">
                    <input type="submit" name="acao" value="Cadastrar">
                </form>
        </div>
    </div>
</section>

        <section class="sobre" id="sobre">
            <div class="container">
                <div class="descricao">
                    <h2><?php echo $info_site['nome_autor']; ?></h2>
                    <p>
                        <?php echo $info_site['descricao_autor']; ?>
                    </p>
                    
                </div>
                <div class="perfil">
                    <img src="imgs/avatar.jpg">
                </div>
                
            </div>
        </section>

        <section class="diferenciais" id="servicos">
            <h2>O que me torna único no mercado</h2>
            <div class="container">
                <div class="single">
                    <h1><i class="<?php echo $info_site['icone1']; ?>"></i></h1>
                    <h2><?php echo $info_site['titulo_icone1']; ?></h2>
                    <p><?php echo $info_site['descricao_icone1']; ?></p>
                </div>
                <div class="single">
                    <h1><i class="<?php echo $info_site['icone2']; ?>"></i></h1>
                    <h2><?php echo $info_site['titulo_icone2']; ?></h2>
                    <p><?php echo $info_site['descricao_icone2']; ?></p>
                </div>
                <div class="single">
                    <h1><i class="<?php echo $info_site['icone3']; ?>"></i></h1>
                    <h2><?php echo $info_site['titulo_icone3']; ?></h2>
                    <p><?php echo $info_site['descricao_icone3']; ?></p>
                </div>
            </div>
        </section>

        <section class="extras">
            <div class="container">
                <div class="depoimentos">
                    <h2>Depoimento dos nossos clientes</h2>
                    <?php
                        $mostrar = 3;
                        $sql = Conexao::conectar()->prepare("SELECT * FROM tb_site_depoimentos ORDER BY order_id ASC LIMIT $mostrar");
                        $sql->execute();
                        $depoimentos = $sql->fetchAll();

                        foreach ($depoimentos as $key => $value) {                    
                    ?>
                    <div class="depoimento_single">
                        <p><?php echo $value['depoimento'] ?></p>
                        <h4><?php echo $value['nome_depoimento']; ?> - <?php echo $value['data']; ?></h4>
                    </div>
                    <?php } ?>
                    
                </div>
                <div class="servicos">
                    <h2>Serviços centrados no usuário</h2>
                    <ul>
                        <?php
                            $mostrar = 6;
                            $sql = Conexao::conectar()->prepare("SELECT * FROM tb_site_servicos ORDER BY order_id ASC LIMIT $mostrar");
                            $sql->execute();
                            $servico = $sql->fetchAll();

                            foreach ($servico as $key => $value) {
                                # code...
                            
                        ?>
                        <li><?php echo $value['servico']; ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </section>