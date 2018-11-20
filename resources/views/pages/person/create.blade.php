@extends('layouts.app')

@section('content')
    <form class="form" method="POST" action="{{ route('people.store') }}">
        @csrf
        @include('components.header')
        <div class="form-row">
            <div class="form-group col-md-6 ">
                <label for="name">{{ __('default/views.name') }} *</label>
                <input max="500" required type="text" class="form-control" id="name" name="name"
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
                        value="{{ old('marital_status', isset($person) ? $person['marital_status'] : null) }}">
                    <option selected disabled>{{ __('default/views.selectOption') }}</option>
                    @foreach(marital_status() as $marital_status)
                        <option value="{{ $marital_status }}">{{ $marital_status }}</option>
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
                        <option @if(isset($person) && $person['parish_id'] == $parish->id) selected="selected" @endif
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
                <label for="rgi_id">{{ __('rgi/views.rgi') }} * {{ old('rgi_id') }}</label>
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
@endsection
