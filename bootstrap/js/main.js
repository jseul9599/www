// =============== Navigation ===============
const navLinks = document.querySelectorAll('.nav-link');
const navBar = document.querySelector('#navbarNav');

navLinks.forEach((link) => {
    link.addEventListener('click', function(){
        navBar.classList.remove('show');
    });
});





// =============== Visual ===============
const visualImgs= document.querySelectorAll('.carousel-item img');
let screenWidth;

window.addEventListener('resize', function(){
    resizeScreen();
});

function resizeScreen(){
    screenWidth = window.innerWidth;
    if(screenWidth < 768){
        visualImgs.forEach((img, index) => {
            img.src = `./images/visual0${index + 1}_s.jpg`;
        });
    };
    if(screenWidth >= 768){
        visualImgs.forEach((img, index) => {
            img.src = `./images/visual0${index + 1}.jpg`;
        });
    };
};
resizeScreen();





// =============== Cart_container open / close ===============
const cartOpenBtn = document.querySelector('.cart_open');
const cartCloseBtn = document.querySelector('.cart_container .cart_close');
const cart_container = document.querySelector('.cart_container');

// Open Cart
cartOpenBtn.addEventListener('click', function(){
    cart_container.classList.add('cart-open');
});

// Close Cart
cartCloseBtn.addEventListener('click', function(e){
    e.preventDefault();
    cart_container.classList.remove('cart-open');
});





// =============== Products & Cart ===============
const tabContent = document.querySelectorAll('.tab-content .tab-pane .row');
const cartList = document.querySelector('.cart_list');
const totalPriceText = document.querySelector('.cart_footer .total_price');


// Generate items using productList in tabContent
productList.forEach((product) => {
    if(product.category === 'pints'){
        generateProduct(0);
    }else if(product.category === 'bars'){
        generateProduct(1);
    }else if(product.category === 'multipacks'){
        generateProduct(2);
    };

    function generateProduct(tabContentIndex){
        tabContent[tabContentIndex].innerHTML += `
        <div class="col-md-4 col-sm-6">
            <div class="product_item text-center py-5">
                <img src="${product.imgSrc}" alt="">
                <ul class="px-0">
                    <li class="item_name"><strong>${product.name}</strong></li>
                    <li class="item_price">£ ${product.price.toFixed(2)}</li>
                </ul>
                <a href="#" class="add_cart" onClick="addToCart('${product.name}'); event.preventDefault();"><i class="fas fa-shopping-cart"></i> ADD TO CART</a>
            </div>
        </div>
        `;
    };
});


// Bring the previous data from Local Storage (if it doesn't exist, set shoppingCart empty array)
let shoppingCart = JSON.parse(localStorage.getItem('shoppingCart')) || [];
updateCartContainer();


// Update the shoppingCart's data in the cart
function updateCartContainer(){
    generateItemsInCart();
    calculateTotal();

    if(shoppingCart.length === 0){
        cartList.textContent = 'Your cart is empty';
    };

    // Save shoppingCart's data to Local Storage
    localStorage.setItem('shoppingCart', JSON.stringify(shoppingCart));
};


// When user clicks 'ADD TO CART'
function addToCart(productName){
    if(shoppingCart.some((item) => item.name === productName)){ // If the same prodcut already exists in the shoppingCart, increase the quantity
        changeQuantity('increase', productName);
    }else{ 
        // If the product doesn't exist in the shoppingCart...
        const cartItem = productList.find((item) => item.name === productName); // Search the product with its name from productList
        shoppingCart.push({ // Add it to shoppingCart and increase its quantity in shoppingCart
            ...cartItem,
            quantity : 1,
        });
        updateCartContainer();
    };

    cart_container.classList.add('cart-open');
};


