@extends('layouts.app')

@section('content')
    <form class="form" method="POST" action="{{ route('chapels.store') }}">
        @csrf
        @include('components.header')
        <div class="form-row">
            <div class="form-group col-md-6 ">
                <label for="name">{{ __('default/views.name') }} *</label>
                <input max="255" required type="text" class="form-control" id="name" name="name"
                       value="{{ old('name', isset($chapel) ? $chapel['name'] : null) }}">
                @if(count($errors) && $errors->first('name'))
                    <div class="badge badge-danger">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="opening_date">{{ __('validation.attributes.opening_date') }}</label>
                <input type="date" class="form-control" id="opening_date" name="opening_date"
                       value="{{ old('opening_date', isset($chapel) ? $chapel['opening_date'] : null) }}">
                @if(count($errors) && $errors->first('opening_date'))
                    <div class="badge badge-danger">
                        {{ $errors->first('opening_date') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6 ">
                <label for="responsible">{{ __('validation.attributes.responsible') }} *</label>
                <input required type="text" class="form-control" id="responsible" name="responsible"
                       value="{{ old('responsible', isset($chapel) ? $chapel['responsible'] : null) }}">
                @if(count($errors) && $errors->first('responsible'))
                    <div class="badge badge-danger">
                        {{ $errors->first('responsible') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6 ">
                <label for="cnpj">{{ __('default/views.cnpj') }}</label>
                <input type="text" class="form-control" id="cnpj" name="cnpj"
                       value="{{ old('cnpj', isset($chapel) ? $chapel['cnpj'] : null) }}">
                @if(count($errors) && $errors->first('cnpj'))
                    <div class="badge badge-danger">
                        {{ $errors->first('cnpj') }}
                    </div>
                @endif
                @if(isset($message) && $message)
                    <div class="badge badge-danger">
                        {{ $message }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6 ">
                <label for="email">{{ __('default/views.email') }}</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="{{ old('email', isset($chapel) ? $chapel['email'] : null) }}">
                @if(count($errors) && $errors->first('email'))
                    <div class="badge badge-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6 ">
                <label for="telephone">{{ __('default/views.telephone') }} *</label>
                <input required type="text" class="form-control" id="telephone" name="telephone"
                       value="{{ old('telephone', isset($chapel) ? $chapel['telephone'] : null) }}">
                @if(count($errors) && $errors->first('telephone'))
                    <div class="badge badge-danger">
                        {{ $errors->first('telephone') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="rgi_id">{{ __('rgi/views.rgi') }} * {{ old('rgi_id') }}</label>
                <select required class="custom-select" id="rgi_id" name="rgi_id"
                        value="{{ old('rgi_id') }}">
                    <option selected disabled value="0">{{ __('default/views.selectOption') }}</option>
                    @foreach($rgis as $rgi)
                        <option @if(isset($chapel) && $chapel['rgi_id'] == $rgi->id) selected="selected" @endif
                        value="{{ $rgi->id }}">{{ $rgi->rgi_number . ' - '  . $rgi->address->street . ' - ' . $rgi->number  }}</option>
                    @endforeach

                </select>
                @if(count($errors) && $errors->first('rgi_id'))
                    <div class="badge badge-danger">
                        {{ $errors->first('rgi_id') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="parish_id">{{ __('parishes/views.parish') }} *</label>
                <select required class="custom-select" id="parish_id" name="parish_id"
                        value="{{ old('parish_id', isset($chapel) ? $chapel['parish_id'] : null) }}">
                    <option selected disabled value="0">{{ __('default/views.selectOption') }}</option>
                    @foreach($parishes as $parish)
                        <option @if(isset($chapel) && $chapel['parish_id'] == $parish->id) selected="selected" @endif
                        value="{{ $parish->id }}">{{ $parish->name }}</option>
                    @endforeach

                </select>
                @if(count($errors) && $errors->first('parish_id'))
                    <div class="badge badge-danger">
                        {{ $errors->first('parish_id') }}
                    </div>
                @endif
            </div>
        </div>
    </form>
@endsection
