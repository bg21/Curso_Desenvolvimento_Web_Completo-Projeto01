            <?php
            
                if(isset($_GET['id'])){
                    $id = (int) $_GET['id'];
                    $depoimento = Painel::select('tb_site_depoimentos', 'id = ?', [$id]);
                }else{
                    Painel::alerta('erro', 'Você precisa selecionar um item');
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
                        <h2><i class="far fa-file"></i> Editar Depoimento</h2>
                        <form method="post" enctype="multipart/form-data">
                        <?php
                            if(isset($_POST['acao'])){
                                if(Painel::atualizar($_POST)){
                                    Painel::alerta('sucesso', 'O depoimento foi editado com sucesso!');
                                    $depoimento = Painel::select('tb_site_depoimentos', 'id = ?', [$id]);
                                }else{
                                    Painel::alerta('erro', 'Preencha todos os campos.');
                                }
                            }
                              
                        ?>
                            
                            <div class="input_groups">
                                <label>Depoimento:</label>
                                <textarea name="depoimento"><?php echo $depoimento['depoimento']; ?></textarea>
                            </div>
                            <div class="input_groups">
                                <label>Seu nome:</label>
                                <input type="text" name="nome_depoimento" value="<?php echo $depoimento['nome_depoimento']; ?>">
                            </div>
                            <div class="input_groups">
                                <label>Data:</label>
                                <input class="data" type="text" name="data" value="<?php echo $depoimento['data']; ?>">
                            </div>



                            <div class="input_groups">
                                <input type="hidden" name="id" value="<?php echo $depoimento['id']; ?>">
                                <input type="hidden" name="nome_tabela" value="tb_site_depoimentos">
                                <input type="submit" name="acao" value="Atualizar">
                            </div>
                            <div class="clear"></div>
                        </form>
                    </div>
                </div>
            </main>