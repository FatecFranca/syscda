require('../app');

$(document).ready(function() {

    function clearForm() {
        // Limpa valores do formulário de cep.
        $("#street").val("");
        $("#neighborhood").val("");
        $("#city").val("");
        $("#uf").val("");
    }

    //Quando o campo cep perde o foco.
    $("#zipcode").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var zipcode = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (zipcode != "") {

            //Expressão regular para validar o CEP.
            var validatecep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validatecep.test(zipcode)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#street").val("...");
                $("#neighborhood").val("...");
                $("#city").val("...");
                $("#uf").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ zipcode +"/json/?callback=?", function(data) {

                    if (!("erro" in data)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#street").val(data.logradouro);
                        $("#neighborhood").val(data.bairro);
                        $("#city").val(data.localidade);
                        $("#uf").val(data.uf);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        clearForm();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                clearForm();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            clearForm();
        }
    });
});
