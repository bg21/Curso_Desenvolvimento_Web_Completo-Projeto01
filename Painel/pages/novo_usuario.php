        <?php verificaPermissaoPagina(2); ?>
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
                        <h2><i class="fas fa-user-edit"></i> Novo usuário</h2>
                        <form method="post" enctype="multipart/form-data">
                        <?php
                            if(isset($_POST['acao'])){
                                $nome = $_POST['nome'];
                                $email = $_POST['email'];
                                $usuario = $_POST['usuario'];
                                $senha = $_POST['senha'];
                                $cargo = $_POST['cargo'];
                                $img = $_FILES['img'];
                                
                                if($nome == ''){
                                    Painel::alerta('erro', 'O campo "Nome" não pode estar vazio.');
                                }else if($email == ''){
                                    Painel::alerta('erro', 'O campo "Email" não pode estar vazio.');
                                }else if($usuario == ''){
                                    Painel::alerta('erro', 'O campo "Usuario" não pode estar vazio.');
                                }else if($senha == ''){
                                    Painel::alerta('erro', 'O campo "Senha" não pode estar vazio.');
                                }else if($cargo == ''){
                                    Painel::alerta('erro', 'O campo "Cargo" não pode estar vazio.');
                                }else if($img['name'] == ''){
                                    Painel::alerta('erro', 'Selecione uma imagem.');
                                }else{
                                    if($cargo >= $_SESSION['cargo']){
                                        Painel::alerta('erro', 'Você precisa selecionar um cargo menor que o seu.');
                                    }else if(Painel::imagemValida($img) == false){
                                        Painel::alerta('erro', 'Informe um formato de imagem correto.<br> *Formatos permitidos: jpg, png e jpeg.');
                                    }else if(Usuarios::usuarioExiste($usuario)){
                                        Painel::alerta('erro', 'O usuário já existe no sistema.<br>Escolha outro por favor.');
                                    }else{
                                        //Cadastre no banco de dados
                                        $img = Painel::uploadFile($img);
                                        Usuarios::cadastrarUsuario($nome, $email, $cargo, $usuario, $senha, $img);
                                        Painel::alerta('sucesso', 'O cadastro do usuário <b>'.$usuario.'</b> foi realizado com sucesso!');
                                    }
                                }
                            }
                        ?>
                            <div class="input_groups">
                                <label>Nome:</label>
                                <input  type="text" name="nome">
                            </div>
                            <div class="input_groups">
                                <label>Email:</label>
                                <input  type="email" name="email">
                            </div>
                            <div class="input_groups">
                                <label>Usuario:</label>
                                <input type="text" name="usuario">
                            </div>
                            <div class="input_groups">
                                <label>Senha:</label>
                                <input  type="password" name="senha">
                            </div>
                            <div class="input_groups">
                                <label>Cargo:</label>
                                <select  name="cargo">
                                    <?php
                                        foreach (Painel::$cargos as $key => $value) {
                                            /*A key sendo menor que o cargo impossibilita que
                                            um novo administrador seja criado */
                                            if($key < $_SESSION['cargo']){
                                                echo '<option value="'.$key.'">'.$value.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="input_groups">
                                <label>Imagem:</label>
                                <input  type="file" name="img">
                            </div>
                            <div class="input_groups">
                                <input type="submit" name="acao" value="Novo">
                            </div>
                            <div class="clear"></div>
                        </form>
                    </div>
                </div>
            </main>