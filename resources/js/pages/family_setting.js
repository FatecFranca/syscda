require('../app');

function disabledInputs() {
    if ($('#family_bag_true').is(':checked')) {
        if (!document.getElementById('value_bag').getAttribute('data-show')) {
            document.getElementById('value_bag').removeAttribute('disabled');
            document.getElementById('value_bag').setAttribute('required', true);
        }
    } else {
        document.getElementById('value_bag').removeAttribute('required');
        document.getElementById('value_bag').setAttribute('disabled', true);
    }

    if ($('#inss_benefit_true').is(':checked')) {
        if (!document.getElementById('value_inss_benefit').getAttribute('data-show')) {
            document.getElementById('value_inss_benefit').removeAttribute('disabled');
            document.getElementById('value_inss_benefit').setAttribute('required', true);
        }
    } else {
        document.getElementById('value_inss_benefit').removeAttribute('required');
        document.getElementById('value_inss_benefit').setAttribute('disabled', true);
    }

    if ($('#pension_true').is(':checked')) {
        if (!document.getElementById('pension_amount').getAttribute('data-show')) {
            document.getElementById('pension_amount').removeAttribute('disabled');
            document.getElementById('pension_amount').setAttribute('required', true);
        }
    } else {
        document.getElementById('pension_amount').removeAttribute('required');
        document.getElementById('pension_amount').setAttribute('disabled', true);
    }
    if($('#type_housing').select2('data')[0].id == 'CA') {
        if (!document.getElementById('rent_value').getAttribute('data-show')) {
            document.getElementById('rent_value').removeAttribute('disabled');
            document.getElementById('rent_value').setAttribute('required', true);
        }
    } else {
        document.getElementById('rent_value').removeAttribute('required');
        document.getElementById('rent_value').setAttribute('disabled', true);
    }
}

$(document).ready(function () {
    disabledInputs();
});

$(document).on('change',
    'input[type="radio"][name="family_bag"], ' +
    'input[type="radio"][name="inss_benefit"], ' +
    'input[type="radio"][name="pension"]', function () {
        disabledInputs();
    });

$(document).on('select2:select', '#type_housing', function (e) {
    disabledInputs();
});