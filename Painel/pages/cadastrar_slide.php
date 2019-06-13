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
                        <h2><i class="fas fa-user-edit"></i> Novo Slide</h2>
                        <form method="post" enctype="multipart/form-data">
                        <?php
                            
                            if(isset($_POST['acao'])){
                                $nome = $_POST['nome'];
                                $slide = $_FILES['slide'];
                                
                                if($nome == ''){
                                    Painel::alerta('erro', 'O campo "Nome" não pode estar vazio.');
                                }else if($slide == ''){
                                    Painel::alerta('erro', 'O campo "Slide" não pode estar vazio.');
                                }else{
                                    if(Painel::imagemValida($slide) == false){
                                        Painel::alerta('erro', 'Informe um formato de imagem correto.<br> *Formatos permitidos: jpg, png e jpeg.');
                                    }else{
                                        //Cadastre no banco de dados
                                        include '../classes/WideImage/WideImage.php';
                                        $slide = Painel::uploadFile($slide);
                                        WideImage::load('uploads/'.$slide)->resize(100)->saveToFile('uploads/'.$slide);
                                        Slide::cadastrarSlide($nome, $slide);
                                        Painel::alerta('sucesso', 'O cadastro do slide foi realizado com sucesso!');
                                    }
                                }
                            }
                        ?>
                            <div class="input_groups">
                                <label>Nome:</label>
                                <input type="text" name="nome">
                            </div>
                            
                            <div class="input_groups">
                                <label>Slide:</label>
                                <input  type="file" name="slide">
                            </div>
                            <div class="input_groups">
                                <input type="submit" name="acao" value="Novo">
                            </div>
                            <div class="clear"></div>
                        </form>
                    </div>
                </div>
            </main>