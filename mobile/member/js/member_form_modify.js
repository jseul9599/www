$(document).ready(function(){
    // Redundancy check	for nick
    var previousNick = $('#nick').val();
    $("#nick").keyup(function() {
        var nick = $('#nick').val();
        if(previousNick == nick){
            $("#loadtext3").html("<span style='color:green'>사용가능한 닉네입니다.</span>");
            
        }else{
            $.ajax({
                type: "POST",
                url: "check_nick.php",
                data: "nick="+ nick,  
                cache: false, 
                success: function(data){
                    $("#loadtext3").html(data);
                }
            });
        };
    });
});



// Password and password confirm check
document.addEventListener("DOMContentLoaded", function(){
    const passConfirm = document.querySelector('#pass_confirm');
    const loadtext2 = document.querySelector('#loadtext2');
    passConfirm.addEventListener('keyup', function(){
        if(document.member_form.pass.value != document.member_form.pass_confirm.value){
            loadtext2.innerHTML = `<span style='color:red'>비밀번호가 일치하지 않습니다.</span>`;
        }else if(document.member_form.pass.value == document.member_form.pass_confirm.value){
            loadtext2.innerHTML = `<span style='color:green'>비밀번호가 일치합니다.</span>`;
        };
    });
});



// Check inputs
function check_input(){
    // Check if there is an empty input
    if(!document.member_form.pass.value){
        alert("비밀번호를 입력하세요.");
        document.member_form.pass.focus();
        return;
    };

    if(!document.member_form.pass_confirm.value){
        alert("비밀번호 확인을 입력하세요.");
        document.member_form.pass_confirm.focus();
        return;
    };

    if(!document.member_form.nick.value){
        alert("닉네임 입력하세요.");
        document.member_form.nick.focus();
        return;
    };

    if(!document.member_form.hp2.value || !document.member_form.hp3.value){
        alert("휴대폰 번호를 입력하세요.");
        document.member_form.hp2.focus();
        return;
    };

    // Check if password and pass_confirm are same
    if(document.member_form.pass.value != document.member_form.pass_confirm.value){
        alert("비밀번호가 일치하지 않습니다. 다시 입력해주세요.");
        document.member_form.pass.focus();
        document.member_form.pass.select();
        return;
    };

    // Check the redundancy for nick
    const loadtext2 = document.querySelector('#loadtext3 span');
    if(loadtext2.classList.contains('fail')){
        alert('해당 닉네임이 존재합니다. 다시 입력해주세요.');
        document.member_form.nick.select()
        return;
    };

    document.member_form.submit();
};



// Reset the form
function reset_form(){
    document.member_form.pass.value = "";
    document.member_form.pass_confirm.value = "";
    document.member_form.nick.value = "";
    document.member_form.hp1.value = "010";
    document.member_form.hp2.value = "";
    document.member_form.hp3.value = "";
    document.member_form.email1.value = "";
    document.member_form.email2.value = "";
    document.querySelector('#loadtext2').innerHTML = '';
};