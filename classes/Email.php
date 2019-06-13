<?php
    class Email{
        private $mailer;

        public function __construct($host = null, $username = null, $senha = null, $nome = null){
            $this->mailer = new PHPMailer;

            $this->mailer->isSMTP();                                      // Set mailer to use SMTP
            $this->mailer->Host = $host; //'smtp.gmail.com';               // Host de disparo de emails do seu servidor
            $this->mailer->SMTPAuth = true;                               // Enable SMTP authentication
            $this->mailer->Username = $username; //'missgacy@gmail.com';  //SMTP usuário/email que vai enviar emails
            $this->mailer->Password = $senha; //'batman23';                           // SMTP senha do usuário/email que envia email
            $this->mailer->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $this->mailer->Port = 465;   
            
            $this->mailer->setFrom($username, $nome); //Enviado de 
            $this->mailer->addReplyTo($username, $nome); //Responder para
            $this->mailer->isHTML(true); 
            $this->mailer->CharSet = 'UTF-8'; 
        }


        //Métodos próprios
        public function enviarPara($email, $nome){
            $this->mailer->addAddress($email, $nome);     // Endereço da sua empresa
        }
        public function formatarEmail($info){
            $this->mailer->Subject = $info['Assunto'];
            $this->mailer->Body    = $info['Corpo'];
            $this->mailer->AltBody = strip_tags($info['Corpo']); //Não lembro pq adicionar de novo, mas adiciona pra garantir.
        }
        public function enviarEmail(){ //enviando o email
            if($this->mailer->send()){
                return true;
            }else{
                return false;
            }
        }
    }
?>