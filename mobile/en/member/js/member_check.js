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
            alert("You should agree on all.");
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

















