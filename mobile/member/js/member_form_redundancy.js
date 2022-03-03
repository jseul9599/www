$(document).ready(function(){
    // Redundancy and regular expression check for ID
    $("#id").keyup(function() {
        var id = $('#id').val();
        $.ajax({
            type: "POST",
            url: "check_id.php",
            data: "id="+ id,  
            cache: false, 
            success: function(data){
                $("#loadtext1").html(data);
            }
        });
    });

    // Redundancy check	for nick
    $("#nick").keyup(function() {
        var nick = $('#nick').val();
        $.ajax({
            type: "POST",
            url: "check_nick.php",
            data: "nick="+ nick,  
            cache: false, 
            success: function(data){
                $("#loadtext3").html(data);
            }
        });
    });
});
