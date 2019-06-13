        <main class="main">
            <div class="head_content">
                <div class="bars">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="logout">
                    <a href="?logout">Sair <i class="fas fa-sign-out-alt"></i></a>
                </div>
                <div class="clear"></div>
            </div>
            <div class="body_content">
                <div class="box_content w100">
                    <h2><i class="far fa-file"></i> Editar Serviço</h2>
                    <form method="post">
                    <?php
                    if(isset($_POST['acao'])){
                        $titulo = $_POST['titulo'];
                        $nome_autor = $_POST['nome_autor'];
                        $descricao_autor = $_POST['descricao_autor'];
                        $icone1 = $_POST['icone1'];
                        $titulo_icone1 = $_POST['titulo_icone1'];
                        $descricao_icone1 = $_POST['descricao_icone1'];
                        $icone2 = $_POST['icone2'];
                        $titulo_icone2 = $_POST['titulo_icone2'];
                        $descricao_icone2 = $_POST['descricao_icone2'];
                        $icone3 = $_POST['icone3'];
                        $titulo_icone3 = $_POST['titulo_icone3'];
                        $descricao_icone3 = $_POST['descricao_icone3'];
                        if($site = Site::atualizarSite($titulo, $nome_autor, $descricao_autor, $icone1, $titulo_icone1, $descricao_icone1, $icone2, $titulo_icone2, $descricao_icone2, $icone3, $titulo_icone3, $descricao_icone3)){
                            Painel::alerta('sucesso', 'O serviço foi editado com sucesso!');
                        }else{
                            Painel::alerta('erro', 'Erro ao atualizar o site!');
                        }
                    }
                    
                    $sql = Conexao::conectar()->prepare("SELECT * FROM tb_site_config");
                    $sql->execute();
                    $site = $sql->fetch();      
                    ?>
                        
                        <div class="input_groups">
                            <label>Título do site:</label>
                            <input type="text" value="<?php echo $site['titulo']; ?>" name="titulo">
                        </div>
                        <div class="input_groups">
                            <label>Nome do autor:</label>
                            <input type="text" value="<?php echo $site['nome_autor']; ?>" name="nome_autor">
                        </div>
                        <div class="input_groups">
                            <label>Descrição do autor:</label>
                            <textarea name="descricao_autor"><?php echo $site['descricao_autor']; ?></textarea>
                        </div>
                        <div class="input_groups">
                            <label>Icone 1:</label>
                            <input type="text" value="<?php echo $site['icone1']; ?>" name="icone1">
                        </div>
                        <div class="input_groups">
                            <label>Título ícone 1:</label>
                            <input type="text" value="<?php echo $site['titulo_icone1']; ?>" name="titulo_icone1">
                        </div>
                        <div class="input_groups">
                            <label>Descrição do ícone1:</label>
                            <textarea name="descricao_icone1"><?php echo $site['descricao_icone1']; ?></textarea>
                        </div>
                        <div class="input_groups">
                            <label>Icone 2:</label>
                            <input type="text" value="<?php echo $site['icone2']; ?>" name="icone2">
                        </div>
                        <div class="input_groups">
                            <label>Título ícone 2:</label>
                            <input type="text" value="<?php echo $site['titulo_icone2']; ?>" name="titulo_icone2">
                        </div>
                        <div class="input_groups">
                            <label>Descrição do ícone2 :</label>
                            <textarea name="descricao_icone2"><?php echo $site['descricao_icone1']; ?></textarea>
                        </div>
                        <div class="input_groups">
                            <label>Icone 3:</label>
                            <input type="text" value="<?php echo $site['icone3']; ?>" name="icone3">
                        </div>
                        <div class="input_groups">
                            <label>Título ícone 3:</label>
                            <input type="text" value="<?php echo $site['titulo_icone3']; ?>" name="titulo_icone3">
                        </div>
                        <div class="input_groups">
                            <label>Descrição do ícone3:</label>
                            <textarea name="descricao_icone3"><?php echo $site['descricao_icone1']; ?></textarea>
                        </div>

                        
                        <div class="input_groups">
                            <input type="submit" name="acao" value="Atualizar">
                        </div>
                        <div class="clear"></div>
                    </form>
                </div>
            </div>
        </main>