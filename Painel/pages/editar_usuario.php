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
                        <h2><i class="fas fa-user-edit"></i> Editar usuário</h2>
                        <form method="post" enctype="multipart/form-data">
                        <?php
                            if(isset($_POST['acao'])){
                                $nome = $_POST['nome'];
                                $senha = $_POST['senha'];
                                $img = $_FILES['img'];
                                $imagem_atual = $_POST['imagem_atual'];
                                

                                if($img['name'] != ''){
                                    //se não estiver vazio quer dizer que foi selecionado
                                    if(Painel::imagemValida($img)){
                                        //Deletar a imagem antiga
                                        Painel::deletarFile($imagem_atual);
                                        /*Se essa imagem for válida então pode fazer o upload */
                                        $img = Painel::uploadFile($img);
                                        if($usuario = Usuarios::atualizarUsuario($nome, $senha, $img)){
                                            $_SESSION['img'] = $img;
                                            
                                            //Se conseguir atualizar
                                            Painel::alerta('sucesso', 'Cadastrado atualizado com sucesso!');
    
                                        }else{
                                            //Se não conseguir atualizar
                                            Painel::alerta('erro', 'Erro ao atualizar o perfil!');
                                        }
                                    }else{
                                        Painel::alerta('erro', 'O formato da imagem não é valido.');
                                    }

                                }else{
                                    $img = $imagem_atual;
                                    if($usuario = Usuarios::atualizarUsuario($nome, $senha, $img)){
                                        //Se conseguir atualizar
                                        Painel::alerta('sucesso', 'Cadastrado atualizado com sucesso!');

                                    }else{
                                        //Se não conseguir atualizar
                                        Painel::alerta('erro', 'Erro ao atualizar o perfil!');
                                    }
                                } 
                            }
                        ?>
                            <div class="input_groups">
                                <label>Nome:</label>
                                <input required type="text" name="nome" value="<?php echo $_SESSION['nome']; ?>">
                            </div>
                            <div class="input_groups">
                                <label>Senha:</label>
                                <input required type="password" name="senha" value="<?php echo $_SESSION['senha']; ?>">
                            </div>
                            <div class="input_groups">
                                <label>Imagem:</label>
                                <input type="file" name="img">
                                <input type="hidden" name="imagem_atual" value="<?php echo $_SESSION['img']; ?>">
                            </div>
                            <div class="input_groups">
                                <input type="submit" name="acao" value="Atualizar">
                            </div>
                            <div class="clear"></div>
                        </form>
                    </div>
                </div>
            </main>