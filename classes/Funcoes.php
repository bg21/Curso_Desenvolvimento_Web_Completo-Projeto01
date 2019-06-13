<?php
    //Cargos

    //Funções do painel
    function pegaCargo($indice){
       return Painel::$cargos[$indice];
    }
    /*Quando se coloca o @ significa que vc ñ quer nenhum aviso do php
    caso algo dê errado*/
    function menuSelecionado($selecionado){
        //<i class="fas fa-arrow-left"></i>
        $url = explode('/', @$_GET['url'])[0];
        if($url == $selecionado){
            echo 'class="menu_ativo"';
        }
    }
    function menuSelecionadoIcone($selecionado){
        //<i class="fas fa-arrow-left"></i>
        $url = explode('/', @$_GET['url'])[0];
        if($url == $selecionado){
            echo '<i class="fas fa-chevron-right"></i>';
        }
    }

    //Permissão
    function verificaPermissaoMenu($permissao){
        if($_SESSION['cargo'] >= $permissao){
            //dá pra continuar na página
            return;
        }else{
            echo 'style="display:none;"';
        }
    }
    function verificaPermissaoPagina($permissao){
        if($_SESSION['cargo'] >= $permissao){
            //dá pra continuar na página
            return;
        }else{
            include('../Painel/pages/permissao_negada.php');
            die();
        } 
    }
?>