@extends('layouts.app')

@section('content')
    @include('components.header', ['urlAction' => route('people.edit', ['id' => $person->id])])
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
            <div class="form-row">
                <div class="form-group col-md-6 ">
                    <label for="name">{{ __('default/views.name') }} *</label>
                    <input disabled required type="text" class="form-control" id="name" name="name"
                           value="{{ old('name', isset($person) ? $person['name'] : null) }}">
                </div>
                <div class="form-group col-md-6 ">
                    <label for="nickname">{{ __('default/views.nickname') }} </label>
                    <input disabled max="100" type="text" class="form-control" id="nickname" name="nickname"
                           value="{{ old('nickname', isset($person) ? $person['nickname'] : null) }}">
                </div>
                <div class="form-group col-md-6 ">
                    <label for="date_birthday">{{ __('default/views.date_birthday') }} *</label>
                    <input disabled type="date" class="form-control" id="date_birthday" name="date_birthday"
                           value="{{ old('date_birthday', isset($person) ? $person['date_birthday'] : null) }}">
                </div>
                <div class="form-group col-md-6 ">
                    <label for="cpf">{{ __('default/views.cpf') }} *</label>
                    <input disabled type="text" class="form-control" id="cpf" name="cpf"
                           value="{{ old('cpf', isset($person) ? $person['cpf'] : null) }}">
                </div>
                <div class="form-group col-md-6 ">
                    <label for="email">{{ __('default/views.email') }} </label>
                    <input disabled type="email" class="form-control" id="email" name="email"
                           value="{{ old('email', isset($person) ? $person['email'] : null) }}">
                </div>
                <div class="form-group col-md-3 ">
                    <label for="telephone">{{ __('default/views.telephone') }} </label>
                    <input disabled type="telephone" class="form-control" id="telephone" name="telephone"
                           value="{{ old('telephone', isset($person) ? $person['telephone'] : null) }}">
                </div>
                <div class="form-group col-md-3 ">
                    <label for="marital_status">{{ __('default/views.marital_status') }} </label>
                    <select disabled required class="custom-select" id="marital_status" name="marital_status"
                            value="{{ old('marital_status', isset($person) ? $person['marital_status'] : null) }}">
                        @foreach(marital_status() as $marital_status)
                            <option @if($marital_status == $person->marital_status) selected="selected" @endif
                            value="{{ $marital_status }}">{{ $marital_status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="parish_id">{{ __('parishes/views.parish') }} *</label>
                    <select disabled required class="custom-select" id="parish_id" name="parish_id"
                            value="{{ old('parish_id') }}">
                        <option selected disabled value="0">{{ __('default/views.selectOption') }}</option>
                        @foreach($parishes as $parish)
                            <option @if(isset($person) && $person['parish_id'] == $parish->id) selected="selected"
                                    @endif
                                    value="{{ $parish->id }}">{{ $parish->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="rgi_id">{{ __('rgi/views.rgi') }} * {{ old('rgi_id') }}</label>
                    <select disabled required class="custom-select" id="rgi_id" name="rgi_id"
                            value="{{ old('rgi_id') }}">
                        <option selected disabled value="0">{{ __('default/views.selectOption') }}</option>
                        @foreach($rgis as $rgi)
                            <option @if(isset($person) && $person['rgi_id'] == $rgi->id) selected="selected" @endif
                            value="{{ $rgi->id }}">{{ $rgi->rgi_number . ' - '  . $rgi->address->street . ' - ' . $rgi->number  }}</option>
                        @endforeach

                    </select>
                </div>
            </div>
        </div>
        <div data-url="{{ route('people.type_people.types.store') }}" class="tab-pane fade" id="type_person_tab">
            <table id="type-person-table" style="margin-top: 0.5rem" class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">{{ __('default/views.id') }}</th>
                    <th scope="col">{{ __('types/people/views.type_person') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($person->people_types as $type_person)
                    <tr>
                        <td>{{ $type_person->id }}</td>
                        <td>{{ $type_person->description }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
