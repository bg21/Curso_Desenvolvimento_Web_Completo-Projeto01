<?php
    class Usuarios{
        public static function atualizarUsuario($nome, $senha, $img){
            $sql = Conexao::conectar()->prepare("UPDATE tb_painel_usuarios set nome = ?, senha = ?, img = ? WHERE usuario = ?");
            if($sql->execute([$nome, $senha, $img, $_SESSION['usuario']])){
                return true;
            }else{
                return false;
            }
        }
        public static function usuarioExiste($usuario){
            $sql = Conexao::conectar()->prepare("SELECT * FROM tb_painel_usuarios WHERE usuario = ?");
            $sql->execute([$usuario]);
            if($sql->rowCount() == 1){
                /*se o número de resultados for igual a 1 é pq já existe um
                usuário*/
                return true;
            }else{
                return false;
                //podemos cadastrar
            }
        }
        public static function cadastrarUsuario($nome, $email, $cargo, $usuario, $senha, $img){
            $sql = Conexao::conectar()->prepare("INSERT INTO tb_painel_usuarios VALUES (null, ?, ?, ?, ?, ?, ?)");
            $sql->execute([$nome, $email, $cargo, $usuario, $senha, $img]);
        }
    }

?>