<?php
    $usuariosOnline = Painel::listarUsuariosOnline();
    
    //Crie um método para isso
    //listando Visitas totais
    $visitasTotais = Conexao::conectar()->prepare("SELECT * FROM tb_painel_visitas");
    $visitasTotais->execute();
    $visitasTotais = $visitasTotais->rowCount();
    
    //Crie um método para isso
    //listando Visitas hoje
    $data = date('Y-m-d');
    $visitasHoje = Conexao::conectar()->prepare("SELECT * FROM tb_painel_visitas WHERE dia = ?");
    $visitasHoje->execute([$data]);
    $visitasHoje = $visitasHoje->rowCount();
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
                        <h2><i class="fas fa-home"></i> Painel de Controle</h2>
                        <div class="flex">
                            <div class="box_metricas w33"> 
                                <h2>Usuários online</h2>
                                <p><?php echo count($usuariosOnline); ?></p> 
                            </div>
                            <div class="box_metricas w33"> 
                                <h2>Visitas hoje</h2>
                                <p><?php echo $visitasHoje; ?></p>   
                            </div>
                            <div class="box_metricas w33">
                                <h2>Total de visitas</h2>  
                                <p><?php echo $visitasTotais; ?></p>  
                            </div>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="box_content w50" style="overflow-y: auto;">
                            <h2><i class="fas fa-users"></i> Usuários online no site</h2>
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col">
                                        <span>IP</span>
                                    </div>
                                    <div class="col">
                                        <span>Última ação</span>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                    
                                <?php
                                    foreach ($usuariosOnline as $key => $value) {                                
                                ?>
                                <div class="row">
                                    <div class="col">
                                        <span><?php echo $value['ip']; ?></span>
                                    </div>
                                    <div class="col">
                                        <!--
                                            date('d/m/Y H:i:s',strtotime($value['ultima_acao']));
                                            esse strtotime vai converter a hora que estamos recebendo no formato que passarmos
                                        -->
                                        <span><?php echo date('d/m/Y H:i:s',strtotime($value['ultima_acao'])); ?></span>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>


                        <div class="box_content w50">  
                            <h2><i class="fas fa-users"></i> Usuários do sistema</h2>
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col">
                                        <span>Usuário</span>
                                    </div>
                                    <div class="col">
                                        <span>Cargo</span>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                    
                                <?php
                                    //Crie um método para isso
                                    $usuariosPainel = Conexao::conectar()->prepare("SELECT * FROM tb_painel_usuarios");
                                    $usuariosPainel->execute();
                                    $usuariosPainel = $usuariosPainel->fetchAll();

                                    foreach ($usuariosPainel as $key => $value) {                                
                                ?>
                                <div class="row">
                                    <div class="col">
                                        <span><?php echo $value['usuario']; ?></span>
                                    </div>
                                    <div class="col">
                                        <span><?php echo pegaCargo($value['cargo']); ?></span>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>


                    <!--
                    <div class="flex">
                        <div class="box_content w50">  
                        </div>
                        <div class="box_content w50">  
                        </div>
                    </div>
                    <div class="flex">
                        <div class="box_content w33">  
                        </div>
                        <div class="box_content w33">  
                        </div>
                        <div class="box_content w33">  
                        </div>
                    </div>
                    -->
                </div>
            </main>