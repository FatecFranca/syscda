@extends('layouts.app')

@section('content')
    @include('components.header')
    <ul class="nav nav-tabs" id="tabPeople" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="person-tab" data-toggle="tab"
               href="#person" role="tab" aria-controls="person"
               aria-selected="true">{{ __('people/views.data_person') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="type_person-tab" data-toggle="tab"
               href="#type_person_tab" role="tab" aria-controls="type_person"
               aria-selected="false">{{ __('types/people/views.type_people') }}</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabPeople">
        <div class="tab-pane fade show active" id="person" role="tabpanel" aria-labelledby="person-tab">
            <form class="form" method="POST" action="{{ route('people.update', ['id' => $person->id]) }}">
                @method('PUT')
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6 ">
                        <label for="name">{{ __('default/views.name') }} *</label>
                        <input max="255" required type="text" class="form-control" id="name" name="name"
                               value="{{ old('name', isset($person) ? $person['name'] : null) }}">
                        @if(count($errors) && $errors->first('name'))
                            <div class="badge badge-danger">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6 ">
                        <label for="nickname">{{ __('default/views.nickname') }} </label>
                        <input max="100" type="text" class="form-control" id="nickname" name="nickname"
                               value="{{ old('nickname', isset($person) ? $person['nickname'] : null) }}">
                        @if(count($errors) && $errors->first('nickname'))
                            <div class="badge badge-danger">
                                {{ $errors->first('nickname') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6 ">
                        <label for="date_birthday">{{ __('default/views.date_birthday') }} *</label>
                        <input type="date" class="form-control" id="date_birthday" name="date_birthday"
                               value="{{ old('date_birthday', isset($person) ? $person['date_birthday'] : null) }}">
                        @if(count($errors) && $errors->first('date_birthday'))
                            <div class="badge badge-danger">
                                {{ $errors->first('date_birthday') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6 ">
                        <label for="cpf">{{ __('default/views.cpf') }} *</label>
                        <input type="text" class="form-control" id="cpf" name="cpf"
                               value="{{ old('cpf', isset($person) ? $person['cpf'] : null) }}">
                        @if(count($errors) && $errors->first('cpf'))
                            <div class="badge badge-danger">
                                {{ $errors->first('cpf') }}
                            </div>
                        @endif
                        @if(session('invalid_cpf'))
                            <div class="badge badge-danger">
                                {{ session('invalid_cpf') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6 ">
                        <label for="email">{{ __('default/views.email') }} </label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="{{ old('email', isset($person) ? $person['email'] : null) }}">
                        @if(count($errors) && $errors->first('email'))
                            <div class="badge badge-danger">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-3 ">
                        <label for="telephone">{{ __('default/views.telephone') }} </label>
                        <input type="telephone" class="form-control" id="telephone" name="telephone"
                               value="{{ old('telephone', isset($person) ? $person['telephone'] : null) }}">
                        @if(count($errors) && $errors->first('telephone'))
                            <div class="badge badge-danger">
                                {{ $errors->first('telephone') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-3 ">
                        <label for="marital_status">{{ __('default/views.marital_status') }} </label>
                        <select required class="custom-select" id="marital_status" name="marital_status"
                                value="{{ old('marital_status') }}">
                            <option disabled>{{ __('default/views.selectOption') }}</option>
                            @foreach(marital_status() as $marital_status)
                                <option @if($marital_status == $person->marital_status) selected="selected" @endif
                                value="{{ $marital_status }}">{{ $marital_status }}</option>
                            @endforeach
                        </select>
                        @if(count($errors) && $errors->first('marital_status'))
                            <div class="badge badge-danger">
                                {{ $errors->first('marital_status') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="parish_id">{{ __('parishes/views.parish') }} *</label>
                        <select required class="custom-select" id="parish_id" name="parish_id"
                                value="{{ old('parish_id') }}">
                            <option selected disabled value="0">{{ __('default/views.selectOption') }}</option>
                            @foreach($parishes as $parish)
                                <option @if(isset($person) && $person['parish_id'] == $parish->id) selected="selected"
                                        @endif
                                        value="{{ $parish->id }}">{{ $parish->name }}</option>
                            @endforeach

                        </select>
                        @if(count($errors) && $errors->first('parish_id'))
                            <div class="badge badge-danger">
                                {{ $errors->first('parish_id') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="rgi_id">{{ __('rgi/views.rgi') }} *</label>
                        <select required class="custom-select" id="rgi_id" name="rgi_id"
                                value="{{ old('rgi_id') }}">
                            <option selected disabled value="0">{{ __('default/views.selectOption') }}</option>
                            @foreach($rgis as $rgi)
                                <option @if(isset($person) && $person['rgi_id'] == $rgi->id) selected="selected" @endif
                                value="{{ $rgi->id }}">{{ $rgi->rgi_number . ' - '  . $rgi->address->street . ' - ' . $rgi->number  }}</option>
                            @endforeach

                        </select>
                        @if(count($errors) && $errors->first('rgi_id'))
                            <div class="badge badge-danger">
                                {{ $errors->first('rgi_id') }}
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
        <div data-url="{{ route('people.type_people.types.store') }}" class="tab-pane fade" id="type_person_tab"
             role="tabpanel" aria-labelledby="type_person-tab">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="type_person">{{ __('types/people/views.type_people') }} *</label>
                    <select class="custom-select" name="type_person" id="type_person">
                        <option selected disabled value="0">{{ __('default/views.selectOption') }}</option>
                        @foreach($type_people as $type_person)
                            <option value="{{ $type_person->id }}"> {{ $type_person->description }}</option>
                        @endforeach
                    </select>
                    <div id="type-person-error" class="badge badge-danger el-hide">Tipo de Pessoa é obrigatório.</div>
                    <div id="type-person-back" class="badge badge-danger el-hide"></div>
                    <input type="hidden" id="person_id" value="{{ $person->id }}">
                </div>
            </div>
            <button id="add-type-person"
                    class="btn btn-primary">{{ __('default/actions.add') . ' ' . __('types/people/views.type_person') }}</button>
            <table id="type-person-table" style="margin-top: 0.5rem" class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">{{ __('default/views.id') }}</th>
                    <th scope="col">{{ __('types/people/views.type_person') }}</th>
                    <th scope="col">{{ __('default/views.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($person->people_types as $type_person)
                    <tr>
                        <td>{{ $type_person->id }}</td>
                        <td>{{ $type_person->description }}</td>
                        <td>
                            <button data-modal-delete data-target="#modalDeleteCenter"
                                    data-url-destroy="{{ route('people.type_people.types.destroy', ['person_id' => $person->id,
                                    'type_person_id' => $type_person->id]) }}"
                                    class="btn btn-danger">{{ __('default/actions.destroy') }}</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
