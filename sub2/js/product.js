const productList = document.querySelector('.content_area .product');

function createProductList(){
    $.ajax({
        url: './js/product.json',
        dataType : 'json',

        success: function(data){
            for (let i = 0; i < data.length; i++) {
                productList.innerHTML += `<li>
                                            <a href="#">
                                                <dl>
                                                    <dt>${data[i].productName}</dt>
                                                    <dd>${data[i].summary}</dd>
                                                </dl>
                                                <div class="product_img">
                                                    <img src="${data[i].imgUrl}" alt="${data[i].productName}">
                                                </div>
                                            </a>
                                        </li>`
            };

            const productItems = document.querySelectorAll('.content_area .product li');
            const overlay = document.querySelector('.content_area .overlay');
            const overlayClose = document.querySelector('.content_area .overlay .close_btn');
            productItems.forEach(function(item, index){
                item.addEventListener('click', function(e){
                    e.preventDefault();
                    overlay.classList.add('active');
                    overlay.querySelector('.product_con').innerHTML = `<dl>
                                                                            <dt>1. 일반물성</dt>
                                                                            <dd>${data[index].property}</dd>
                                                                        </dl>
                                                                        <dl>
                                                                            <dt>2. 포장</dt>
                                                                            <dd>${data[index].packaging}</dd>
                                                                        </dl>`
                });
            });

            overlayClose.addEventListener('click', function(e){
                e.preventDefault();
                overlay.classList.remove('active');
            });
        }
    });
};

createProductList();


