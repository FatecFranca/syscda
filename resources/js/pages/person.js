require('../app');

const {showOverlay, closeOverlay} = require('../components/overlay');

$(document).on('click', '#add-type-person', function () {
    showOverlay();
    let person_id, type_person_id, url, error, errorBack, elementRender;

    type_person_id = document.getElementById('type_person');
    person_id = document.getElementById('person_id');
    url = this.parentNode;
    error = document.getElementById('type-person-error');
    errorBack = document.getElementById('type-person-back');
    elementRender = document.getElementById('type-person-table');

    if (type_person_id.value != 0) {
        axios.post(url.getAttribute('data-url'), {
            type_people_id: type_person_id.value,
            person_id: person_id.value
        }).then((data) => {
            console.log(data);
            if(data.data.duplicated) {
                errorBack.innerText = data.data.duplicated;
                errorBack.classList.remove('el-hide');
            } else {
                $(elementRender).find('tbody').append(data.data);
            }
            closeOverlay();
        }).catch((error) => {

            console.log(error.message);
            closeOverlay();
        });
    } else {
        if (error.classList.contains('el-hide')) {
            error.classList.remove('el-hide');
        }
        closeOverlay();
    }

});