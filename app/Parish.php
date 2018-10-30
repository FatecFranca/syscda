<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parish extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'parishes';

    protected $fillable = [
        'forania_id','user_id', 'diocese_id',
        'name', 'opening_date', 'responsible',
        'cnpj', 'email', 'telephone'
    ];
}
