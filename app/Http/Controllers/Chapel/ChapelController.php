<?php

namespace App\Http\Controllers\Chapel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Chapel;
use App\Address;
use App\Parish;

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

            $addresses = Address::orderBy('id', 'desc')->get();
            $parishes = Parish::orderBy('id', 'desc')->get();
    
            $returns = [
                'chapel' => $chapel,
                'addresses' => $addresses,
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
        
    }

    public function create()
    {
        $addresses = Address::orderBy('id', 'desc')->get();
        $parishes = Parish::orderBy('id', 'desc')->get();

        $returns = [
            'addresses' => $addresses,
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
            'address_id.required' => 'Endereço é obrigatório.',
            'parish_id.required' => 'Paróquia é obrigatório.'
        ];

        $this->validate($request, [
            'name' => "required",
            'responsible' => "required",
            'telephone' => "required",
            'email' => "unique:parishes",
            'address_id' => 'required',
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

                $addresses = Address::orderBy('id', 'desc')->get();
                $parishes = Parish::orderBy('id', 'desc')->get();

                $returns = [
                    'chapel' => $data,
                    'addresses' => $addresses,
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
}
