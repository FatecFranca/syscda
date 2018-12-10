<?php

namespace App\Http\Controllers\Diocese;

use App\Models\Address;
use App\Models\Diocese;
use App\Models\RGI;
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
        $rgis = RGI::orderBy('id', 'desc')->get();

        if ($diocese) {
            $returns = [
                'diocese' => $diocese,
                'rgis' => $rgis,
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
        $rgis = RGI::orderBy('id', 'desc')->get();

        if (session('diocese')) {
            $diocese = session('diocese');
        }

        $returns = [
            'diocese' => isset($diocese) && $diocese ? $diocese : null,
            'rgis' => $rgis,
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
            'rgi_id.required' => 'RGI é obrigatório.'
        ];

        $data = $request->all();

        if ($data['email']) {
            $this->validate($request, [
                'name' => "required",
                'responsible' => "required",
                'telephone' => "required",
                'email' => "unique:dioceses",
                'rgi_id' => 'required'
            ], $message);
        } else {
            $this->validate($request, [
                'name' => "required",
                'responsible' => "required",
                'telephone' => "required",
                'rgi_id' => 'required'
            ], $message);
        }




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
                return redirect('dioceses/create')
                    ->with('diocese', $data)
                    ->with('message', 'CNPJ inválido');
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
        $rgis = RGI::orderBy('id', 'desc')->get();

        if (session('cnpj')) {
            $diocese->cnpj = session('cnpj');
        }

        if ($diocese) {
            $returns = [
                'diocese' => $diocese,
                'rgis' => $rgis,
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
            'rgi_id.required' => 'Endereço é obrigatório.'
        ];

        $this->validate($request, [
            'name' => "required",
            'responsible' => "required",
            'telephone' => "required",
            'email' => "unique:dioceses,email," . $id,
            'rgi_id' => 'required'
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

                return redirect()->route('dioceses.edit', ['id' => $diocese->id])
                    ->with('cpf', $data['cnpj'])
                    ->with('message', 'CNPJ inválido');
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
