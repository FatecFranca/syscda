<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forania extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'foranias';

    protected $fillable = [
        'name', 'opening_date',
        'user_id', 'diocese_id'
    ];

    public function diocese()
    {
        return $this->belongsTo('App\Diocese');
    }
}
