<?php
    class Slide{
        //Criar
        public static function cadastrarSlide($nome, $slide){
            $order = 'order_id';
            $sql = Conexao::conectar()->prepare("INSERT INTO tb_site_slides VALUES (null, ?, ?, ?)");
            $sql->execute([$nome, $slide, $order]);
            /*Abaixo vai cadastrar o order_id da tabela. */
            $lastId = Conexao::conectar()->lastInsertId();
            $sql = Conexao::conectar()->prepare("UPDATE tb_site_slides SET order_id = ? WHERE id = $lastId");
            $sql->execute([$lastId]);
        }

        //criar um pra Edditar, deletar e selecionar
    }

?>