<?php
    
    class Site{
        //Visitantes online
        public static function updateUsuarioOnline(){
            if(isset($_SESSION['online'])){
                $token = $_SESSION['online'];
                $horarioAtual = date('Y-m-d H-i-s');
                /*Esse $checar vai verificar se existe uma sessão, se
                existir pode atualizar, senão existir vai inserir novamente*/
                $checar = Conexao::conectar()->prepare("SELECT * FROM tb_painel_online WHERE token = ?");
                $checar->execute([$_SESSION['online']]);
                if($checar->rowCount() == 1){
                    $sql = Conexao::conectar()->prepare("UPDATE tb_painel_online SET ultima_acao = ? WHERE token = ?");
                    $sql->execute([$horarioAtual, $token]);
                }else{
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $token = $_SESSION['online'];
                    $horarioAtual = date('Y-m-d H-i-s');
                    $sql = Conexao::conectar()->prepare("INSERT INTO tb_painel_online VALUES (null, ?, ?, ?)");
                    $sql->execute([$ip, $horarioAtual, $token]);
                }
            }else{
                $_SESSION['online'] = uniqid(); //essa função gera um id único sempre
                $ip = $_SERVER['REMOTE_ADDR'];
                $token = $_SESSION['online'];
                $horarioAtual = date('Y-m-d H-i-s');
                $sql = Conexao::conectar()->prepare("INSERT INTO tb_painel_online VALUES (null, ?, ?, ?)");
                $sql->execute([$ip, $horarioAtual, $token]);
            }
        }
        //Contador de visitas
        public static function contadorDeUsuarios(){
            if(!isset($_COOKIE['visita'])){
                /*se ñ existir o cookie visita quer dizer que o usuário 
                ainda não foi registrado como novo visitante no site
                vai contar usuários diferentes e não toda vez que o usuário
                abre o navegador*/
                setcookie('visita', true, time() + (60*60*24)); 
                /*esse time() pega os segundos atuais e soma com o que quero*/
                /*Esse cookie vai levar um dia para expirar
                60*60 é uma hora, vezes 24 dá um dia*/
                $ip = $_SERVER['REMOTE_ADDR'];
                $data = date('Y-m-d');
                $sql = Conexao::conectar()->prepare("INSERT INTO tb_painel_visitas VALUES (null, ?, ?)");
                $sql->execute([$ip, $data]);
            }
        }

        public static function atualizarSite($titulo, $nome_autor, $descricao_autor, $icone1, $titulo_icone1, $descricao_icone1, $icone2, $titulo_icone2, $descricao_icone2, $icone3, $titulo_icone3, $descricao_icone3){
            $sql = Conexao::conectar()->prepare("UPDATE tb_site_config set titulo = ?, nome_autor = ?, descricao_autor = ?, icone1 = ?, titulo_icone1 = ?, descricao_icone1 = ?, icone2 = ?, titulo_icone2 = ?, descricao_icone2 = ?, icone3 = ?, titulo_icone3 = ?, descricao_icone3 = ?");
            if($sql->execute([$titulo, $nome_autor, $descricao_autor, $icone1, $titulo_icone1, $descricao_icone1, $icone2, $titulo_icone2, $descricao_icone2, $icone3, $titulo_icone3, $descricao_icone3])){
                return true;
            }else{
                return false;
            }
        }
    }

?>