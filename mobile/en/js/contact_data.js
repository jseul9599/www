const contactBoxes = document.querySelectorAll('.content_area div');

function createContact(){
    $.ajax({
        url: './js/contact_data.json',
        dataType : 'json',

        success: function(data){
            contactBoxes.forEach(function(contactBox){
                const title = contactBox.className;
                for (let i = 0; i < data[title].length; i++) {
                    const tbody = contactBox.querySelector('tbody');
                    tbody.innerHTML += `<tr>
                                            <td>${data[title][i].product}</td>
                                            <td><a href="tel:${data[title][i].phone}">${data[title][i].phone}</a></td>
                                        </tr>`
                };
            });
        }
    });
};

createContact();