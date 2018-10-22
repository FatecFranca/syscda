<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RGI extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'rgi';

    protected $fillable = [
        'rgi_number', 'number', 'address_id'
    ];


    public function address()
    {
        return $this->belongsTo('App\Address');
    }
}
