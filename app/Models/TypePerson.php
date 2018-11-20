<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypePerson extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'type_people';

    protected $fillable = [
        'user_id', 'description'
    ];
}
