const vidArray = [
    {
        title: 'AnyCoat 제품영상',
        category: 'cellulose',
        categoryKR: '셀룰로스 계열',
        thumbnail: 'vid01.jpg',
        vidUrl: 'https://www.youtube.com/embed/khqpt8eN0X4'
    },
    {
        title: '유록스 영상광고 : 종합편',
        category: 'eurox',
        categoryKR: '유록스',
        thumbnail: 'vid02.jpg',
        vidUrl: 'https://www.youtube.com/embed/31sKTPtKruA'
    },
    {
        title: 'LOTTE with U 챌린지',
        category: 'etc',
        categoryKR: '기타',
        thumbnail: 'vid03.jpg',
        vidUrl: 'https://www.youtube.com/embed/gzX7BjYyZQs'
    },
    {
        title: 'Your Lifetime Friend, LOTTE',
        category: 'etc',
        categoryKR: '기타',
        thumbnail: 'vid04.jpg',
        vidUrl: 'https://www.youtube.com/embed/3tyYnN4urs4'
    },
    {
        title: 'AnyAddy 제품영상',
        category: 'cellulose',
        categoryKR: '셀룰로스 계열',
        thumbnail: 'vid05.jpg',
        vidUrl: 'https://www.youtube.com/embed/hVzh90_NxT0'
    },
    {
        title: 'HECELLOSE_Paint',
        category: 'cellulose',
        categoryKR: '셀룰로스 계열',
        thumbnail: 'vid06.jpg',
        vidUrl: 'https://www.youtube.com/embed/BlpqCNp2I3A'
    },
    {
        title: 'EUROX PET 사용법',
        category: 'eurox',
        categoryKR: '유록스',
        thumbnail: 'vid07.jpg',
        vidUrl: 'https://www.youtube.com/embed/KzO_-duIv40'
    },
    {
        title: '롯데정밀화학 홍보영상',
        category: 'etc',
        categoryKR: '기타',
        thumbnail: 'vid08.jpg',
        vidUrl: 'https://www.youtube.com/embed/NpYneG3zw-c'
    },
    {
        title: 'EUROX EBD 사용법',
        category: 'eurox',
        categoryKR: '유록스',
        thumbnail: 'vid09.jpg',
        vidUrl: 'https://www.youtube.com/embed/ydhSOgi_KXg'
    },
    {
        title: 'EUROX 홍보영상',
        category: 'eurox',
        categoryKR: '유록스',
        thumbnail: 'vid10.jpg',
        vidUrl: 'https://www.youtube.com/embed/lFQL1LgQ2G8'
    },
    {
        title: 'MECELLOSE_Gypsum Plaster',
        category: 'cellulose',
        categoryKR: '셀룰로스 계열',
        thumbnail: 'vid11.jpg',
        vidUrl: 'https://www.youtube.com/embed/AbuC73mN4kA'
    },
    {
        title: 'MECELLOSE_Extrusion',
        category: 'cellulose',
        categoryKR: '셀룰로스 계열',
        thumbnail: 'vid12.jpg',
        vidUrl: 'https://www.youtube.com/embed/GuXAOf1zvLY'
    }
];

const vid_container = document.querySelector('.vid_list ul');
const filterBtns = document.querySelectorAll('.filter_btn');

window.addEventListener('DOMContentLoaded', () => {
    displayListItems(vidArray);
    showVid();
});

//Display video items
function displayListItems(items){
    let displayList = items.map((item) => {
        return `<li>
                    <div class="vid_thumbnail">
                        <img src="./images/sub4_1/${item.thumbnail}" alt="thumbnail">
                        <a href="#" class="play_btn"></a>
                    </div>
                    <div class="vid_info">
                        <p><span>${item.category}</span>${item.title}</p>
                    </div>
                </li>`
    }).join('');
    vid_container.innerHTML = displayList;
};

//Filter video items using filter buttons
filterBtns.forEach((btn) => {
    btn.addEventListener('click', (e) => {
        filterBtns.forEach((btn) => {
            btn.classList.remove('tab');
        });
        e.target.classList.add('tab');

        const filterId = btn.dataset.id;
        const filteredVids = vidArray.filter((vidItem) => {
            if(vidItem.category === filterId){
                return vidItem;
            };
        });

        if(filterId === 'all'){
            displayListItems(vidArray);
            showVid();
        }else{
            displayListItems(filteredVids);
            showVid();
        };
    });
});

//Show clicked video
const overlay = document.querySelector('.overlay');
const vid_con = overlay.querySelector('.vid_box .vid_con');
const closeBtn = overlay.querySelector('.vid_box .close_btn');

function showVid(){
    const vidLis = document.querySelectorAll('.vid_list ul li');
    vidLis.forEach((vidLi)=>{
        const playBtn = vidLi.querySelector('.play_btn');
        playBtn.addEventListener('click', (e) => {
            e.preventDefault();

            vidImg = playBtn.previousElementSibling.src;
            vidIndex = vidImg.indexOf('vid');
            videoId = vidImg.substring(vidIndex + 3, vidIndex + 5) -1;
            vid_con.innerHTML = `<iframe src="${vidArray[videoId].vidUrl}" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`
            
            overlay.classList.add('active');
            document.querySelector('body').style.overflowY = 'hidden';
        });
        
        closeBtn.addEventListener('click', (e) => {
            e.preventDefault();
            
            const iframe = overlay.querySelector('iframe')
            iframe.src = iframe.src;

            overlay.classList.remove('active');
            document.querySelector('body').style.overflowY = '';
        });
    });
};
