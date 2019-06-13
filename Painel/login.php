<?php
    //Sistema de lembrar-me
    if(isset($_COOKIE['lembrarme'])){
        $usuario = $_COOKIE['usuario'];
        $senha = $_COOKIE['senha'];
        
        $sql = Conexao::conectar()->prepare("SELECT * FROM tb_painel_usuarios WHERE usuario = ? AND senha = ?");
        $sql->execute([$usuario, $senha]);

        if($sql->rowCount() == 1){
            $info = $sql->fetch();
            $_SESSION['login'] = true;
            $_SESSION['nome'] = $info['nome'];
            $_SESSION['cargo'] = $info['cargo'];
            $_SESSION['usuario'] = $usuario;
            $_SESSION['senha'] = $senha;
            $_SESSION['img'] = $info['img'];
            header("Location: ".INCLUDE_PATH_PAINEL);
            die();
        }
    }
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="This is where you add your meta description. Make it count.">
        <meta name="keywords" content="wood, furniture, garden, garden-table, etc.">
        <meta name="author" content="Juliana Costa">
        <title>Site</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL ?>css/estilo.css">
    </head>
    <body>
    <div class="head_login">
        <h2>Painel de Controle - <b>Empresa</b></h2>
    </div>
    <div class="box_login">
        <?php
            if(isset($_POST['acao'])){
                $usuario = $_POST['usuario'];
                $senha = $_POST['senha'];

                $sql = Conexao::conectar()->prepare("SELECT * FROM tb_painel_usuarios WHERE usuario = ? AND senha = ?");
                $sql->execute([$usuario, $senha]);

                if($sql->rowCount() == 1){
                    //Logado
                    $info = $sql->fetch();
                    $_SESSION['login'] = true;
                    $_SESSION['nome'] = $info['nome'];
                    $_SESSION['cargo'] = $info['cargo'];
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['senha'] = $senha;
                    $_SESSION['img'] = $info['img'];
                    if(isset($_POST['lembrarme'])){
                        //Se existir é pq o usuário clicou em lembrar-me
                        setcookie('lembrarme', true, time() + (60*60*24), '/');
                        //essa '/' é pra pegar em todo o site
                        setcookie('usuario', $usuario, time() + (60*60*24), '/');
                        setcookie('senha', $senha, time() + (60*60*24), '/');
                    }
                    header("Location: ".INCLUDE_PATH_PAINEL);
                    die();
                }else{
                    //Erro
                    echo '<div class="box_erro_login"><p><i class="fas fa-exclamation-circle"></i> Usuário ou senha incorretos!</p></div>';
                }
            }
        
        ?>
        <h2>Realizar login</h2>
        <form method="post">
            <div class="input_groups">
                <input type="text" name="usuario" placeholder="Usuário">
            </div>
            <div class="input_groups">
                <input type="password" name="senha" placeholder="Senha">
            </div>
            <div class="input_groups">
                <input type="submit" name="acao" value="Entrar">
            </div>
            <div class="input_groups">
                <input type="checkbox" name="lembrarme"> 
                <label>Lembrar-me</label>
            </div>
        </form>
    </div>
    </body>
</html>