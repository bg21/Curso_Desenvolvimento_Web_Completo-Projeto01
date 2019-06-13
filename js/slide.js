$(function(){
    var atual = 0;
    var delay = 3000;
    var slider = $('section.bg div.bg_single').length -1;
    
    iniciarSlide();
    alterSlide();
    
    function iniciarSlide(){
        $('section.bg div.bg_single').hide();
        $('section.bg div.bg_single').eq(0).show(); 
    }
    function alterSlide(){
        setInterval(function(){
            $('section.bg div.bg_single').eq(atual).fadeOut(2000);
            atual++;
            $('section.bg div.bg_single').eq(atual).fadeIn(2000);
            if(atual > slider){
                atual = 0;
                $('section.bg div.bg_single').eq(atual).fadeIn(2000);
            }
            
        }, delay);
    }
});