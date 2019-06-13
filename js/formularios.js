$(function(){

    $('body').on('submit', 'form', function(){
        var form = $(this);
        $.ajax({
            beforeSend: function(){
                $('.load').fadeIn();
            },
            url: 'ajax/formularios.php',
            method: 'post',
            dataType: 'json', //tipo de resposta que estamos esperando do servidor
            data:form.serialize()
        }).done(function(data){
            if(data.sucesso == true){
                console.log('Email enviado com sucesso.');
                $('.load').fadeOut();
                $('.sucesso').fadeIn();
                setTimeout(function(){
                    $('.sucesso').fadeOut(3000);
                }, 3000);
            }else{
                console.log('Erro ao enviar o email.'); 
                $('.load').fadeOut();
                $('.erro').fadeIn();
                setTimeout(function(){
                    $('.erro').fadeOut(3000);
                }, 3000);
            }   
        });
        return false;
    });

});