let tabBtn = document.querySelector('.tab_menu a');
const tabList = document.querySelectorAll('.tab_menu ul li a');
const tabCons = document.querySelectorAll('.tab_con div');

tabBtn.addEventListener('click', function(e){
    e.preventDefault();
    tabBtn.classList.toggle('tab-active');
});

tabList.forEach(function(item, index){
    item.addEventListener('click', function(e){
        e.preventDefault();
        
        tabBtn.classList.remove('tab-active');
        tabBtn.textContent = this.textContent;

        tabCons.forEach(function(con){
            con.classList.remove('tab-active');
        });

        tabCons[index].classList.add('tab-active');
    });
});
