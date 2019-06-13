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
                        <h2><i class="far fa-file"></i> Novo Depoimento</h2>
                        <form method="post" enctype="multipart/form-data">
                        <?php
                            if(isset($_POST['acao'])){
                                
                                if(Painel::inserir($_POST)){
                                    Painel::alerta('sucesso', 'O cadastro do depoimento foi realizado com sucesso');
                                }else{
                                    Painel::alerta('erro', 'Preencha todos os campos.');
                                }
                                
                            }
                        ?>
                            
                            <div class="input_groups">
                                <label>Depoimento:</label>
                                <textarea name="depoimento"></textarea>
                            </div>
                            <div class="input_groups">
                                <label>Seu nome:</label>
                                <input type="text" name="nome_depoimento">
                            </div>
                            <div class="input_groups">
                                <label>Data:</label>
                                <input class="data" type="text" name="data">
                            </div>
                            <div class="input_groups">
                                <input type="hidden" name="order_id" value="0">
                                <input type="hidden" name="nome_tabela" value="tb_site_depoimentos">
                                <input type="submit" name="acao" value="Novo">
                            </div>
                            <div class="clear"></div>
                        </form>
                    </div>
                </div>
            </main>