<?php
    include('config.php');
    Site::updateUsuarioOnline(); //visitantes online
    Site::contadorDeUsuarios(); //conta o total de visitas
?>
<?php
    $sql_site = Conexao::conectar()->prepare("SELECT * FROM tb_site_config");
    $sql_site->execute();
    $info_site = $sql_site->fetch();
    /*Quando só tem uma linha no bd não precisa do foreach*/
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="This is where you add your meta description. Make it count.">
        <meta name="keywords" content="wood, furniture, garden, garden-table, etc.">
        <meta name="author" content="Juliana Costa">
        <title><?php echo $info_site['titulo']; ?></title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/estilo.css">
    </head>
    <body>
        <?php
            //new Email();
            $url = isset($_GET['url']) ? $_GET['url'] : 'home';
            /*
            //Aqui é pra o scrollTop
            switch ($url) {
                case 'sobre':
                    echo '<target target="sobre">';
                    break;

                case 'servicos':
                    echo '<target target="servicos">';
                    break;
            }
            //Aqui é pra o scrollTop
            
            */

            //Aqui é pra o scrollTop
            if($url == 'sobre'){
                echo '<target target="sobre">'; 
            }else if($url == 'servicos'){
                echo '<target target="servicos">';
            }
            //Aqui é pra o scrollTop
        ?>

        <div class="load">
            <img src="<?php echo INCLUDE_PATH; ?>imgs/loader.gif" alt="">
        </div>
        <div class="sucesso">
            <p>Email enviado com <b>sucesso</b>!</p>
        </div>
        <div class="erro">
            <p>O seu email <b>não foi enviado</b>.</p>
        </div>

        <header>
            <div class="desktop">
                <div class="container">
                    <div class="logo"><a href="<?php echo INCLUDE_PATH; ?>">Sua empresa</a></div>
                    <nav>
                        <ul>
                            <li><a href="<?php echo INCLUDE_PATH; ?>">Início</a></li>
                            <li><a href="<?php echo INCLUDE_PATH; ?>sobre">Sobre</a></li>
                            <li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
                            <li><a href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="mobile">
                <div class="container">
                    <div class="logo"><a href="<?php echo INCLUDE_PATH; ?>">Sua empresa</a></div>
                    <nav>
                        <ul>
                            <li><a href="<?php echo INCLUDE_PATH; ?>">Início</a></li>
                            <li><a href="<?php echo INCLUDE_PATH; ?>sobre">Sobre</a></li>
                            <li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
                            <li><a href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
                        </ul>
                    </nav>
                    <h2><i class="fas fa-bars"></i></h2>
                </div>
            </div>
        </header>
        
        <?php

            if(file_exists('pages/'.$url.'.php')){
                include('pages/'.$url.'.php');
            }else{
                if($url != 'sobre' && $url != 'servicos'){
                    $pagina_404 = true;
                    include('pages/404.php');
                }else{
                    include('pages/home.php');
                }
            }
        ?>
        <footer <?php if(isset($pagina_404) && $pagina_404 == true){
           echo 'class="fixed"';
        } ?>>
            <div class="container">
                <h2><?php echo $info_site['titulo']; ?> - Todos os direitos reservados.</h2>
            </div>
        </footer>
        
        <?php 
            if($url == 'contato'){  
        ?>
        
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBnv7y3NuVB3H7-6XXXbtFUYOsvWql_d-8&"></script>
        <script src="<?php echo INCLUDE_PATH; ?>js/initMap.js"></script>
        
        <?php
            }
        ?>
        
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="<?php echo INCLUDE_PATH; ?>js/scripts.js"></script>
        <script src="<?php echo INCLUDE_PATH; ?>js/slide.js"></script>
        <script src="<?php echo INCLUDE_PATH; ?>js/formularios.js"></script>
    </body>
</html>