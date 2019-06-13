<?php
    session_start();//inicia a sessão
    date_default_timezone_set('America/Sao_Paulo');
    $autoLoad = function($class){
        if($class == 'Email'){
            include('classes/phpmailer/PHPMailerAutoload.php');
        }
        include('classes/'.$class.'.php');
    };
    spl_autoload_register($autoLoad);

    define('INCLUDE_PATH','http://localhost/DankiCode/Curso_Desenvolvimento_Web_Completo/09a14_Projeto01/');
    define('INCLUDE_PATH_PAINEL','http://localhost/DankiCode/Curso_Desenvolvimento_Web_Completo/09a14_Projeto01/Painel/');
    //alterando o diretório de imagens de usuário para uploads
    define('BASE_DIR_PAINEL', __DIR__.'/Painel');
    
    const host = 'localhost';
    const dbname = 'projeto_01';
    const user = 'root';
    const senha = '';
    
?>