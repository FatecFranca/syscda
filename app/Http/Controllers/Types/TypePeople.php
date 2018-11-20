<?php

namespace App\Http\Controllers\Types;

use App\Models\TypePerson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TypePeople extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $type_people = TypePerson::orderBy('id', 'desc')->paginate(config('app.PAGINATION_COUNT'));

        $returns = [
            'type_people' => $type_people,
            'page_title' => __('types/people/views.type_people'),
            'css' => 'type_people',
            'js' => 'type_people',
            'action' => [
                'name' => __('default/actions.new')
            ]
        ];

        return view('pages.types.people.index', $returns);
    }

    public function show($id)
    {
        $type_person = TypePerson::find($id);

        if ($type_person) {
            $returns = [
                'type_person' => $type_person,
                'page_title' => __('types/people/views.type_person') . ' #' . $type_person->id,
                'css' => 'type_people',
                'js' => 'type_people',
                'action' => [
                    'name' => __('default/actions.edit')
                ]
            ];

            return view('pages.types.people.show', $returns);
        }
    }

    public function create()
    {
        $returns = [
            'page_title' => __('default/actions.create') . ' ' . __('types/people/views.type_person'),
            'css' => 'type_people',
            'js' => 'type_people',
            'action' => [
                'name' => __('default/actions.add')
            ]
        ];

        return view('pages.types.people.create', $returns);
    }

    public function store(Request $request)
    {

        $messages = [
            'description.required' => 'Descrição é obrigatório.'
        ];

        $this->validate($request, [
            'description' => 'required',
        ], $messages);

        $data = request()->except(['_token']);
        $data['user_id'] = Auth::id();
        $type_person = TypePerson::firstOrCreate($data);

        if ($type_person) {
            flashMessage($request, __('default/actions.created_success'), 'success');
            return redirect(route('type_people.show', $type_person->id));
        }

        flashMessage($request, __('default/actions.created_error'), 'warning');
        return redirect(route('type_people.index'));
    }

    public function edit($id, Request $request)
    {
        $type_person = TypePerson::find($id);

        if ($type_person) {
            $returns = [
                'type_person' => $type_person,
                'page_title' => __('default/actions.edit') . ' #' . $type_person->id,
                'css' => 'type_people',
                'js' => 'type_people',
                'action' => [
                    'name' => __('default/actions.save')
                ]
            ];

            return view('pages.types.people.edit', $returns);
        }

        flashMessage($request, __('default/actions.not_found'), 'warning');
        return redirect(route('rgi.index'));
    }

    public function update($id, Request $request)
    {
        $messages = [
            'description.required' => 'Descrição é obrigatório.'
        ];

        $this->validate($request, [
            'description' => 'required',
        ], $messages);

        $data = $request->all();
        $type_person = TypePerson::find($id);

        if ($type_person) {
            $result = $type_person->fill($data)->save();
            if ($result) {
                flashMessage($request, __('default/actions.updated_success'), 'success');
                return redirect(route('type_people.show', $type_person->id));
            } else {
                flashMessage($request, __('default/actions.updated_danger'), 'danger');
                return redirect(route('type_people.edit', $type_person->id))->withInput();
            }
        }

        flashMessage($request, __('default/actions.not_found'), 'warning');
        return redirect(route('type_people.index'));

    }

    public function destroy($id, Request $request)
    {
        $type_person = TypePerson::find($id);
        if ($type_person) {
            $result = $type_person->delete();
            if ($result) {
                return response()->json(['url' => route('type_people.index')]);
            } else {
                flashMessage($request, __('default/actions.created_error'), 'warning');
                return redirect(route('type_people.index'));
            }
        }
        flashMessage($request, __('default/actions.not_found'), 'warning');
        return redirect(route('type_people.index'));
    }

}
