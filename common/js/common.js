$(document).ready(function(){
    // =============== header ===============
    // Show menu
    $('#gnb > ul').hover(function(){
        $('#headerArea').addClass('active');
        $('#headerArea').animate({height: 330},'fast').clearQueue();
        $('li ul', this).fadeIn('fast',function(){$(this).stop();});
    }, function(){
        if($(window).scrollTop() > 90){
            $('#headerArea').addClass('active');
        }else{
            $('#headerArea').removeClass('active');
        };
        $('#headerArea').animate({height: 90},'fast').clearQueue();
        $('li ul', this).hide();
    });

    // Change header background on scroll
    $(window).on('scroll', function(){
        if($(this).scrollTop() > 90){
            $('#headerArea').addClass('active');
        }else{
            $('#headerArea').removeClass('active');
            var isHovered = $('#gnb > ul').is(":hover");
            if(isHovered){
                $('#headerArea').addClass('active');
            };
        };
    });

    // Set focus on header using tab key
    $('#gnb ul li h3 a').on('focus', function(){
        $('#gnb ul li ul').slideDown('normal');
        $('#headerArea').animate({height: 330},'fast').clearQueue();
        $('#headerArea').addClass('active');
    });

    $('.m5 li:last a').on('blur', function(){
        $('#gnb ul li ul').slideUp('normal');
        $('#headerArea').animate({height: 90},'fast').clearQueue();
    });



    // =============== Back to Top ===============
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
        if ($(this).scrollTop() > 300) {
            $('.topMove').fadeIn('normal');
        } else {
            $('.topMove').fadeOut('fast');
        }
    });				
    $('.topMove').on('click', function(e) {
        e.preventDefault();
        $('html, body').stop().animate({scrollTop: 0}, 500);
    });


    // =============== Family Site ===============
    $('.family_site .arrow').click(function(e){
        e.preventDefault();
        $('.family_site ul').slideToggle();
    });
});