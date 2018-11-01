<?php

namespace App\Http\Controllers\Address;

use App\Models\Address;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $addresses = Address::orderBy('id', 'desc')->paginate(config('app.PAGINATION_COUNT'));

        $returns = [
            'addresses' => $addresses,
            'page_title' => __('addresses/views.addresses'),
            'css' => 'address',
            'js' => 'address',
            'action' => [
                'name' => __('default/actions.add')
            ]
        ];

        return view('pages.address.index', $returns);
    }

    public function show($id, Request $request)
    {
        $address = Address::find($id);

        if ($address) {
            $returns = [
                'address' => $address,
                'page_title' => __('addresses/views.address') . ' #' . $address->id,
                'css' => 'address',
                'js' => 'address',
                'action' => [
                    'name' => __('default/actions.edit')
                ]
            ];
            return view('pages.address.show', $returns);
        }

        flashMessage($request, __('default/actions.not_found'), 'warning');
        return redirect(route('addresses.index'));
    }

    public function create()
    {
        $returns = [
            'page_title' => __('default/actions.create') . ' ' . __('addresses/views.address'),
            'css' => 'address',
            'js' => 'address',
            'action' => [
                'name' => __('default/actions.add')
            ]
        ];

        return view('pages.address.create', $returns);
    }

    public function store(Request $request)
    {
        $message = [
            'zipcode.required' => "CEP é obrigatório.",
            'street.required' => "Rua da casa é obrigatório.",
            'neighborhood.required' => "Bairro da casa é obrigatório.",
            'city.required' => "Cidade da casa é obrigatório.",
            'uf.required' => "UF da casa é obrigatório."
        ];

        $this->validate($request, [
            'zipcode' => "required",
            'street' => "required",
            'neighborhood' => "required",
            'city' => "required",
            'uf' => "required"
        ], $message);

        $data = request()->except(['_token']);
        $data['user_id'] = Auth::id();
        $address = Address::firstOrCreate($data);

        if ($address) {
            flashMessage($request, __('default/actions.created_success'), 'success');
            return redirect(route('addresses.show', $address->id));
        }

        flashMessage($request, __('default/actions.created_error'), 'warning');
        return redirect(route('addresses.index'));
    }

    public function edit($id, Request $request)
    {
        $address = Address::find($id);

        if ($address) {
            $returns = [
                'address' => $address,
                'page_title' => __('default/actions.edit') . ' ' . __('addresses/views.address') . ' #' . $address->id,
                'css' => 'address',
                'js' => 'address',
                'action' => [
                    'name' => __('default/actions.save')
                ]
            ];
            return view('pages.address.edit', $returns);
        }

        flashMessage($request, __('default/actions.not_found'), 'warning');
        return redirect(route('addresses.index'));
    }

    public function update($id, Request $request)
    {
        $message = [
            'zipcode.required' => "CEP é obrigatório.",
            'street.required' => "Rua da casa é obrigatório.",
            'neighborhood.required' => "Bairro da casa é obrigatório.",
            'city.required' => "Cidade da casa é obrigatório.",
            'uf.required' => "UF da casa é obrigatório."
        ];

        $this->validate($request, [
            'zipcode' => "required",
            'street' => "required",
            'neighborhood' => "required",
            'city' => "required",
            'uf' => "required"
        ], $message);

        $data = request()->except(['_token']);
        $address = Address::find($id);

        if ($address) {
            $result = $address->fill($data)->save();
            if ($result) {
                flashMessage($request, __('default/actions.updated_success'), 'success');
                return redirect(route('addresses.show', $address->id));
            } else {
                flashMessage($request, __('default/actions.updated_danger'), 'danger');
                return redirect(route('addresses.edit', $address->id))->withInput();
            }

        }
        flashMessage($request, __('default/actions.not_found'), 'warning');
        return redirect(route('addresses.index'));
    }

    public function destroy($id, Request $request)
    {
        $address = Address::find($id);
        if ($address) {
            $result = $address->delete();
            if ($result) {
                return response()->json(['url' => route('addresses.index')]);
            } else {
                throw new Exception(__('default/actions.deleted_error'));
            }
        }
        throw new Exception(__('default/actions.not_found'));
    }
}
