// =============== COMPANY ===============
const companyImgs = document.querySelectorAll('.icon');

function showComapnyIcons(){
    $.ajax({
        url: './js/icon_data.json',
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