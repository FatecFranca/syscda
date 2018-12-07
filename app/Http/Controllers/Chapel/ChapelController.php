<?php

namespace App\Http\Controllers\Chapel;

use App\Models\RGI;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Chapel;
use App\Models\Parish;

class ChapelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $chapels = Chapel::orderBy('id', 'desc')->paginate(config('app.PAGINATION_COUNT'));

        $returns = [
            'chapels' => $chapels,
            'page_title' => __('chapels/views.chapels'),
            'css' => 'chapel',
            'js' => 'chapel',
            'action' => [
                'name' => __('default/actions.new')
            ]
        ];

        return view('pages.chapel.index', $returns);
    }

    public function show($id)
    {
        $chapel = Chapel::find($id);

        if ($chapel) {

            $rgis = RGI::orderBy('id', 'desc')->get();
            $parishes = Parish::orderBy('id', 'desc')->get();

            $returns = [
                'chapel' => $chapel,
                'rgis' => $rgis,
                'parishes' => $parishes,
                'page_title' => __('chapels/views.data_chapel'),
                'css' => 'chapel',
                'js' => 'chapel',
                'action' => [
                    'name' => __('default/actions.edit')
                ]
            ];

            return view('pages.chapel.show', $returns);
        }

    }

    public function create()
    {
        $rgis = RGI::orderBy('id', 'desc')->get();
        $parishes = Parish::orderBy('id', 'desc')->get();

        $returns = [
            'rgis' => $rgis,
            'parishes' => $parishes,
            'page_title' => __('chapels/views.data_chapel'),
            'css' => 'chapel',
            'js' => 'chapel',
            'action' => [
                'name' => __('default/actions.add')
            ]
        ];

        return view('pages.chapel.create', $returns);
    }

    public function store(Request $request)
    {
        $message = [
            'name.required' => "Nome é obrigatório.",
            'responsible.required' => "Responsável é obrigatório.",
            'telephone.required' => "Telefone é obrigatório.",
            'email.unique' => 'E-mail já existente.',
            'rgi_id.required' => 'RGI é obrigatório.',
            'parish_id.required' => 'Paróquia é obrigatório.'
        ];

        $this->validate($request, [
            'name' => "required",
            'responsible' => "required",
            'telephone' => "required",
            'email' => "unique:parishes",
            'rgi_id' => 'required',
            'parish_id' => 'required'
        ], $message);

        $data = $request->all();

        $data['telephone'] = removeMaskTelephone($data['telephone']);

        $data['cnpj'] = removeMaskCNPJ($data['cnpj']);

        if ($data['cnpj']) {
            if (validar_cnpj($data['cnpj'])) {

                $data['user_id'] = Auth::id();
                $chapel = Chapel::create($data);

                if ($chapel) {
                    flashMessage($request, __('default/actions.created_success'), 'success');
                    return redirect(route('chapels.show', $chapel->id));
                }

            } else {

                $rgis = RGI::orderBy('id', 'desc')->get();
                $parishes = Parish::orderBy('id', 'desc')->get();

                $returns = [
                    'chapel' => $data,
                    'rgis' => $rgis,
                    'parishes' => $parishes,
                    'page_title' => __('chapels/views.data_chapels'),
                    'css' => 'chapel',
                    'js' => 'chapel',
                    'message' => 'CNPJ inválido',
                    'action' => [
                        'name' => __('default/actions.add')
                    ]
                ];

                return view('pages.chapel.create', $returns);
            }
        } else {
            $data['user_id'] = Auth::id();
            $chapel = Chapel::create($data);
            if ($chapel) {
                flashMessage($request, __('default/actions.created_success'), 'success');
                return redirect(route('chapels.show', $chapel->id));
            }
        }

        flashMessage($request, __('default/actions.created_error'), 'warning');
        return redirect(route('chapels.index'));
    }

    public function edit($id)
    {
        $chapel = Chapel::find($id);

        if ($chapel) {

            $rgis = RGI::orderBy('id', 'desc')->get();
            $parishes = Parish::orderBy('id', 'desc')->get();

            $returns = [
                'chapel' => $chapel,
                'rgis' => $rgis,
                'parishes' => $parishes,
                'page_title' => __('chapels/views.data_chapel'),
                'css' => 'chapel',
                'js' => 'chapel',
                'action' => [
                    'name' => __('default/actions.save')
                ]
            ];

            return view('pages.chapel.edit', $returns);
        }
    }


    public function update($id, Request $request)
    {
        $message = [
            'name.required' => "Nome é obrigatório.",
            'responsible.required' => "Responsável é obrigatório.",
            'telephone.required' => "Telefone é obrigatório.",
            'email.unique' => 'E-mail já existente.',
            'rgi_id.required' => 'RGI é obrigatório.',
            'parish_id.required' => 'Paróquia é obrigatório.'
        ];

        $this->validate($request, [
            'name' => "required",
            'responsible' => "required",
            'telephone' => "required",
            'email' => "unique:chapels,email," . $id,
            'rgi_id' => 'required',
            'parish_id' => 'required'
        ], $message);

        $data = $request->all();

        $data['telephone'] = removeMaskTelephone($data['telephone']);

        $data['cnpj'] = removeMaskCNPJ($data['cnpj']);

        if ($data['cnpj']) {
            if (validar_cnpj($data['cnpj'])) {

                $data['user_id'] = Auth::id();
                $chapel = Chapel::find($id);

                if ($chapel) {
                    $result = $chapel->fill($data)->save();
                    if ($result) {
                        flashMessage($request, __('default/actions.updated_success'), 'success');
                        return redirect(route('chapels.show', $chapel->id));
                    } else {
                        flashMessage($request, __('default/actions.updated_danger'), 'danger');
                        return redirect(route('chapels.edit', $chapel->id))->withInput();
                    }
                }

                flashMessage($request, __('default/actions.not_found'), 'success');
                return redirect(route('chapels.index'));

            } else {

                $rgis = RGI::orderBy('id', 'desc')->get();
                $parishes = Parish::orderBy('id', 'desc')->get();

                $chapel = new Chapel();

                $chapel->id = $id;
                $chapel->name = $data['name'];
                $chapel->opening_date = $data['opening_date'];
                $chapel->responsible = $data['responsible'];
                $chapel->telephone = $data['telephone'];
                $chapel->cnpj = $data['cnpj'];
                $chapel->email = $data['email'];

                $returns = [
                    'chapel' => $data,
                    'rgis' => $rgis,
                    'parishes' => $parishes,
                    'page_title' => __('chapels/views.data_chapels'),
                    'css' => 'chapel',
                    'js' => 'chapel',
                    'message' => 'CNPJ inválido',
                    'action' => [
                        'name' => __('default/actions.save')
                    ]
                ];

                return view('pages.chapel.create', $returns);
            }
        } else {
            $data['user_id'] = Auth::id();
            $chapel = Chapel::find($id);

            if ($chapel) {
                $result = $chapel->fill($data)->save();

                if ($result) {
                    flashMessage($request, __('default/actions.updated_success'), 'success');
                    return redirect(route('chapels.show', $chapel->id));
                } else {
                    flashMessage($request, __('default/actions.updated_danger'), 'danger');
                    return redirect(route('chapels.edit', $chapel->id))->withInput();
                }

            } else {
                flashMessage($request, __('default/actions.not_found'), 'success');
                return redirect(route('chapels.index'));
            }
        }

        flashMessage($request, __('default/actions.created_error'), 'warning');
        return redirect(route('chapels.index'));
    }

    public function destroy($id)
    {
        $chapel = Chapel::find($id);
        if ($chapel) {
            $result = $chapel->delete();
            if ($result) {
                return response()->json(['url' => route('chapels.index')]);
            } else {
                throw new Exception(__('default/actions.deleted_error'));
            }
        }
        throw new Exception(__('default/actions.not_found'));
    }
}
