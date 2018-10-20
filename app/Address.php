<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'addresses';

    protected $fillable = [
        'street', 'neighborhood', 'number',
        'complement', 'rgi',
        'city', 'uf', 'cep'
    ];

}
