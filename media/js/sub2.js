const body = document.querySelector('body');
const charactersWrap = document.querySelector('.characters_wrap ul');

function createCharacters(){
    $.ajax({
        url: './js/sub2.json',
        dataType : 'json',

        success: function(data){
            data.forEach(function(item, index){
                newList = document.createElement('li');
                newList.style.backgroundImage = `url(${item.imgUrl})`;
                newAnchor = document.createElement('a');
                newAnchor.href = '#';
                newPara = document.createElement('p');
                newPara.textContent = item.name;

                newAnchor.appendChild(newPara);
                newList.appendChild(newAnchor);
                charactersWrap.appendChild(newList);
            });

            const characters = document.querySelectorAll('.center_container ul li');
            const charactersInfo = document.querySelector('.characters_info');
            const characterText = document.querySelector('.characters_info .character_text');
            const characterClose = document.querySelector('.character_close');

            characters.forEach(function(character, index){
                character.addEventListener('click', function(e){
                    e.preventDefault();
                    charactersInfo.classList.add('active');
                    charactersWrap.classList.add('active-hide');
                    body.style.overflowY = 'hidden';
                    characterText.scrollTop = 0;

                    const infoImg = charactersInfo.querySelector('.character_img');
                    const infoName = charactersInfo.querySelector('.character_name');
                    const infoDesc = charactersInfo.querySelector('.character_desc');
                    infoImg.style.backgroundImage = `url(${data[index].imgUrl})`;
                    infoName.textContent = data[index].name;
                    infoDesc.textContent = data[index].desc;
                });
            });

            characterClose.addEventListener('click', function(e){
                e.preventDefault();
                charactersInfo.classList.remove('active');
                charactersWrap.classList.remove('active-hide');
                body.style.overflowY = '';
            });

        }
    });
};

createCharacters();