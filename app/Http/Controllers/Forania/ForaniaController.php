<?php

namespace App\Http\Controllers\Forania;

use App\Models\Diocese;
use App\Models\Forania;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ForaniaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $foranias = Forania::orderBy('id', 'desc')->paginate(config('app.PAGINATION_COUNT'));

        $returns = [
            'foranias' => $foranias,
            'page_title' => __('foranias/views.foranias'),
            'css' => 'forania',
            'js' => 'forania',
            'action' => [
                'name' => __('default/actions.new')
            ]
        ];

        return view('pages.forania.index', $returns);
    }

    public function show($id, Request $request)
    {
        $forania = Forania::find($id);
        $dioceses = Diocese::orderBy('id', 'desc')->get();

        if ($forania) {
            $returns = [
                'forania' => $forania,
                'dioceses' => $dioceses,
                'page_title' => __('foranias/views.forania') . ' #' . $forania->id,
                'css' => 'forania',
                'js' => 'forania',
                'action' => [
                    'name' => __('default/actions.edit')
                ]
            ];
            return view('pages.forania.show', $returns);
        }

        flashMessage($request, __('default/actions.not_found'), 'warning');
        return redirect(route('rgi.index'));
    }

    public function create()
    {
        $dioceses = Diocese::orderBy('id', 'desc')->get();

        $returns = [
            'dioceses' => $dioceses,
            'page_title' => __('default/actions.create') . ' ' . __('foranias/views.foranias'),
            'css' => 'forania',
            'js' => 'forania',
            'action' => [
                'name' => __('default/actions.add')
            ]
        ];

        return view('pages.forania.create', $returns);
    }

    public function store(Request $request)
    {
        $message = [
            'name.required' => "Nome é obrigatório.",
            'diocese_id.unique' => 'Diocese é obrigatório.',
        ];

        $this->validate($request, [
            'name' => 'required',
            'diocese_id' => 'required',
        ], $message);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $forania = Forania::create($data);

        if ($forania) {
            flashMessage($request, __('default/actions.created_success'), 'success');
            return redirect(route('foranias.show', $forania->id));
        }

        flashMessage($request, __('default/actions.not_found'), 'warning');
        return redirect(route('foranias.index'));
    }

    public function edit($id, Request $request)
    {
        $forania = Forania::find($id);
        $dioceses = Diocese::orderBy('id', 'desc')->get();

        if ($forania) {
            $returns = [
                'forania' => $forania,
                'dioceses' => $dioceses,
                'page_title' => __('rgi/views.rgi') . ' #' . $forania->id,
                'css' => 'forania',
                'js' => 'forania',
                'action' => [
                    'name' => __('default/actions.save')
                ]
            ];
            return view('pages.forania.edit', $returns);
        }

        flashMessage($request, __('default/actions.not_found'), 'warning');
        return redirect(route('foranias.index'));
    }

    public function update($id, Request $request)
    {
        $message = [
            'name.required' => "Nome é obrigatório.",
            'diocese_id.unique' => 'Diocese é obrigatório.',
        ];

        $this->validate($request, [
            'name' => 'required',
            'diocese_id' => 'required',
        ], $message);

        $data = $request->all();
        $forania = Forania::find($id);

        if ($forania) {
            $result = $forania->fill($data)->save();
            if ($result) {
                flashMessage($request, __('default/actions.updated_success'), 'success');
                return redirect(route('foranias.show', $forania->id));
            } else {
                flashMessage($request, __('default/actions.updated_danger'), 'danger');
                return redirect(route('foranias.edit', $forania->id))->withInput();
            }
        }

        flashMessage($request, __('default/actions.not_found'), 'warning');
        return redirect(route('foranias.index'));
    }


    public function destroy($id, Request $request)
    {
        $forania = Forania::find($id);

        if ($forania) {
            $result = $forania->delete();
            if ($result) {
                return response()->json(['url' => route('foranias.index')]);
            } else {
                throw new Exception(__('default/actions.deleted_error'));
            }
        }
        throw new Exception(__('default/actions.not_found'));
    }

}
