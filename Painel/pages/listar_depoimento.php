          <?php
            //Excluir
            if(isset($_GET['excluir'])){
                $idExcluir = (int) $_GET['excluir'];
                /*cast é quando vc coloca algo na frente da variável pra definir como será,
                exemplo o (int) na frente do $_GET pra dizer que vai pegar só número, ou seja, só o id */
                Painel::deletar('tb_site_depoimentos', $idExcluir);
                Painel::redirecionamento(INCLUDE_PATH_PAINEL.'listar_depoimento');
            }
            
            //Ordenação
            if(isset($_GET['order']) && isset($_GET['id'])){
                Painel::orderItens('tb_site_depoimentos', $_GET['order'], $_GET['id']);
            }

            //Paginação
            $paginaAtual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
            /*significa que vai pegar um número e ñ uma string
            o get['pagina'] sempre vai ser no formato de inteiro então ñ tem como
            ocorrer sql injection (realiza por string) */
            $itensPorPagina = 10;
        
            $depoimentos = Painel::selectAll('tb_site_depoimentos', ($paginaAtual - 1) * $itensPorPagina, $itensPorPagina);
            
           
            
            //Do jeito abaixo ou através do método acima.
            //$sql = Conexao::conectar()->prepare("SELECT * FROM tb_site_depoimentos");
            //$sql->execute();
            //$depoimentos = $sql->fetchAll();
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
                        <h2><i class="far fa-file"></i> Listar depoimentos</h2>
                        <div class="wraper_table">
                            <table>
                                <tr>
                                    <td>Depoimento</td>
                                    <td>Autor</td>
                                    <td>Data</td> 
                                    <td>#</td>
                                    <td>#</td>
                                    <td>Editar</td>
                                    <td>Excluir</td>
                                </tr>
                                <?php
                                    foreach ($depoimentos as $key => $value) {                            
                                ?>
                                <tr>
                                    <td><?php echo substr($value['depoimento'], 0, 60).'...'; ?></td>
                                    <td><?php echo $value['nome_depoimento']; ?></td>
                                    <td><?php echo $value['data']; ?></td> 
                                    <td class="btn_order"><a href="<?php echo INCLUDE_PATH_PAINEL; ?>listar_depoimento?order=up&id=<?php echo $value['id']; ?>"><i class="fas fa-arrow-up"></i></a></td>
                                    <td class="btn_order"><a href="<?php echo INCLUDE_PATH_PAINEL; ?>listar_depoimento?order=down&id=<?php echo $value['id']; ?>"><i class="fas fa-arrow-down"></i></a></td>
                                    <td class="btn_edit"><a href="<?php echo INCLUDE_PATH_PAINEL; ?>editar_depoimento?id=<?php echo $value['id']; ?>"><i class="fas fa-edit"></i></a></td> 
                                    
                                    <!--Excluindo através da url com id-->
                                    <td class="btn_excluir"><a actionBtn="excluir" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar_depoimento?excluir=<?php echo $value['id']; ?>"><i class="fas fa-trash-alt"></i></a></td> 
                                </tr>
                                    <?php } ?>
                            </table>
                        </div>
                        <div class="paginacao">
                            <?php
                                $totalPaginas = ceil(count(Painel::selectAll('tb_site_depoimentos')) / $itensPorPagina);
                                /*count() calcula o número de elementos do array*/
                                /*o ceil vai arredondar para o próximo inteiro, então se for 1.5 vai pra 2 */
                                //page_selecionada
                                for($i = 1; $i <= $totalPaginas; $i++){
                                    if($i == $paginaAtual){
                                        echo '<a class="page_selecionada" href="'.INCLUDE_PATH_PAINEL.'listar_depoimento?pagina='.$i.'">'.$i.'</a>';
                                    }else{
                                        echo '<a href="'.INCLUDE_PATH_PAINEL.'listar_depoimento?pagina='.$i.'">'.$i.'</a>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </main>