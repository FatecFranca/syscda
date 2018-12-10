<?php

namespace App\Http\Controllers\Parish;

use App\Models\Address;
use App\Models\Forania;
use App\Models\Parish;
use App\Models\RGI;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ParishController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $parishes = Parish::orderBy('id', 'desc')->paginate(config('app.PAGINATION_COUNT'));

        $returns = [
            'parishes' => $parishes,
            'page_title' => __('parishes/views.parishes'),
            'css' => 'parish',
            'js' => 'parish',
            'action' => [
                'name' => __('default/actions.new')
            ]
        ];

        return view('pages.parish.index', $returns);
    }

    public function show($id, Request $request)
    {
        $parish = Parish::find($id);

        if ($parish) {
            $rgis = RGI::orderBy('id', 'desc')->get();
            $foranias = Forania::orderBy('id', 'desc')->get();

            $returns = [
                'parish' => $parish,
                'rgis' => $rgis,
                'foranias' => $foranias,
                'page_title' => __('parishes/views.parish') . ' #' . $parish->id,
                'css' => 'parish',
                'js' => 'parish',
                'action' => [
                    'name' => __('default/actions.edit')
                ]
            ];

            return view('pages.parish.show', $returns);
        }

        flashMessage($request, __('default/actions.not_found'), 'warning');
        return redirect(route('parishes.index'));

    }

    public function create()
    {
        $rgis = RGI::orderBy('id', 'desc')->get();
        $foranias = Forania::orderBy('id', 'desc')->get();

        if (session('parish')) {
            $parish = session('parish');
        }

        $returns = [
            'parish' => isset($parish) && $parish ? $parish : null,
            'rgis' => $rgis,
            'foranias' => $foranias,
            'page_title' => __('parishes/views.data_parish'),
            'css' => 'parish',
            'js' => 'parish',
            'action' => [
                'name' => __('default/actions.add')
            ]
        ];

        return view('pages.parish.create', $returns);
    }

    public function store(Request $request)
    {
        $message = [
            'name.required' => "Nome é obrigatório.",
            'responsible.required' => "Responsável é obrigatório.",
            'telephone.required' => "Telefone é obrigatório.",
            'email.unique' => 'E-mail já existente.',
            'rgi_id.required' => 'Endereço é obrigatório.',
            'forania_id.required' => 'Forania é obrigatório.'
        ];

        $data = $request->all();

        if ($data['email']) {
            $this->validate($request, [
                'name' => "required",
                'responsible' => "required",
                'telephone' => "required",
                'email' => "unique:parishes",
                'rgi_id' => 'required',
                'forania_id' => 'required'
            ], $message);

        } else {
            $this->validate($request, [
                'name' => "required",
                'responsible' => "required",
                'telephone' => "required",
                'rgi_id' => 'required',
                'forania_id' => 'required'
            ], $message);

        }


        $data['telephone'] = removeMaskTelephone($data['telephone']);

        $data['cnpj'] = removeMaskCNPJ($data['cnpj']);

        if ($data['cnpj']) {
            if (validar_cnpj($data['cnpj'])) {

                $data['user_id'] = Auth::id();
                $parish = Parish::create($data);

                if ($parish) {
                    flashMessage($request, __('default/actions.created_success'), 'success');
                    return redirect(route('parishes.show', $parish->id));
                }

            } else {

                return redirect('parishes/create')
                    ->with('parish', $data)
                    ->with('message', 'CNPJ inválido');
            }
        } else {
            $data['user_id'] = Auth::id();
            $parish = Parish::create($data);
            if ($parish) {
                flashMessage($request, __('default/actions.created_success'), 'success');
                return redirect(route('parishes.show', $parish->id));
            }
        }

        flashMessage($request, __('default/actions.created_error'), 'warning');
        return redirect(route('parishes.index'));
    }

    public function edit($id, Request $request)
    {
        $parish = Parish::find($id);

        if ($parish) {
            $rgis = RGI::orderBy('id', 'desc')->get();
            $foranias = Forania::orderBy('id', 'desc')->get();

            if (session('cnpj')) {
                $parish->cnpj = session('cnpj');
            }

            $returns = [
                'parish' => $parish,
                'rgis' => $rgis,
                'foranias' => $foranias,
                'page_title' => __('default/actions.edit') . ' ' . __('parishes/views.parish') . ' #' . $parish->id,
                'css' => 'parish',
                'js' => 'parish',
                'action' => [
                    'name' => __('default/actions.save')
                ]
            ];

            return view('pages.parish.edit', $returns);
        }

        flashMessage($request, __('default/actions.not_found'), 'warning');
        return redirect(route('parishes.index'));
    }

    public function update($id, Request $request)
    {
        $message = [
            'name.required' => "Nome é obrigatório.",
            'responsible.required' => "Responsável é obrigatório.",
            'telephone.required' => "Telefone é obrigatório.",
            'email.unique' => 'E-mail já existente.',
            'rgi_id.required' => 'Endereço é obrigatório.',
            'forania_id.required' => 'Forania é obrigatório.'
        ];

        $data = $request->all();

        if ($data['email']) {
            $this->validate($request, [
                'name' => "required",
                'responsible' => "required",
                'telephone' => "required",
                'email' => "unique:parishes,email," . $id,
                'rgi_id' => 'required',
                'forania_id' => 'required'
            ], $message);
        } else {
            $this->validate($request, [
                'name' => "required",
                'responsible' => "required",
                'telephone' => "required",
                'rgi_id' => 'required',
                'forania_id' => 'required'
            ], $message);
        }


        $data['telephone'] = removeMaskTelephone($data['telephone']);

        $data['cnpj'] = removeMaskCNPJ($data['cnpj']);

        $parish = Parish::find($id);
        if ($data['cnpj']) {
            if (validar_cnpj($data['cnpj'])) {

                $data['user_id'] = Auth::id();

                if ($parish) {
                    $result = $parish->fill($data)->save();
                    if ($result) {
                        flashMessage($request, __('default/actions.updated_success'), 'success');
                        return redirect(route('parishes.show', $parish->id));
                    } else {
                        flashMessage($request, __('default/actions.updated_danger'), 'danger');
                        return redirect(route('parishes.edit', $parish->id))->withInput();
                    }
                }

                flashMessage($request, __('default/actions.not_found'), 'success');
                return redirect(route('parishes.index'));

            } else {

                return redirect()->route('parishes.edit', ['id' => $parish->id])
                    ->with('cpf', $data['cnpj'])
                    ->with('message', 'CNPJ inválido');
            }
        } else {
            $data['user_id'] = Auth::id();
            $parish = Parish::find($id);

            if ($parish) {
                $result = $parish->fill($data)->save();

                if ($result) {
                    flashMessage($request, __('default/actions.updated_success'), 'success');
                    return redirect(route('parishes.show', $parish->id));
                } else {
                    flashMessage($request, __('default/actions.updated_danger'), 'danger');
                    return redirect(route('parishes.edit', $parish->id))->withInput();
                }

            } else {
                flashMessage($request, __('default/actions.not_found'), 'success');
                return redirect(route('parishes.index'));
            }

        }

        flashMessage($request, __('default/actions.updated_error'), 'warning');
        return redirect(route('parishes.index'));
    }

    public function destroy($id)
    {
        $parish = Parish::find($id);
        if ($parish) {
            $result = $parish->delete();
            if ($result) {
                return response()->json(['url' => route('parishes.index')]);
            } else {
                throw new Exception(__('default/actions.deleted_error'));
            }
        }
        throw new Exception(__('default/actions.not_found'));
    }
}
