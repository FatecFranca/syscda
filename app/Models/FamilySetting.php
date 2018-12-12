<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilySetting extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'family_settings';

    protected $fillable = [
        'user_id', 'rgi_id', 'type_housing',
        'rent_value', 'family_bag', 'value_bag',
        'inss_benefit', 'value_inss_benefit', 'pension_amount',
        'drug_spending'
    ];
}
