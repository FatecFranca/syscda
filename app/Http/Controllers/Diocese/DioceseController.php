<?php

namespace App\Http\Controllers\Diocese;

use App\Models\Address;
use App\Models\Diocese;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DioceseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dioceses = Diocese::orderBy('id', 'desc')->paginate(config('app.PAGINATION_COUNT'));

        $returns = [
            'dioceses' => $dioceses,
            'page_title' => __('dioceses/views.dioceses'),
            'css' => 'diocese',
            'js' => 'diocese',
            'action' => [
                'name' => __('default/actions.new')
            ]
        ];

        return view('pages.diocese.index', $returns);
    }

    public function show($id, Request $request)
    {
        $diocese = Diocese::find($id);
        $addresses = Address::orderBy('id', 'desc')->get();

        if ($diocese) {
            $returns = [
                'diocese' => $diocese,
                'addresses' => $addresses,
                'page_title' => __('dioceses/views.diocese') . ' #' . $diocese->id,
                'css' => 'diocese',
                'js' => 'diocese',
                'action' => [
                    'name' => __('default/actions.edit')
                ]
            ];
            return view('pages.diocese.show', $returns);
        }

        flashMessage($request, __('default/actions.not_found'), 'warning');
        return redirect(route('diocese.index'));
    }

    public function create()
    {
        $addresses = Address::orderBy('id', 'desc')->get();

        $returns = [
            'addresses' => $addresses,
            'page_title' => __('default/actions.create') . ' ' . __('dioceses/views.diocese'),
            'css' => 'diocese',
            'js' => 'diocese',
            'action' => [
                'name' => __('default/actions.add')
            ]
        ];

        return view('pages.diocese.create', $returns);
    }

    public function store(Request $request)
    {

        $message = [
            'name.required' => "Nome é obrigatório.",
            'responsible.required' => "Responsável é obrigatório.",
            'telephone.required' => "Telefone é obrigatório.",
            'email.unique' => 'E-mail já existente.',
            'address_id.required' => 'Endereço é obrigatório.'
        ];

        $this->validate($request, [
            'name' => "required",
            'responsible' => "required",
            'telephone' => "required",
            'email' => "unique:dioceses",
            'address_id' => 'required'
        ], $message);

        $data = $request->all();

        $data['telephone'] = removeMaskTelephone($data['telephone']);

        $data['cnpj'] = removeMaskCNPJ($data['cnpj']);

        if ($data['cnpj']) {
            if (validar_cnpj($data['cnpj'])) {

                $data['user_id'] = Auth::id();
                $diocese = Diocese::create($data);

                if ($diocese) {
                    flashMessage($request, __('default/actions.created_success'), 'success');
                    return redirect(route('dioceses.show', $diocese->id));
                }

            } else {
                $addresses = Address::orderBy('id', 'desc')->get();

                $returns = [
                    'diocese' => $data,
                    'addresses' => $addresses,
                    'page_title' => __('dioceses/views.dioceses'),
                    'css' => 'diocese',
                    'js' => 'diocese',
                    'message' => 'CNPJ inválido',
                    'action' => [
                        'name' => __('default/actions.add')
                    ]
                ];

                return view('pages.diocese.create', $returns);
            }
        } else {
            $data['user_id'] = Auth::id();

            $diocese = Diocese::create($data);

            flashMessage($request, __('default/actions.created_success'), 'success');

            return redirect(route('dioceses.show', $diocese->id));
        }

        flashMessage($request, __('default/actions.created_error'), 'warning');
        return redirect(route('dioceses.index'));
    }

    public function edit($id, Request $request)
    {
        $diocese = Diocese::find($id);
        $addresses = Address::orderBy('id', 'desc')->get();

        if ($diocese) {
            $returns = [
                'diocese' => $diocese,
                'addresses' => $addresses,
                'page_title' => __('default/actions.edit') . ' ' . __('dioceses/views.diocese') . ' #' . $diocese->id,
                'css' => 'diocese',
                'js' => 'diocese',
                'action' => [
                    'name' => __('default/actions.save')
                ]
            ];
            return view('pages.diocese.edit', $returns);
        }

        flashMessage($request, __('default/actions.not_found'), 'warning');
        return redirect(route('diocese.index'));
    }

    public function update($id, Request $request)
    {
        $message = [
            'name.required' => "Nome é obrigatório.",
            'responsible.required' => "Responsável é obrigatório.",
            'telephone.required' => "Telefone é obrigatório.",
            'email.unique' => 'E-mail já existente.',
            'address_id.required' => 'Endereço é obrigatório.'
        ];

        $this->validate($request, [
            'name' => "required",
            'responsible' => "required",
            'telephone' => "required",
            'email' => "unique:dioceses,email," . $id,
            'address_id' => 'required'
        ], $message);

        $data = $request->all();

        $data['telephone'] = removeMaskTelephone($data['telephone']);

        $data['cnpj'] = removeMaskCNPJ($data['cnpj']);

        if ($data['cnpj']) {

            if (validar_cnpj($data['cnpj'])) {

                $data['user_id'] = Auth::id();
                $diocese = Diocese::find($id);

                if ($diocese) {
                    $result = $diocese->fill($data)->save();
                    if ($result) {
                        flashMessage($request, __('default/actions.updated_success'), 'success');
                        return redirect(route('dioceses.show', $diocese->id));
                    } else {
                        flashMessage($request, __('default/actions.updated_danger'), 'danger');
                        return redirect(route('dioceses.edit', $diocese->id))->withInput();
                    }
                }
                flashMessage($request, __('default/actions.not_found'), 'success');

                return redirect(route('dioceses.index'));
            } else {
                $addresses = Address::orderBy('id', 'desc')->get();

                $diocese = new Diocese();

                $diocese->id = $id;
                $diocese->name = $data['name'];
                $diocese->opening_date = $data['opening_date'];
                $diocese->responsible = $data['responsible'];
                $diocese->telephone = $data['telephone'];
                $diocese->cnpj = $data['cnpj'];
                $diocese->email = $data['email'];

                $returns = [
                    'diocese' => $diocese,
                    'addresses' => $addresses,
                    'page_title' => __('dioceses/views.diocese') . ' #' . $diocese->id,
                    'css' => 'diocese',
                    'js' => 'diocese',
                    'message' => 'CNPJ inválido',
                    'action' => [
                        'name' => __('default/actions.save')
                    ]
                ];

                return view('pages.diocese.edit', $returns);
            }

        } else {
            $data['user_id'] = Auth::id();
            $diocese = Diocese::find($id);

            if ($diocese) {
                $result = $diocese->fill($data)->save();
                if ($result) {
                    flashMessage($request, __('default/actions.updated_success'), 'success');
                    return redirect(route('dioceses.show', $diocese->id));
                } else {
                    flashMessage($request, __('default/actions.updated_danger'), 'danger');
                    return redirect(route('dioceses.edit', $diocese->id))->withInput();
                }
            }
        }

        flashMessage($request, __('default/actions.updated_error'), 'warning');
        return redirect(route('dioceses.index'));
    }

    public function destroy($id, Request $request)
    {
        $diocese = Diocese::find($id);
        if ($diocese) {
            $result = $diocese->delete();
            if ($result) {
                return response()->json(['url' => route('dioceses.index')]);
            } else {
                throw new Exception(__('default/actions.deleted_error'));
            }
        }
        throw new Exception(__('default/actions.not_found'));
    }
}
