const galleryContainer = document.querySelector('.gallery_container');

function createGallery(){
    $.ajax({
        url: './js/sub4.json',
        dataType : 'json',

        success: function(data){
            const galleryArray = data;

            function generateGrid(columns, galleryArray){
                let columnWrappers = {};

                for(let i = 0; i < columns; i++){
                    columnWrappers[`column${i}`] = []; //columnWrappers라는 객체의 column${i}키의 속성값은 배열
                }
                console.log(columnWrappers)

                for(let i = 0; i < galleryArray.length; i++){
                    const column = i % columns; //사진 배열의 인덱스를 열개수(4)로 나눈 나머지를 구해서 (나올 수 있는 나머지값은 0, 1, 2, 3)
                    columnWrappers[`column${column}`].push(galleryArray[i]); //해당 columnWrappers[`column${나머지값}`]키 안에 해당 인덱스 사진을 넣어줌
                }

                for(let i = 0; i < columns; i++){
                    let columnPosts = columnWrappers[`column${i}`];
                    let div = document.createElement('div');
                    div.classList.add('column');
            
                    columnPosts.forEach(post => {
                        let postDiv = document.createElement('div');
                        postDiv.classList.add('post');
                        let image = document.createElement('img');
                        image.src = post.imgUrl;
                        let hoverDiv = document.createElement('div');
                        hoverDiv.classList.add('overlay');
                        let title = document.createElement('h3');
                        title.innerText = post.title;
                        hoverDiv.appendChild(title);
                
                        
                        postDiv.append(image, hoverDiv)
                        div.appendChild(postDiv) 
                    });
                    galleryContainer.appendChild(div);
                }
            }

            generateGrid(4, galleryArray)

            
            const gallerypost = document.querySelectorAll('.post');
            const lightbox = document.querySelector('.gallery_lightbox');

            

            console.log(gallerypost)
            console.log(lightbox)

            

            gallerypost.forEach(function(post, inex){
                post.addEventListener('click', function(){
                    //console.log('aaaa')
                    lightbox.style.display = 'block'
                    lightbox.querySelector('img').src = post.querySelector('img').src

                    const prev_btn = document.querySelector('.prev_btn');
                    const next_btn = document.querySelector('.next_btn');
                    console.log(prev_btn)
                    console.log(next_btn)


                    console.log(lightbox.querySelector('img').width)
                    console.log(lightbox.querySelector('img').height)
                    prev_btn.style.height = lightbox.querySelector('img').height + 'px'
                    next_btn.style.height = lightbox.querySelector('img').height + 'px'

                })
            })














            
        }
    });
};

createGallery();


