$(document).ready(function(){
    // =============== Header ===============
    $.ajax({
        url: 'header.html',
        dataType: 'html',

        success: function(data){
            $('#headerArea').html(data)

            $(window).on('scroll', function(){
                if($(this).scrollTop() > $(this).height() - 400){
                    $('#headerArea').addClass('header-active');
                }else{
                    $('#headerArea').removeClass('header-active');
                };
            });
        
            $('.menu_btn').on('click', function(e){
                e.preventDefault();
                $(this).toggleClass('open');
        
                if($(this).hasClass('open')){
                    $('#gnb').css({'right':'0'})
                    $('body').css('overflow-y','hidden');
                    //$('#wrap').css('background', 'rgba(0, 0, 0, .7)');
                    //$('#wrap, #content section').css('background', 'red');
                }else{
                    $('#gnb').css({'right':'-100%'})
                    $('body').css('overflow-y','');
                    //$('#wrap').css('background', '');
                };
            });
        
            $(window).resize(function(){
                if($(window).width() > 1024){
                    $('#wrap').css('background', '');
                    $('body').css('overflow-y','');
                }else if($(window).width() <= 1024 && $('.menu_btn').hasClass('open')){
                    $('body').css('overflow-y','hidden');
                    $('#wrap').css('background', 'rgba(0, 0, 0, .7)');
                }
            })
        }
    });

    
    
    // =============== Footer ===============
    $.ajax({
        url: 'footer.html',
        dataType: 'html',

        success: function(data){
            $('#footerArea').html(data);

            //Back to top		
            $('.topMove').on('click', function(e) {
                e.preventDefault();
                $('html, body').stop().animate({scrollTop: 0}, 500);
            });
        }
    });
});