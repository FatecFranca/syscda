
$(document).on('click', '[data-modal-delete]', function () {
    document.getElementById('urlDestroyModal').value = this.getAttribute('data-url-destroy');
    $('#modalDeleteCenter').modal('toggle');
})

$(document).on('click', '#modalBtnDestroy', function () {
    let urlDestroy = document.getElementById('urlDestroyModal');
    console.log(urlDestroy);
    console.log('akii');
    if (urlDestroy.value) {
        axios.post(urlDestroy.value, {
            _method: 'DELETE'
        }).then((data) => {
            location.href = data.data.url;
        }).catch((err) => {
            console.log(err);
        })
    }
});