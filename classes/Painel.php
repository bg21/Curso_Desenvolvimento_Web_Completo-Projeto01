<?php
    class Painel{
        public static $cargos = [
            '0' => 'Outro',
            '1' => 'Usuário',
            '2' => 'Administrador'
        ];
        public static function logado(){
            return isset($_SESSION['login']) ? true : false;
        }
        public static function logout(){
            setcookie('lembrarme', true, time() - 1, '/'); /*quando sair 
            vai destruir o cookie se existir
            essa '/' é pra pegar em todo o site*/
            session_destroy();
            header('Location: '.INCLUDE_PATH_PAINEL);
        }
        public static function carregarPagina(){
            if(isset($_GET['url'])){
                $url = explode('/', $_GET['url']);
                if(file_exists('pages/'.$url[0].'.php')){
                    include('pages/'.$url[0].'.php');
                }else{
                    //Caso não exista a página
                    //dê um include em uma página 404 personalizada
                    header('Location: '.INCLUDE_PATH_PAINEL);
                }
            }else{
                include('pages/home.php');
            }
        }
        
        public static function listarUsuariosOnline(){
            self::limparUsuariosOnline();
            $sql = Conexao::conectar()->prepare("SELECT * FROM tb_painel_online");
            $sql->execute();
            return $sql->fetchAll();
        }
        public static function limparUsuariosOnline(){
            /*Quando passar do tempo limite de dois minutos o usuário
            online será deletado*/
            /*Aqui ñ precisa preparar a execução */
            $date = date('Y-m-d H:i:s');
            $sql = Conexao::conectar()->exec("DELETE FROM tb_painel_online WHERE ultima_acao < '$date' - INTERVAL 2 MINUTE");
        }

        public static function alerta($tipo, $mensagem){
            if($tipo == 'sucesso'){
                echo '<div class="box_alerta sucesso"><i class="fas fa-check-circle"></i> '.$mensagem.'</div>';
            }else if($tipo == 'erro'){
                echo '<div class="box_alerta erro"><i class="fas fa-exclamation-circle"></i> '.$mensagem.'</div>';
            }
        }
        public static function imagemValida($img){
            //https://www.php.net/manual/pt_BR/function.image-type-to-mime-type.php
            if($img['type'] == 'image/jpeg' || $img['type'] == 'image/png'){
                //Verificar o tamanho agora
                $tamanho = intval($img['size']/1024);
                if($tamanho < 400){
                    return true;
                }else{
                    return false;
                }
                //é uma imagem
            }else{
                return false;
                //não é uma imagem
            }
        }
        public static function uploadFile($file){
            $formatoArquivo = explode('.',$file['name']); //assim vc pega o nome do arquivo
            $nomeImagem = uniqid().'.'.$formatoArquivo[count($formatoArquivo) - 1]; //vai gerar um id único
            if(move_uploaded_file($file['tmp_name'], BASE_DIR_PAINEL.'/uploads/'.$nomeImagem)){
                return $nomeImagem;
            }else{
                return false;
            }
        }
        public static function deletarFile($file){
            @unlink('uploads/'.$file);
        }

        //Não vamos utilizar esse método para inserção de dados, muito chato
        public static function inserir($post){
            $campoPreenchido = true;
            $nome_tabela = $post['nome_tabela'];
            $query = "INSERT INTO $nome_tabela VALUES (null";
            foreach ($post as $key => $value) {
                $nome = $key;
                $valor = $value;
                if($nome == 'acao' || $nome == 'nome_tabela'){
                    continue;
                    /*desse jeito quando chegar no acao ele vai continuar
                    montando os valores sem adicionar o post acao */
                }
                if($value == ''){
                    $campoPreenchido = false;
                    break;
                }
                $query.=", ?";
                $parametros[] = $value;
                /*colocando o [] vc diz para o php incrementar sozinho */
            }
            $query.=")";
            if($campoPreenchido == true){
                $sql = Conexao::conectar()->prepare($query);
                $sql->execute($parametros);
                
                $lastId = Conexao::conectar()->lastInsertId();
                $sql = Conexao::conectar()->prepare("UPDATE $nome_tabela SET order_id = ? WHERE id = $lastId");
                $sql->execute([$lastId]);
                /*faça esse código se quiser que o último item adicionado vá para o final e não no início
                */
            }
            return $campoPreenchido;
        }

        //Vamos usar esse método pra selecionar tudo, já com paginação
        public static function selectAll($tabela, $inicio = null, $final = null){
            if($inicio == null && $final == null){ //quer dizer que tá selecionando tudo, é o padrão
                $sql = Conexao::conectar()->prepare("SELECT * FROM $tabela ORDER BY order_id ASC");
            }else{
                $sql = Conexao::conectar()->prepare("SELECT * FROM $tabela ORDER BY order_id ASC LIMIT $inicio, $final");
            }
            $sql->execute();
            return $sql->fetchAll();
        }

        //Selecionar algo específico, apenas um registro
        public static function select($tabela, $query, $arr){
            $sql = Conexao::conectar()->prepare("SELECT * FROM $tabela WHERE $query");
            $sql->execute($arr);
            return $sql->fetch();
        }

        //Deletar, vamos usar essa também
        public static function deletar($tabela, $id = false){
            /*se for id como false significa que quer que delete tudo */
            if($id == false){
                $sql = Conexao::conectar()->prepare("DELETE FROM $tabela");
            }else{
                $sql = Conexao::conectar()->prepare("DELETE FROM $tabela WHERE id = ?");
            }
            $sql->execute([$id]); 
        }

        public static function atualizar($post){
            $campoPreenchido = true;
            $first = false;
            $nome_tabela = $post['nome_tabela'];
            $query = "UPDATE $nome_tabela SET ";
            foreach ($post as $key => $value) {
                $nome = $key;
                $valor = $value;
                if($nome == 'acao' || $nome == 'nome_tabela' || $nome == 'id'){
                    continue;
                    /*desse jeito quando chegar no acao ele vai continuar
                    montando os valores sem adicionar o post acao */
                }
                if($value == ''){
                    $campoPreenchido = false;
                    break;
                }
                if($first == false){
                    $first = true;
                    $query.="$nome=?";
                }else{
                    $query.=", $nome=?";
                }
                $parametros[] = $value;
                /*colocando o [] vc diz para o php incrementar sozinho */
            }
            
            if($campoPreenchido == true){
                $parametros[] = $post['id'];
                $sql = Conexao::conectar()->prepare($query. ' WHERE id = ?');
                $sql->execute($parametros);
                //header('Location: '.INCLUDE_PATH_PAINEL. 'listar_depoimento');
            }
            return $campoPreenchido;
        }

        //Usar também caso necessário
        //redirecionamento de página com javascript, usar quando o do php não der certo
        public static function redirecionamento($url){
            echo '<script>location.href="'.$url.'"</script>';
        }

        //Pra criar isso vc vai precisar alterar o select()
        public static function orderItens($tabela, $order, $idItem){
            if($order == 'up'){
                $infoItemAtual = Painel::select($tabela, 'id = ?', [$idItem]); //está selecionando
                $order_id = $infoItemAtual['order_id'];
                $itemBefore = Conexao::conectar()->prepare("SELECT * FROM $tabela WHERE order_id < $order_id ORDER BY order_id DESC LIMIT 1");
                $itemBefore->execute();
                if($itemBefore->rowCount() == 0){
                    return;
                }
                $itemBefore = $itemBefore->fetch();
                Painel::atualizar(['nome_tabela'=>$tabela, 'id'=>$itemBefore['id'], 'order_id'=>$infoItemAtual['order_id']]);
                Painel::atualizar(['nome_tabela'=>$tabela, 'id'=>$infoItemAtual['id'], 'order_id'=>$itemBefore['order_id']]);
            }else if($order == 'down'){
                $infoItemAtual = Painel::select($tabela, 'id = ?', [$idItem]); //está selecionando
                $order_id = $infoItemAtual['order_id'];
                $itemBefore = Conexao::conectar()->prepare("SELECT * FROM $tabela WHERE order_id > $order_id ORDER BY order_id ASC LIMIT 1");
                $itemBefore->execute();
                if($itemBefore->rowCount() == 0){
                    return;
                }
                $itemBefore = $itemBefore->fetch();
                Painel::atualizar(['nome_tabela'=>$tabela, 'id'=>$itemBefore['id'], 'order_id'=>$infoItemAtual['order_id']]);
                Painel::atualizar(['nome_tabela'=>$tabela, 'id'=>$infoItemAtual['id'], 'order_id'=>$itemBefore['order_id']]);
            }
        }

    }

?>