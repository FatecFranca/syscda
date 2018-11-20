<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'people';

    protected $fillable = [
        'parish_id', 'user_id', 'rgi_id',
        'name', 'nickname', 'date_birthday',
        'cpf', 'email', 'telephone',
        'marital_status'
    ];

    public function people_types()
    {
        return $this->belongsToMany('App\Models\TypePerson', 'type_person_types',
            'person_id', 'type_people_id', 'user_id');
    }
}
