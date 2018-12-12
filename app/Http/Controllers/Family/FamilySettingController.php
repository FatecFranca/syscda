<?php

namespace App\Http\Controllers\Family;

use App\Models\FamilySetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FamilySettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $family_settings = FamilySetting::orderBy('id', 'desc')->paginate(config('app.PAGINATION_COUNT'));

        $returns = [
            'family_settings' => $family_settings,
            'page_title' => __('family_settings/views.family_settings'),
            'css' => 'family_setting',
            'js' => 'family_setting',
            'action' => [
                'name' => __('default/actions.new')
            ]
        ];

        return view('pages.family_setting.index', $returns);
    }

    public function show($id)
    {

    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function edit($id)
    {

    }

    public function destroy($id, Request $request)
    {

    }
}
