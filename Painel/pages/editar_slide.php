            <?php
                if(isset($_GET['id'])){
                    $id = (int) $_GET['id'];
                    $slide = Painel::select('tb_site_slides', 'id = ?', [$id]);
                }else{
                    Painel::alerta('erro', 'Passe um id');
                    die();
                }
               
            ?>
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
                                $imagem = $_FILES['slide'];
                                $imagem_atual = $_POST['slide_atual'];
                                
                                if($imagem['name'] != ''){
                                    if(Painel::imagemValida($imagem)){
                                        Painel::deletarFile($imagem_atual);
                                        include '../classes/WideImage/WideImage.php';
                                        $imagem = Painel::uploadFile($imagem);
                                        WideImage::load('uploads/'.$imagem)->resize(100)->saveToFile('uploads/'.$imagem);
                                        $arr = ['nome'=>$nome, 'slide'=>$imagem, 'id'=>$id, 'nome_tabela'=>'tb_site_slides'];
                                        Painel::atualizar($arr); 
                                        $slide = Painel::select('tb_site_slides', 'id = ?', [$id]);                                       
                                        Painel::alerta('sucesso', 'Atualizado com sucesso');
                                    }else{
                                        Painel::alerta('erro', 'O formato de imagem não é válido');
                                    }
                                }else{
                                    $imagem = $imagem_atual;
                                    Painel::deletarFile($imagem_atual);
                                    $arr = ['nome'=>$nome, 'slide'=>$imagem, 'id'=>$id, 'nome_tabela'=>'tb_site_slides'];
                                    Painel::atualizar($arr);
                                    $slide = Painel::select('tb_site_slides', 'id = ?', [$id]);                                    
                                    Painel::alerta('sucesso', 'Atualizado com sucesso');
                                }
                                
                            }
                            
                        ?>
                            <div class="input_groups">
                                <label>Nome:</label>
                                <input required type="text" name="nome" value="<?php echo $slide['nome']; ?>">
                            </div>
                           
                            <div class="input_groups">
                                <label>Imagem:</label>
                                <input type="file" name="slide">
                                <input type="hidden" name="slide_atual" value="<?php echo $slide['slide']; ?>">
                            </div>
                            <div class="input_groups">
                                <input type="submit" name="acao" value="Atualizar">
                            </div>
                            <div class="clear"></div>
                        </form>
                    </div>
                </div>
            </main>