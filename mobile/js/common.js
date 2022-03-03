$(document).ready(function(){
    // =============== Header ===============
    //Change header background on scroll
    $(window).on('scroll', function(){
        if($(this).scrollTop() > 30){
            $('#headerArea').addClass('header-active');
        }else{
            $('#headerArea').removeClass('header-active');
        };
    });

    //Show menu
    $('.menu_btn').on('click', function(e){
        e.preventDefault();
        $(this).toggleClass('menu-active');

        if($(this).hasClass('menu-active')){
            $('#headerArea #gnb').css({'transform' : 'translateX(0)', 'opacity' : '1'});
            $('body').css('overflow-y','hidden');
        }else{
            $('#headerArea #gnb').css({'transform' : 'translateX(100%)', 'opacity' : '0'});
            $('body').css('overflow-y','');
        };
    });

    //Show sub menu
    $('#gnb ul li h3 a').on('click', function(e){
        e.preventDefault();

        var others = $(this).parents('li').siblings('li');
        var clickedMenu = $(this).parents('li');

        others.removeClass('active');
        clickedMenu.toggleClass('active');

        if(clickedMenu.hasClass('active')){
            clickedMenu.find('ul').slideDown('fast');
            others.find('ul').slideUp('fast');
        }else{
            clickedMenu.find('ul').slideUp('fast');
        };
    });



    // =============== Footer ===============
    //Back to top
    var topMoveLength = $('.topMove').height();
    var updateScrollProgress = function(){
        var scroll = $(window).scrollTop();
        var documentHeight = $(document).height();
        var windowHeight = $(window).height();
        var progress = (scroll / (documentHeight - windowHeight)) * topMoveLength;
        $('.topMove span').css('height', progress)
    };

    $('.topMove').hide();
    $(window).on('scroll', function() {
        updateScrollProgress();
        if ($(this).scrollTop() > 100) {
            $('.topMove').fadeIn('normal');
        } else {
            $('.topMove').fadeOut('fast');
        }
    });				
    $('.topMove').on('click', function(e) {
        e.preventDefault();
        $('html, body').stop().animate({scrollTop: 0}, 500);
    });

});




