// =============== visual ===============
const visualSlides = [...document.querySelectorAll('.visual_slider li')];
const visualBullets = [...document.querySelectorAll('.visual_bullets span:not(.visual_control)')];

let cnt = 1;
function moveVisualSlide(){
  if(cnt === visualSlides.length){cnt = 0};

  visualSlides.forEach((slide) =>{
    slide.classList.remove('slide-active');
  });
  visualSlides[cnt].classList.add('slide-active');

  visualBullets.forEach((bullet) =>{
    bullet.classList.remove('bullet-active');
  });
  visualBullets[cnt].classList.add('bullet-active');

  cnt++;
};

let autoVisual = setInterval(moveVisualSlide, 5000);

// Click the bullet buttons to change the images
visualBullets.forEach((bullet, index) => {
  bullet.addEventListener('click', (e) => {
    clearInterval(autoVisual);
    
    visualSlides.forEach((slide) =>{
      slide.classList.remove('slide-active');
    });
    visualSlides[index].classList.add('slide-active');
  
    visualBullets.forEach((bullet) =>{
      bullet.classList.remove('bullet-active');
    });
    e.currentTarget.classList.add('bullet-active');

    cnt = index + 1;
    autoVisual = setInterval(moveVisualSlide, 5000);

    visualControlBtn.classList.remove('control-active');
  });
});

// Control the slide using the play/pause button
const visualControlBtn = document.querySelector('.visual_control');
visualControlBtn.addEventListener('click', (e) =>{
  e.currentTarget.classList.toggle('control-active');

  if(e.currentTarget.classList.contains('control-active')){
    clearInterval(autoVisual);
  }else{
    autoVisual = setInterval(moveVisualSlide, 5000);
  };
});



// =============== company ===============
const companyImgs = document.querySelectorAll('.company_img .icon');

function showComapnyIcons(){
    $.ajax({
        url: './mainjs/icon_data.json',
        dataType : 'json',

        success: function(data){
            companyImgs.forEach(function(img, index){
                for (let i = 0; i < data.icons.length; i++) {
                    img.innerHTML = data.icons[index].iconPath;
                };
            });
        }
    });
};
showComapnyIcons();

window.addEventListener('scroll', function(){
    const company = document.querySelector('.company');
    const companyTop = company.offsetTop;
    const distance = (companyTop - window.scrollY);
    if(window.scrollY > distance){
        company.classList.add('company-active');
    };
});



// =============== product slider ===============
const imgSlides = document.querySelectorAll('.img_items li');
const textSlides = document.querySelectorAll('.text_items li');
const prevBtn = document.querySelector('.prev_btn');
const nextBtn = document.querySelector('.next_btn');
const page = document.querySelector('.slide_btn p span');

imgSlides.forEach(function(slide, index){
    slide.style.left = `${index * 100}%`;
});

let counter = 0;
prevBtn.addEventListener('click', function(){
    if(counter === 0){
        this.removeEventListener('click', moveProductSlide);
    }else{
        counter--;
        page.textContent = counter + 1;
        moveProductSlide();
    };
});

nextBtn.addEventListener('click', function(){
    if(counter === imgSlides.length - 1){
        this.removeEventListener('click', moveProductSlide);
    }else{
        counter++;
        page.textContent = counter + 1;
        moveProductSlide();
    };
});

function moveProductSlide(){
    imgSlides.forEach(function(slide){
        slide.style.transform = `translateX(-${counter*100}%)`;
    });

    textSlides.forEach(function(slide, index){
        slide.style.opacity = 0;
        slide.style.transform = 'translateY(50px)';
        slide.style.zIndex = 5;
        if(counter === index){
            slide.style.opacity = 1;
            slide.style.transform = 'translateY(0)';
            slide.style.zIndex = 10;
        };
    });

    if(counter > 0){
        prevBtn.style.color = '#333';
    }else{
        prevBtn.style.color = '#aaa';
    };
    
    if(counter === imgSlides.length - 1){
        nextBtn.style.color = '#aaa';
    }else{
        nextBtn.style.color = '#333';
    };
};



// =============== management ===============
const titleBox = document.querySelector('.management .title_box');
const management = document.querySelector('.management');

window.addEventListener('scroll', function(){
    const managementTop = management.getBoundingClientRect().top;
    const managementHeight = management.getBoundingClientRect().height - 400;

    if(managementTop < 0 && managementTop > -managementHeight){
        titleBox.style.position = 'fixed';
        titleBox.style.top = 146 + 'px';
    }else{
        titleBox.style.position = 'static';
        titleBox.style.top = '';
    };
});

window.addEventListener('scroll', function(){
    const managementItems = document.querySelectorAll('.management ul li');
    managementItems.forEach(function(item){
        const itemTop = item.offsetTop;
        const distance = (itemTop - (window.innerHeight / 3));

        if(window.scrollY > distance){
            item.classList.add('csr-active');
        };
    });
});



// =============== news ===============
window.addEventListener('scroll', function(){
    const news = document.querySelector('.news');
    const newsTop = news.offsetTop;
    const distance = (newsTop - window.scrollY);
    if(window.scrollY > newsTop - 550){
        news.classList.add('news-active');
    };
});