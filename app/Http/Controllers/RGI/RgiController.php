<?php

namespace App\Http\Controllers\RGI;

use App\Address;
use App\RGI;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RgiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $rgis = RGI::orderBy('id', 'desc')->paginate(config('app.PAGINATION_COUNT'));
        $returns = [
            'rgis' => $rgis,
            'page_title' => __('rgi/views.rgis'),
            'css' => 'rgi',
            'js' => 'rgi',
            'action' => [
                'name' => __('default/actions.new')
            ]
        ];

        return view('pages.rgi.index', $returns);
    }

    public function show($id, Request $request)
    {
        $rgi = RGI::find($id);
        $addresses = Address::orderBy('id', 'desc')->get();

        if ($rgi) {
            $returns = [
                'rgi' => $rgi,
                'addresses' => $addresses,
                'page_title' => __('rgi/views.rgi') . ' #' . $rgi->id,
                'css' => 'rgi',
                'js' => 'rgi',
                'action' => [
                    'name' => __('default/actions.edit')
                ]
            ];
            return view('pages.rgi.show', $returns);
        }

        flashMessage($request, __('default/actions.not_found'), 'warning');
        return redirect(route('rgi.index'));
    }

    public function create()
    {
        $addresses = Address::orderBy('id', 'desc')->get();

        $returns = [
            'addresses' => $addresses,
            'page_title' =>  __('default/actions.create') . ' ' .__('rgi/views.rgi'),
            'css' => 'rgi',
            'js' => 'rgi',
            'action' => [
                'name' => __('default/actions.add')
            ]
        ];

        return view('pages.rgi.create', $returns);
    }

    public function store(Request $request)
    {
        $message = [
            'rgi_number.required' => "RGI é obrigatório.",
            'number.required' => "Número da casa é obrigatório.",
            'address_id' => "Endereço é obrigatório"
        ];

        $this->validate($request, [
            'rgi_number' => 'required',
            'number' => 'required',
            'address_id' => 'required'
        ], $message);

        $data = $request->all();
        $rgi = RGI::create($data);

        if ($rgi) {
            flashMessage($request, __('default/actions.created_success'), 'success');
            return redirect(route('rgi.show', $rgi->id));
        }

        flashMessage($request, __('default/actions.not_found'), 'warning');
        return redirect(route('rgi.index'));
    }

    public function edit($id, Request $request)
    {
        $rgi = RGI::find($id);
        $addresses = Address::orderBy('id', 'desc')->get();

        if ($rgi) {
            $returns = [
                'rgi' => $rgi,
                'addresses' => $addresses,
                'page_title' => __('rgi/views.rgi') . ' #' . $rgi->id,
                'css' => 'rgi',
                'js' => 'rgi',
                'action' => [
                    'name' => __('default/actions.save')
                ]
            ];
            return view('pages.rgi.edit', $returns);
        }

        flashMessage($request, __('default/actions.not_found'), 'warning');
        return redirect(route('rgi.index'));
    }

    public function destroy($id, Request $request)
    {
        $rgi = RGI::find($id);
        if ($rgi) {
            $result = $rgi->delete();
            if ($result) {
                return response()->json(['url' => route('rgi.index')]);
            } else {
                throw new Exception(__('default/actions.deleted_error'));
            }
        }
        throw new Exception(__('default/actions.not_found'));
    }
}
