const subArray = ['Story', 'Characters', 'Videos', 'Gallery'];

const pageAddress = window.location.href;
const pageIndex = pageAddress.indexOf('sub');
const pageNumber = pageAddress.substring(pageIndex).split('')[3];

$(document).ready(function(){
    // =============== Visual ===============
    // Generate visual title
    const visualTitle= document.querySelector('.videoBox p');
    visualTitle.textContent = subArray[pageNumber - 1];
    visualTitle.setAttribute('data-text', subArray[pageNumber - 1]);

    const visualImg= document.querySelector('.videoBox img');

    // Change image when Window is resized
    let screenSize, screenHeight;
    function screen_size(){
        screenSize = $(window).width();
        screenHeight = $(window).height();
        $("#content").css('margin-top',screenHeight);

        if(screenSize > 768){
            visualImg.src = `./images/sub${pageNumber}/sub_bg.jpg`;
        };
        if(screenSize <= 768){
            visualImg.src = `./images/sub${pageNumber}/sub_bg_small.jpg`;
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

});
