require('../app');

$(document).ready(function() {
    $('#telephone').mask('(00) 0000-0000');
    $('#cnpj').mask('00.000.000/0000-00', {reverse: true});
});
