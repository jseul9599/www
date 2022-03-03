document.addEventListener('DOMContentLoaded', function(){
    const checkBoxes = document.querySelectorAll('input[type="checkbox"]');
    const allCheck = document.querySelector('.allcheck');
    const checkAgree = document.querySelector('.check_agree');

    // Check the checkboxes to agree with all policies
    allCheck.addEventListener('click', function(){
        allCheck.classList.add('active');

        if(allCheck.classList.contains('active')){
            checkBoxes.forEach(function(checkbox){
                checkbox.checked = true;
            });
        };
    });

    // If user agrees with all the policies, move on to sign up page
    checkAgree.addEventListener('click', function(){
        const countCheckbox = document.querySelectorAll('input[type="checkbox"]').length;
        const countChecked = document.querySelectorAll('input[type="checkbox"]:checked').length;

        if(countCheckbox != countChecked){
            alert("수집하는 개인정보 항목에 동의해야 가입하실 수 있습니다.");
        }else{
            location.href = "member_form.php";
        };
    });

    // If user clicks cancel button, move on to the previous page
    function join_cancel(){
        history.go(-1);
    };
});



























function join_cancel(){
   history.go(-1);
}

















