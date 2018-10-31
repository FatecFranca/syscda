<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapel extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'chapels';

    protected $fillable = [
        'parish_id','user_id', 'address_id',
        'name', 'opening_date', 'responsible',
        'cnpj', 'email', 'telephone'
    ];

    public function parish()
    {
        return $this->belongsTo('App\Parish');
    }

    public function address()
    {
        return $this->belongsTo('App\Address');
    }
}
