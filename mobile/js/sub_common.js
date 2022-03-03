const pageAddress = window.location.href;
const pageIndex = pageAddress.indexOf('sub');
const pageNumber = pageAddress.substring(pageIndex).split('');

const pageNumber1 = pageNumber[3] - 1
const pageNumber2 = pageNumber[5] - 1

const visualContainer= document.querySelector('.visual');
const visualTitle = document.querySelector('.visual h3');
const subTitle = document.querySelector('.title_area h2');

function createSubPage(){
    $.ajax({
        url: './js/sub_common.json',
        dataType : 'json',

        success: function(data){
            visualContainer.style.background = `linear-gradient(rgba(0, 0, 0, .15), rgba(0, 0, 0, .15)), url(./images/${data[pageNumber1].visualImg}) no-repeat center/cover`;
            visualTitle.textContent = data[pageNumber1].title;
            subTitle.textContent = data[pageNumber1].sub[pageNumber2].title;
        }
    });
};

createSubPage();
