<?php
    include('../classes/Funcoes.php');
    if(isset($_SESSION['login']) == false){
        header('Location: http://localhost/DankiCode/Curso_Desenvolvimento_Web_Completo/09a14_Projeto01/Painel/');
        die();
    }
    if(isset($_GET['logout'])){
        Painel::logout();
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
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/estilo.css">
    </head>
    <body>
       <div class="flex">
            <header>
                <div class="sidebar_desktop">
                    <div class="sidebar_wraper">
                        <div class="box_usuario">
                            <?php  
                                if($_SESSION['img'] == '') {
                            ?>
                            <div class="avatar_usuario">
                                <i class="fa fa-user"></i>
                            </div>
                            <?php }else{ ?>
                            
                            <div class="img_usuario">
                                <img src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $_SESSION['img']; ?>">
                            </div>
                            
                            <?php } ?>
                            
                            <div class="info_usuario">
                                <p><?php echo $_SESSION['nome']; ?></p>
                                <h4><?php echo pegaCargo($_SESSION['cargo']); ?></h4>
                            </div>
                        </div>
                    <nav>
                        <ul>
                            <li <?php menuSelecionado(''); ?> > <?php menuSelecionadoIcone(''); ?> <a href="<?php echo INCLUDE_PATH_PAINEL; ?>"><i class="fas fa-home"></i> Início</a></li>
                            <h2>Cadastro</h2>
                            <li <?php verificaPermissaoMenu(2); ?> <?php menuSelecionado('cadastrar_depoimento'); ?> > <?php menuSelecionadoIcone('cadastrar_depoimento'); ?> <a href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar_depoimento">Depoimentos</a></li>
                            <li <?php verificaPermissaoMenu(2); ?> <?php menuSelecionado('cadastrar_servico'); ?> > <?php menuSelecionadoIcone('cadastrar_servico'); ?> <a href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar_servico">Serviços</a></li>
                            <li <?php verificaPermissaoMenu(2); ?> <?php menuSelecionado('cadastrar_slide'); ?> > <?php menuSelecionadoIcone('cadastrar_slide'); ?> <a href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar_slide">Slides</a></li>
                            <h2>Gestão</h2>
                            <li <?php menuSelecionado('listar_depoimento'); ?> > <?php menuSelecionadoIcone('listar_depoimento'); ?> <a href="<?php echo INCLUDE_PATH_PAINEL; ?>listar_depoimento">Depoimentos</a></li>
                            <li <?php menuSelecionado('listar_servico'); ?> > <?php menuSelecionadoIcone('listar_servico'); ?> <a href="<?php echo INCLUDE_PATH_PAINEL; ?>listar_servico">Serviços</a></li>
                            <li <?php menuSelecionado('listar_slide'); ?> > <?php menuSelecionadoIcone('listar_slide'); ?> <a href="<?php echo INCLUDE_PATH_PAINEL; ?>listar_slide">Slides</a></li>
                            <h2>Administração</h2>
                            <li <?php verificaPermissaoMenu(2); ?> <?php menuSelecionado('novo_usuario'); ?> ><?php menuSelecionadoIcone('novo_usuario'); ?> <a href="<?php echo INCLUDE_PATH_PAINEL; ?>novo_usuario">Novo usuário</a></li>
                            <li <?php menuSelecionado('editar_usuario'); ?> > <?php menuSelecionadoIcone('editar_usuario'); ?> <a href="<?php echo INCLUDE_PATH_PAINEL; ?>editar_usuario">Editar usuário</a></li>
                            <h2>Configurações</h2>
                            <li <?php verificaPermissaoMenu(2); ?> <?php menuSelecionado('editar_site'); ?> > <?php menuSelecionadoIcone('editar_site'); ?> <a href="<?php echo INCLUDE_PATH_PAINEL; ?>editar_site">Editar</a></li>
                        </ul>
                    </nav>
                    </div>
                </div>
            </header>
            
            <?php Painel::carregarPagina(); ?>
       </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/jquery.mask.js"></script>
        <script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/scripts.js"></script>
    </body>
</html>