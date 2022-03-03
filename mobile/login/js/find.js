const pageAddress = window.location.href;
const pageIndex = pageAddress.indexOf('login');
const pageString = pageAddress.substring(pageIndex).split('/')[1];

$(document).ready(function() {
    // Find ID
    if(pageString == 'find_id.php'){
        $(".find").click(function(){
            var name = $('#name').val();
            var hp1 = $('#hp1').val();
            var hp2 = $('#hp2').val();
            var hp3 = $('#hp3').val();
    
            $.ajax({
                type: "POST",
                url: "find1.php", 
                data: "name="+ name+ "&hp1="+hp1+ "&hp2="+hp2+ "&hp3="+hp3,
                cache: false, 
                success: function(data){
                    $("#loadtext").html(data);
                }
            });
        }); 
    };

    // Find password
    if(pageString == 'find_pw.php'){
        $(".find").click(function(){
            var id = $('#id').val();
            var name = $('#name').val();
            var hp1 = $('#hp1').val(); 
            var hp2 = $('#hp2').val(); 
            var hp3 = $('#hp3').val(); 

            $.ajax({
                type: "POST",
                url: "find2.php",
                data: "id="+ id+ "&name="+ name+ "&hp1="+hp1+ "&hp2="+hp2+ "&hp3="+hp3,
                cache: false, 
                success: function(data){
                    $("#loadtext").html(data);
                }
            });   
        }); 
    };

});
