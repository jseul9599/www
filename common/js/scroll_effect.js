function scrollEffect(){
    const scrollItems = document.querySelectorAll('.scroll_item');
    const windowHeight = window.innerHeight / 1.8;
    
    scrollItems.forEach(function(item){
        const itemTop = item.getBoundingClientRect().top;
        if(itemTop < windowHeight){
            item.classList.add('scroll-active');
        };
    });
};

window.addEventListener('scroll', scrollEffect);