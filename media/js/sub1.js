const epGalleryUl = document.querySelectorAll('.ep_gallery_wrap ul');
let isResized = false;

function changeInfo(cnt){
    const galleryImg = epGalleryUl[cnt].querySelector('li:nth-child(1) img');
    const galleryEp = epGalleryUl[cnt].querySelector('li:nth-child(1) div p');
    const galleryTitle = epGalleryUl[cnt].querySelector('li:nth-child(1) div strong');

    if(isResized){
        if(cnt === 0){
            galleryImg.src = './images/sub1/episodes_change01.jpg'
            galleryEp.textContent = 'SEASON 1 EPISODE 4'
            galleryTitle.textContent = 'Of Banquets, Bastards and Burials'
        }else if(cnt === 3){
            galleryImg.src = './images/sub1/episodes_change02.jpg'
            galleryEp.textContent = 'SEASON 2 EPISODE 7'
            galleryTitle.textContent = 'Voleth Meir'
        }
    }else{
        if(cnt === 0){
            galleryImg.src = './images/sub1/episodes01.jpg'
            galleryEp.textContent = 'SEASON 1 EPISODE 1'
            galleryTitle.textContent = 'The End’s Beginning'
        }else if(cnt === 3){
            galleryImg.src = './images/sub1/episodes08.jpg'
            galleryEp.textContent = 'SEASON 2 EPISODE 5'
            galleryTitle.textContent = 'Turn Your Back'
        }
    }
}

window.addEventListener('resize', function(){
    if(this.innerWidth <= 1024){
        isResized = true;
        changeInfo(0)
        changeInfo(3)
    }else{
        isResized = false;
        changeInfo(0)
        changeInfo(3)
    }
})

if(this.innerWidth <= 1024){
    isResized = true;
    changeInfo(0)
    changeInfo(3)
}else{
    isResized = false;
    changeInfo(0)
    changeInfo(3)
}
