<?php

namespace App\Http\Controllers\Person;

use App\Models\Parish;
use App\Models\Person;
use App\Models\RGI;
use App\Models\TypePerson;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PersonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $people = Person::orderBy('id', 'desc')->paginate(config('app.PAGINATION_COUNT'));

        $returns = [
            'people' => $people,
            'page_title' => __('people/views.people'),
            'css' => 'person',
            'js' => 'person',
            'action' => [
                'name' => __('default/actions.new')
            ]
        ];

        return view('pages.person.index', $returns);
    }

    public function show($id)
    {
        $rgis = RGI::orderBy('id', 'desc')->get();
        $parishes = Parish::orderBy('id', 'desc')->get();

        $person = Person::find($id);

        $returns = [
            'person' => $person,
            'rgis' => $rgis,
            'parishes' => $parishes,
            'page_title' => __('people/views.person') . ' #' . $person->id,
            'css' => 'person',
            'js' => 'person',
            'action' => [
                'name' => __('default/actions.edit')
            ]
        ];

        return view('pages.person.show', $returns);
    }

    public function create()
    {
        $rgis = RGI::orderBy('id', 'desc')->get();
        $parishes = Parish::orderBy('id', 'desc')->get();

        if (session('person')) {
            $person = session('person');
        }
        $returns = [
            'person' => isset($person) && $person ? $person : null,
            'rgis' => $rgis,
            'parishes' => $parishes,
            'page_title' => __('people/views.data_person'),
            'css' => 'person',
            'js' => 'person',
            'action' => [
                'name' => __('default/actions.add')
            ]
        ];

        return view('pages.person.create', $returns);
    }

    public function store(Request $request)
    {
        $message = [
            'name.required' => "Nome é obrigatório.",
            'email.unique' => "E-mail já existente.",
            'date_birthday.unique' => "Data de Nascimento é obrigatório.",
            'marital_status.required' => "Estado civil é obrigatório.",
            'rgi_id.required' => "RGI é obrigatório.",
            'parish_id.required' => "Paróquia é obrigatório."
        ];

        $this->validate($request, [
            'name' => "required",
            'date_birthday' => "required",
            'marital_status' => "required",
            'email' => "unique:people",
            'rgi_id' => "required",
            'parish_id' => "required"
        ], $message);

        $data = $request->all();

        $data['cpf'] = removeMaskCPF($data['cpf']);
        $data['telephone'] = removeMaskTelephone($data['telephone']);

        if ($data['cpf']) {
            if (validar_cpf($data['cpf'])) {

                $data['user_id'] = Auth::id();
                $person = Person::create($data);

                if ($person) {
                    flashMessage($request, __('default/actions.created_success'), 'success');
                    return redirect(route('people.show', $person->id));
                }

            } else {
                return redirect('people/create')
                    ->with('person', $data)
                    ->with('invalid_cpf', 'CPF inválido');
            }
        } else {
            $data['user_id'] = Auth::id();
            $person = Person::create($data);
            if ($person) {
                flashMessage($request, __('default/actions.created_success'), 'success');
                return redirect(route('peolpe.show', $person->id));
            }
        }

        flashMessage($request, __('default/actions.created_error'), 'warning');
        return redirect(route('peolpe.index'));
    }

    public function edit($id, Request $request)
    {
        $rgis = RGI::orderBy('id', 'desc')->get();
        $parishes = Parish::orderBy('id', 'desc')->get();
        $person = Person::find($id);
        $type_people = TypePerson::orderBy('id', 'desc')->get();

        if (session('cpf')) {
            $person->cpf = session('cpf');
        }

        if ($person) {
            $returns = [
                'person' => $person,
                'rgis' => $rgis,
                'parishes' => $parishes,
                'type_people' => $type_people,
                'page_title' => __('default/actions.edit') . ' ' . __('people/views.person') . ' #' . $person->id,
                'css' => 'person',
                'js' => 'person',
                'action' => [
                    'name' => __('default/actions.save')
                ]
            ];

            return view('pages.person.edit', $returns);
        }

        flashMessage($request, __('default/actions.not_found'), 'warning');
        return redirect(route('people.index'));
    }

    public function update($id, Request $request)
    {
        $message = [
            'name.required' => "Nome é obrigatório.",
            'email.unique' => "E-mail já existente.",
            'date_birthday.unique' => "Data de Nascimento é obrigatório.",
            'marital_status.required' => "Estado civil é obrigatório.",
            'rgi_id.required' => "RGI é obrigatório.",
            'parish_id.required' => "Paróquia é obrigatório."
        ];

        $this->validate($request, [
            'name' => "required",
            'date_birthday' => "required",
            'marital_status' => "required",
            'email' => "unique:people,email," . $id,
            'rgi_id' => "required",
            'parish_id' => "required"
        ], $message);

        $data = $request->all();

        $data['cpf'] = removeMaskCPF($data['cpf']);
        $data['telephone'] = removeMaskTelephone($data['telephone']);


        $person = Person::find($id);

        if ($data['cpf']) {
            if (validar_cpf($data['cpf'])) {

                $data['user_id'] = Auth::id();


                if ($person) {
                    $result = $person->fill($data)->save();
                    if ($result) {
                        flashMessage($request, __('default/actions.updated_success'), 'success');
                        return redirect(route('people.show', $person->id));
                    } else {
                        flashMessage($request, __('default/actions.updated_danger'), 'danger');
                        return redirect(route('people.edit', $person->id))->withInput();
                    }
                    flashMessage($request, __('default/actions.created_success'), 'success');
                    return redirect(route('people.show', $person->id));
                }

                flashMessage($request, __('default/actions.not_found'), 'success');
                return redirect(route('people.index'));

            } else {
                return redirect()->route('people.edit', ['id' => $person->id])
                    ->with('cpf', $data['cpf'])
                    ->with('invalid_cpf', 'CPF inválido');
            }
        } else {
            $data['user_id'] = Auth::id();
            $person = Person::find($id);
            if ($person) {
                $result = $person->fill($data)->save();

                if ($result) {
                    flashMessage($request, __('default/actions.updated_success'), 'success');
                    return redirect(route('people.show', $person->id));
                } else {
                    flashMessage($request, __('default/actions.updated_danger'), 'danger');
                    return redirect(route('people.edit', $person->id))->withInput();
                }

            } else {
                flashMessage($request, __('default/actions.not_found'), 'success');
                return redirect(route('people.index'));
            }
        }

        flashMessage($request, __('default/actions.updated_error'), 'warning');
        return redirect(route('people.index'));
    }

    public function destroy($id)
    {
        $person = Person::find($id);
        if ($person) {
            $result = $person->delete();
            if ($result) {
                return response()->json(['url' => route('people.index')]);
            } else {
                throw new Exception(__('default/actions.deleted_error'));
            }
        }
        throw new Exception(__('default/actions.not_found'));
    }

    public function typePeopleTypesStore(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();

        $fields = ['id', 'description'];

        $person = Person::find($data['person_id']);
        if ($person->people_types->contains($data['type_people_id'])) {
            return json_encode(['duplicated' => 'Esse registro já existe.']);
        } else {
            $person->people_types()->attach($data['type_people_id'], ['user_id' => $data['user_id']]);

            $object = $person->people_types()->find($data['type_people_id']);
        }

        if (isset($object) && $object) {
            $object = view('components.row', ['object' => $object, 'fields' => $fields,
                'urlDestroy' => route('people.type_people.types.destroy', ['person_id' => $person->id,
                    'type_person_id' => $data['type_people_id']])])->render();
            return json_encode($object);
        }
        return json_encode($person);
    }

    public function typePeopleTypesDestroy($person_id, $type_person_id, Request $request)
    {
        $person = Person::find($person_id);

        if ($person->people_types->contains($type_person_id)) {
            $person->people_types()->detach($type_person_id);
            return response()->json(['url' => route('people.edit', ['id' => $person_id])]);
        }

        flashMessage($request, __('default/actions.deleted_error'), 'warning');
        return redirect(route('people.edit', ['id' => $person_id]));
    }
}
