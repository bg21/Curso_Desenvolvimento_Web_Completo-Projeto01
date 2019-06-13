$(function(){
    $('div.mobile h2 i').click(function(){
        var menu = $('div.mobile nav ul');
        if(menu.is(':hidden') == true){
            menu.slideToggle();
            $('div.mobile h2 i').removeClass('fas fa-bars');
            $('div.mobile h2 i').addClass('fas fa-times');
        }else{
            menu.slideToggle();
            $('div.mobile h2 i').removeClass('fas fa-times');
            $('div.mobile h2 i').addClass('fas fa-bars');
        }
    });

    //Scrolltop
    if($('target').length > 0){
        //o elemento existe, então dê scroll na página
        
        //pegar o elemento através da id e junta com a tag target
        var elemento = '#'+$('target').attr('target');
        //attr significa pegar atributo, que no caso é o target
        var scrollTop = $(elemento).offset().top;
        $('html, body').animate({'scrollTop': scrollTop},1000);
        return false;
    }
    //Scrolltop

    
});