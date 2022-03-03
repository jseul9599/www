const circle = document.querySelector('.circle');
const scrollItems = document.querySelectorAll('.scroll_item');
const windowHeight = window.innerHeight / 1.35;

window.addEventListener('scroll', scrollHistory);

function scrollHistory(){
    scrollItems.forEach(function(item){
        const itemTop = item.getBoundingClientRect().top;
        if(itemTop < windowHeight){
            item.classList.add('scroll-active');
            circle.style.top = (item.offsetTop + 20) + 'px';
        }else{
            item.classList.remove('scroll-active');
        };

        if(itemTop < 30){
            item.classList.remove('scroll-active');
        };
    });
};
