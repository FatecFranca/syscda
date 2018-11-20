<?php

use Illuminate\Http\Request;

function flashMessage(Request $request, $message, $messageType = 'info', $addons = [])
{
    if (config('app.env') == 'local') {
        if (isset($addons['res'])) {
            $request->session()->flash('message', $message . PHP_EOL . $addons['res']);
        } else {
            $request->session()->flash('message', $message);
        }
    } else {
        $request->session()->flash('message', $message);
    }
    $request->session()->flash('messageType', $messageType);
}

function validar_cnpj($cnpj)
{
    //função usada do repo https://github.com/guisehn;
    //https://gist.github.com/guisehn/3276302

    $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
    // Valida tamanho
    if (strlen($cnpj) != 14)
        return false;
    // Valida primeiro dígito verificador
    for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
    {
        $soma += $cnpj{$i} * $j;
        $j = ($j == 2) ? 9 : $j - 1;
    }
    $resto = $soma % 11;
    if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
        return false;
    // Valida segundo dígito verificador
    for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
    {
        $soma += $cnpj{$i} * $j;
        $j = ($j == 2) ? 9 : $j - 1;
    }
    $resto = $soma % 11;

    return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
}

function validar_cpf($cpf)
{
    //função usada do repo https://github.com/guisehn;
    //https://gist.github.com/guisehn/3276015

    $cpf = preg_replace('/[^0-9]/', '', (string) $cpf);

    // Valida tamanho
    if (strlen($cpf) != 11)
        return false;

    // Calcula e confere primeiro dígito verificador
    for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
        $soma += $cpf{$i} * $j;
    $resto = $soma % 11;

    if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto))
        return false;
    // Calcula e confere segundo dígito verificador

    for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
        $soma += $cpf{$i} * $j;
    $resto = $soma % 11;

    return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);
}


function removeMaskTelephone($telephone)
{
    if ($telephone) {

        $telephone_not_mask = str_replace('(', '', $telephone);
        $telephone_not_mask = str_replace(')', '', $telephone_not_mask);
        $telephone_not_mask = str_replace('-', '', $telephone_not_mask);
        $telephone_not_mask = str_replace(' ', '', $telephone_not_mask);

        return $telephone_not_mask;
    }

    return '';

}

function removeMaskCNPJ($cnpj)
{
    if ($cnpj) {

        $cnpj_not_mask = str_replace('.', '', $cnpj);
        $cnpj_not_mask = str_replace('/', '', $cnpj_not_mask);
        $cnpj_not_mask = str_replace('-', '', $cnpj_not_mask);

        return $cnpj_not_mask;
    }

    return '';
}

function removeMaskCPF($cpf)
{
    if ($cpf) {

        $cpf_not_mask = str_replace('.', '', $cpf);
        $cpf_not_mask = str_replace('/', '', $cpf_not_mask);
        $cpf_not_mask = str_replace('-', '', $cpf_not_mask);

        return $cpf_not_mask;
    }

    return '';
}

function marital_status()
{
    return  [
        'Solteiro',
        'Casado',
        'Divorciado'
    ];
}