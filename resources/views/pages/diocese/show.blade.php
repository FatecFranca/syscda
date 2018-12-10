@extends('layouts.app')

@section('content')
    @include('components.header', ['urlAction' => route('dioceses.edit', ['id' => $diocese->id])])
    <div class="form-row">
        <div class="form-group col-md-6 ">
            <label for="name">{{ __('default/views.name') }} *</label>
            <input disabled required type="text" class="form-control" id="name" name="name"
                   value="{{ old('name', isset($diocese) ? $diocese['name'] : null) }}">
        </div>
        <div class="form-group col-md-6">
            <label for="opening_date">{{ __('validation.attributes.opening_date') }}</label>
            <input disabled type="date" class="form-control" id="opening_date" name="opening_date"
                   value="{{ old('opening_date', isset($diocese) ? $diocese['opening_date'] : null) }}">
        </div>
        <div class="form-group col-md-6 ">
            <label for="responsible">{{ __('validation.attributes.responsible') }} *</label>
            <input disabled required type="text" class="form-control" id="responsible" name="responsible"
                   value="{{ old('responsible', isset($diocese) ? $diocese['responsible'] : null) }}">
        </div>
        <div class="form-group col-md-6 ">
            <label for="telephone">{{ __('default/views.telephone') }} *</label>
            <input disabled required type="text" class="form-control" id="telephone" name="telephone"
                   value="{{ old('telephone', isset($diocese) ? $diocese['telephone'] : null) }}">
            @if(count($errors) && $errors->first('telephone'))
                <div class="badge badge-danger">
                    {{ $errors->first('telephone') }}
                </div>
            @endif
        </div>
        <div class="form-group col-md-6 ">
            <label for="cnpj">{{ __('default/views.cnpj') }}</label>
            <input disabled type="text" class="form-control" id="cnpj" name="cnpj"
                   value="{{ old('cnpj', isset($diocese) ? $diocese['cnpj'] : null) }}">
        </div>
        <div class="form-group col-md-6 ">
            <label for="email">{{ __('default/views.email') }}</label>
            <input disabled type="email" class="form-control" id="email" name="email"
                   value="{{ old('email', isset($diocese) ? $diocese['email'] : null) }}">
        </div>
        <div class="form-group col-md-6">
            <label for="rgi_id">{{ __('rgi/views.rgi') }} * {{ old('rgi_id') }}</label>
            <select disabled required class="custom-select" id="rgi_id" name="rgi_id"
                    value="{{ old('rgi_id') }}">
                <option selected disabled value="0">{{ __('default/views.selectOption') }}</option>
                @foreach($rgis as $rgi)
                    <option @if(isset($diocese) && $diocese['rgi_id'] == $rgi->id) selected="selected" @endif
                    value="{{ $rgi->id }}">{{ 'RGI: ' . $rgi->rgi_number . ' - '  . $rgi->address->street . ' - ' . 'Nº: ' . $rgi->number  }}</option>
                @endforeach

            </select>
        </div>
@endsection
