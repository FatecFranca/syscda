<?php

namespace App\Http\Controllers\Parish;

use App\Address;
use App\Forania;
use App\Parish;
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
            $addresses = Address::orderBy('id', 'desc')->get();
            $foranias = Forania::orderBy('id', 'desc')->get();

            $returns = [
                'parish' => $parish,
                'addresses' => $addresses,
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
        $addresses = Address::orderBy('id', 'desc')->get();
        $foranias = Forania::orderBy('id', 'desc')->get();

        $returns = [
            'addresses' => $addresses,
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
            'address_id.required' => 'Endereço é obrigatório.',
            'forania_id.required' => 'Forania é obrigatório.'
        ];

        $this->validate($request, [
            'name' => "required",
            'responsible' => "required",
            'telephone' => "required",
            'email' => "unique:parishes",
            'address_id' => 'required',
            'forania_id' => 'required'
        ], $message);

        $data = $request->all();

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

                $addresses = Address::orderBy('id', 'desc')->get();
                $foranias = Forania::orderBy('id', 'desc')->get();

                $returns = [
                    'parish' => $data,
                    'addresses' => $addresses,
                    'foranias' => $foranias,
                    'page_title' => __('parishes/views.data_parish'),
                    'css' => 'parish',
                    'js' => 'parish',
                    'message' => 'CNPJ inválido',
                    'action' => [
                        'name' => __('default/actions.add')
                    ]
                ];

                return view('pages.parish.create', $returns);
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
            $addresses = Address::orderBy('id', 'desc')->get();
            $foranias = Forania::orderBy('id', 'desc')->get();

            $returns = [
                'parish' => $parish,
                'addresses' => $addresses,
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
            'address_id.required' => 'Endereço é obrigatório.',
            'forania_id.required' => 'Forania é obrigatório.'
        ];

        $this->validate($request, [
            'name' => "required",
            'responsible' => "required",
            'telephone' => "required",
            'email' => "unique:parishes,email," . $id,
            'address_id' => 'required',
            'forania_id' => 'required'
        ], $message);

        $data = $request->all();

        $data['telephone'] = removeMaskTelephone($data['telephone']);

        $data['cnpj'] = removeMaskCNPJ($data['cnpj']);

        if ($data['cnpj']) {
            if (validar_cnpj($data['cnpj'])) {

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
                }

                flashMessage($request, __('default/actions.not_found'), 'success');
                return redirect(route('parishes.index'));

            } else {

                $addresses = Address::orderBy('id', 'desc')->get();
                $foranias = Forania::orderBy('id', 'desc')->get();

                $parish = new Parish();

                $parish->id = $id;
                $parish->name = $data['name'];
                $parish->opening_date = $data['opening_date'];
                $parish->responsible = $data['responsible'];
                $parish->telephone = $data['telephone'];
                $parish->cnpj = $data['cnpj'];
                $parish->email = $data['email'];

                $returns = [
                    'parish' => $data,
                    'addresses' => $addresses,
                    'foranias' => $foranias,
                    'page_title' => __('parishes/views.data_parish'),
                    'css' => 'parish',
                    'js' => 'parish',
                    'message' => 'CNPJ inválido',
                    'action' => [
                        'name' => __('default/actions.add')
                    ]
                ];

                return view('pages.parish.create', $returns);
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
        return redirect(route('parish.index'));
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