// Generate added product in the cart
function generateItemsInCart(){
    cartList.innerHTML = ''; // Clear cartList
    shoppingCart.forEach((item) => {
        cartList.innerHTML += `
        <li class="cart_item">
            <div class="cart_img col-4"><img src="${item.imgSrc}" alt="${item.name}" class="container-fluid"></div>
            <div class="cart_info col-8">
                <strong>${item.name}</strong>
                <div class="cart_bottom">
                    <div class="cart_control">
                        <button onClick="changeQuantity('decrease', '${item.name}')">-</button>
                        <span>${item.quantity}</span>
                        <button onClick="changeQuantity('increase', '${item.name}')">+</button>
                    </div>
                    <span>£ ${(item.price * item.quantity).toFixed(2)}</span>
                    <button class="cart_remove" onClick="removeItem('${item.name}')"><i class="fas fa-times-circle"></i></button>
                </div>
            </div>
        </li>
        `;
    });
};


// Display the total price of products and the total quantity of each product
function calculateTotal(){
    let totalPrice = 0;
    let totalItems = 0;
    shoppingCart.forEach((item) => {
        totalPrice += item.price * item.quantity;
        totalItems += item.quantity;
    });
    totalPriceText.textContent = '£ ' + totalPrice.toFixed(2);
    cartOpenBtn.querySelector('span').textContent = totalItems;
};


// Increase or decrease the quantity of products
function changeQuantity(btnAction, productName){
    shoppingCart = shoppingCart.map((item) => {
        let preQuantity = item.quantity;
        if(item.name === productName){
            if(btnAction === 'decrease' && item.quantity > 1){
                preQuantity--;
            }else if(btnAction === 'increase'){
                preQuantity++;
            };
        };

        return {
            ...item,
            quantity : preQuantity,
        };
    });
    updateCartContainer();
};


// If user clicks X button, remove the product from the cart
function removeItem(productName){
    shoppingCart = shoppingCart.filter((item) => item.name !== productName);
    updateCartContainer();
};





// =============== Event ===============
// Today's date
const today = new Date();
const currentYear = today.getFullYear();
const currentMonth = today.getMonth();
const currentDate = today.getDate();

// End date (3 days after today)
const future = new Date(currentYear, currentMonth, currentDate + 3, 14, 0, 0);
const futureMonth = future.getMonth();
const futureDay = future.getDay();

// Create notice of the end date
const eventNotice = document.querySelector('.event_notice');
eventNotice.textContent = `Offer ends on ${dayList[futureDay]}, ${future.getDate()} ${monthList[futureMonth]} ${future.getFullYear()}, 14:00 GMT`;

function eventCountDown(){
    const now = new Date();
    const timeGap = future.getTime() - now.getTime();

    // How time works with milliseconds
    const oneMin = 1000 * 60;
    const oneHour = oneMin * 60;
    const oneDay = oneHour * 24;

    const gapDays = Math.floor(timeGap / oneDay);
    const gapHours = Math.floor((timeGap % oneDay) / oneHour);
    const gapMins = Math.floor((timeGap % oneHour) / oneMin);
    const gapSecs = Math.floor((timeGap % oneMin) / 1000);

    const gapArray = [gapDays, gapHours, gapMins, gapSecs];
    const remainingText = document.querySelectorAll('.countdown_box li span');
    remainingText.forEach((item, index) => {
        if(gapArray[index] < 10){
            item.textContent = `0${gapArray[index]}`; //If the value is less than 10, add 0 in front of it
        }else{
            item.textContent = gapArray[index];
        };
    });

    if(timeGap < 0){
        const countBox = document.querySelector('.countdown_box');
        clearInterval(startCount);
        eventNotice.textContent = '';
        countBox.innerHTML = `<p class="fw-bold text-white fs-3">Sorry, this offer has expired</p>`;
    };
};
let startCount = setInterval(eventCountDown, 1000);





// =============== Gallery ===============
const galleryItems = document.querySelectorAll('.gallery_item div');

galleryItems.forEach((item) => {
    item.addEventListener('click', (e) => {
        let imgSrc = e.target.querySelector('img').getAttribute('src');
        const galleryModal = document.querySelector('.modal-body img');
        galleryModal.src = imgSrc;
        var myModal = new bootstrap.Modal(document.getElementById('gallery_modal'));
        myModal.show();
    });
});