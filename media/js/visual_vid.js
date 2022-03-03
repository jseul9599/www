$(document).ready(function(){
    // =============== Visual ===============
    // Change image/video when window is resized
    let screenSize, screenHeight;
    let current = false;

    function screen_size(){
        screenSize = $(window).width();
        screenHeight = $(window).height();
        $("#content").css('margin-top',screenHeight);

        if(screenSize > 768 && current == false){
            $("#videoBG").show();
            $("#videoBG").attr('src','./images/visual_vid.mp4');
            $("#imgBG").hide();
            current = true;
        };
        if(screenSize <= 768){
            $("#videoBG").hide();
            $("#videoBG").attr('src','');
            $("#imgBG").show();
            current = false;
        };
    };
    screen_size();

    $(window).resize(function(){
        screen_size();
    });


    
    // =============== Scroll Down ===============
    $('.scroll_down').click(function(){
        screenHeight = $(window).height();
        $('html,body').animate({'scrollTop':screenHeight}, 1000);
    });
})