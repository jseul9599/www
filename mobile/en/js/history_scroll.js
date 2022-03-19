const circle = document.querySelector('.circle');
const scrollItems = document.querySelectorAll('.scroll_item');
const windowHeight = window.innerHeight / 1.4;

window.addEventListener('scroll', scrollHistory);

function scrollHistory(){
    scrollItems.forEach(function(item){
        const itemTop = item.getBoundingClientRect().top;
        if(itemTop < windowHeight){
            item.classList.add('scroll-active');
            circle.style.top = (item.offsetTop + 15) + 'px';
        }else{
            item.classList.remove('scroll-active');
        };

        if(itemTop < 30){
            item.classList.remove('scroll-active');
        };
    });
};
