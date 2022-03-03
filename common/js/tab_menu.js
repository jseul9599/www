const tabBtns = document.querySelectorAll('.tab_menu ul li');
const tabCons = document.querySelectorAll('.tab_con div');

tabBtns.forEach(function(btn, index){
    btn.addEventListener('click', function(e){
        e.preventDefault();
        tabBtns.forEach(function(btn){
            btn.classList.remove('tab-active');
        });

        tabCons.forEach(function(con){
            con.classList.remove('tab-active');
        });

        this.classList.add('tab-active');
        tabCons[index].classList.add('tab-active');
    });
});