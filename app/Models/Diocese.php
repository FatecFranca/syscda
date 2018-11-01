<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diocese extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'dioceses';

    protected $fillable = [
        'address_id', 'name', 'opening_date',
        'responsible', 'telephone', 'cnpj',
        'email', 'user_id'
    ];

    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }
}
