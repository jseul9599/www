const jobBoxes = document.querySelectorAll('.job_desc');

function jobInfo(){
    $.ajax({
        url: './js/job_data.json',
        dataType : 'json',

        success: function(data){
            jobBoxes.forEach(function(jobBox){
                const jobTitleArray = jobBox.className.split(' ');
                const jobTitle= jobTitleArray[2];
                for (let i = 0; i < data[jobTitle].length; i++) {
                    const jobTable = jobBox.querySelector('table');
                    jobTable.innerHTML += `<tr>
                                                <th>${data[jobTitle][i].job}</th>
                                                <td>${data[jobTitle][i].desc}</td>
                                            </tr>`
                };
            });
        }
    });
};

jobInfo();