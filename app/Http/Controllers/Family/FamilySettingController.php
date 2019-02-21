<?php

namespace App\Http\Controllers\Family;

use App\Models\FamilySetting;
use App\Models\RGI;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

    public function show($id, Request $request)
    {
        $family_setting = FamilySetting::find($id);
        $rgis = RGI::orderBy('id', 'desc')->get();

        if ($family_setting) {
            $returns = [
                'family_setting' => $family_setting,
                'rgis' => $rgis,
                'page_title' => __('family_settings/views.family_setting') . ' #' . $family_setting->id,
                'css' => 'family_setting',
                'js' => 'family_setting',
                'action' => [
                    'name' => __('default/actions.edit')
                ]
            ];

            return view('pages.family_setting.show', $returns);
        }
        flashMessage($request, __('default/actions.not_found'), 'warning');
        return redirect(route('family_settings.index'));
    }

    public function create()
    {
        $rgis = RGI::orderBy('id', 'desc')->get();

        $returns = [
            'rgis' => $rgis,
            'page_title' => __('family_settings/views.family_setting'),
            'css' => 'family_setting',
            'js' => 'family_setting',
            'action' => [
                'name' => __('default/actions.add')
            ]
        ];

        return view('pages.family_setting.create', $returns);
    }

    public function store(Request $request)
    {
        $message = [
            'rgi_id.required' => 'RGI é obrigatório.',
            'type_housing.required' => 'RGI é obrigatório.'
        ];

        $data = $request->all();

        $this->validate($request, [
            'rgi_id' => "required",
            'type_housing' => "required"
        ], $message);

        $data['user_id'] = Auth::id();

        $family_setting = FamilySetting::create($data);

        if ($family_setting) {
            flashMessage($request, __('default/actions.created_success'), 'success');
            return redirect(route('family_settings.show', $family_setting->id));
        }

        flashMessage($request, __('default/actions.not_found'), 'warning');
        return redirect(route('family_settings.index'));

    }

    public function edit($id, Request $request)
    {
        $family_setting = FamilySetting::find($id);
        $rgis = RGI::orderBy('id', 'desc')->get();

        if ($family_setting) {
            $returns = [
                'family_setting' => $family_setting,
                'rgis' => $rgis,
                'page_title' => __('family_settings/views.family_setting') . ' #' . $family_setting->id,
                'css' => 'family_setting',
                'js' => 'family_setting',
                'action' => [
                    'name' => __('default/actions.save')
                ]
            ];

            return view('pages.family_setting.edit', $returns);
        }
        flashMessage($request, __('default/actions.not_found'), 'warning');
        return redirect(route('family_settings.index'));
    }

    public function destroy($id, Request $request)
    {

    }
}
