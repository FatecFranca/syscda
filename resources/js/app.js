require('./bootstrap');
require('./components/modal');
import 'select2';

//lets sidebar
const sidebar = document.getElementsByClassName('sidebar')[0];
//show/hide sidebar
if (document.getElementById('toggle-menu')) {
    document.getElementById('toggle-menu').onclick = function () {
        let items = sidebar.getElementsByClassName('nav-item');
        for (let i = 0; i < items.length; i++) {
            let icon = items[i].firstElementChild.firstElementChild;
            if ($(icon).hasClass('nav-link')) {
                icon = icon.firstElementChild;
            }
            let label = items[i].getElementsByClassName('label')[0];
            if (label.style.display === 'none') {
                label.style.display = 'block';
                if (items[i].getElementsByClassName('submenu-items')[0] != undefined && items[i].getElementsByClassName('submenu-items')[0].style.display == 'none') {
                    items[i].getElementsByClassName('submenu-items')[0].style.display = '';
                    $(items[i].getElementsByClassName('submenu-items')[0]).addClass('show');
                }
                icon.style.fontSize = '';
                icon.style.paddingBottom = '5px';
            } else {
                label.style.display = 'none';
                if (items[i].getElementsByClassName('submenu-items')[0] != undefined && $(items[i].getElementsByClassName('submenu-items')[0]).hasClass('show')) {
                    items[i].getElementsByClassName('submenu-items')[0].style.display = 'none';
                    $(items[i].getElementsByClassName('submenu-items')[0]).removeClass('show');
                }
                icon.style.fontSize = '20px'
            }
        }
    }
}

//show labels when sidebar hidden and click on icon
if (document.getElementsByClassName('dropdown-toggle')) {
    const dropdown = document.getElementsByClassName('dropdown-toggle');
    for (let i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener('click', function () {
            if (dropdown[i].getElementsByClassName('label')[0].style.display == 'none') {
                console.log('teste');
                let items = sidebar.getElementsByClassName('nav-item');
                for (let i = 0; i < items.length; i++) {
                    let items = sidebar.getElementsByClassName('nav-item');
                    for (let i = 0; i < items.length; i++) {
                        let icon = items[i].firstElementChild.firstElementChild;
                        if ($(icon).hasClass('nav-link')) {
                            icon = icon.firstElementChild;
                        }
                        let label = items[i].getElementsByClassName('label')[0];
                        if (label.style.display === 'none') {
                            label.style.display = 'block';
                            if (items[i].getElementsByClassName('submenu-items')[0] != undefined && items[i].getElementsByClassName('submenu-items')[0].style.display == 'none') {
                                items[i].getElementsByClassName('submenu-items')[0].style.display = '';
                            }
                            icon.style.fontSize = '';
                            icon.style.paddingBottom = '5px';
                        }
                    }
                }
            }
        })
    }
}

//show arrow
if (sidebar) {
    sidebar.onmouseover = function () {
        if (sidebar.getElementsByClassName("label")[0].style.display == 'none') {
            document.getElementsByClassName("fa-angle-right")[0].style.display = "block";
            document.getElementsByClassName("fa-angle-left")[0].style.display = "none";
        } else {
            document.getElementsByClassName("fa-angle-left")[0].style.display = "block";
            document.getElementsByClassName("fa-angle-right")[0].style.display = "none";
        }
    };
}

//hide arrow
if (sidebar) {
    sidebar.onmouseleave = function () {
        document.getElementsByClassName("fa-angle-right")[0].style.display = "none";
        document.getElementsByClassName("fa-angle-left")[0].style.display = "none";
    };
}


$(document).on('click', '.menu-hamburger', function () {
    var side = document.getElementsByClassName('sidebar')[0];
    if (side.style.display === "") {
        side.style.display = "block";
    } else {
        side.style.display = "";
    }
});

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        let validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

$(document).ready(function() {
    $('.custom-select').select2();
});