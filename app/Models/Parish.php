<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parish extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'parishes';

    protected $fillable = [
        'forania_id','user_id', 'address_id',
        'name', 'opening_date', 'responsible',
        'cnpj', 'email', 'telephone'
    ];

    public function forania()
    {
        return $this->belongsTo('App\Models\Forania');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }
}
