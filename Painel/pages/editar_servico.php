<?php
            
            if(isset($_GET['id'])){
                $id = (int) $_GET['id'];
                $servico = Painel::select('tb_site_servicos', 'id = ?', [$id]);
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
                    <h2><i class="far fa-file"></i> Editar Serviço</h2>
                    <form method="post">
                    <?php
                        if(isset($_POST['acao'])){
                            if(Painel::atualizar($_POST)){
                                Painel::alerta('sucesso', 'O serviço foi editado com sucesso!');
                                $servico = Painel::select('tb_site_servicos', 'id = ?', [$id]);
                            }else{
                                Painel::alerta('erro', 'Preencha todos os campos.');
                            }
                        }
                          
                    ?>
                        
                        <div class="input_groups">
                            <label>Serviço:</label>
                            <textarea name="servico"><?php echo $servico['servico']; ?></textarea>
                        </div>
                        
                        <div class="input_groups">
                            <input type="hidden" name="id" value="<?php echo $servico['id']; ?>">
                            <input type="hidden" name="nome_tabela" value="tb_site_servicos">
                            <input type="submit" name="acao" value="Atualizar">
                        </div>
                        <div class="clear"></div>
                    </form>
                </div>
            </div>
        </main>