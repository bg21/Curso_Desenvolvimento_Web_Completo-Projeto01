$(function(){
    $('.data').mask('00/00/0000');

    var aberto = true;
    var janelaTamanho = $(window)[0].innerWidth;
    if(janelaTamanho <= 960){
        aberto = false;
        $('.sidebar_desktop').css('width', '0').css('padding', '0');
    }

    
    $('.bars').click(function(){
        if(aberto){
            //menu aberto
            $('.sidebar_desktop').animate({
                'width': '0'
            }, function(){
                aberto = false;
            });
            $('main.main').animate({
                'marginLeft': '0',
                'width':'100%'
            }, function(){
                aberto = false;
            });
        }else{
            //menu fechado
            $('.sidebar_desktop').css('display', 'block');
            $('.sidebar_desktop').animate({
                'width': '250'
            }, function(){
                aberto = true;
            });
            $('main.main').animate({
                'marginLeft': '250',
                'width':'calc(100% - 250px)'
            }, function(){
                aberto = true;
            });
        }
    });


    //Box Diálogo excluir
    $('[actionBtn="excluir"]').click(function(){
        if(confirm("Tem certeza de que deseja excluir o item?") == true) {
            return true;
        }else {
           return false;
        }
    });

});