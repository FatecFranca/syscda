<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyMemberSetting extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'family_member_settings';

    protected $fillable = [
        'user_id', 'family_settings_id', 'person_id',
        'degree_kinship', 'sacrament', 'profession',
        'work_company', 'health_problem', 'addiction',
        'deceased', 'responsible'
    ];
}
