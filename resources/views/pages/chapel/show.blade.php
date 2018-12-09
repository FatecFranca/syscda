@extends('layouts.app')

@section('content')
        @include('components.header', ['urlAction' => route('chapels.edit', ['id' => $chapel->id])])
        <div class="form-row">
            <div class="form-group col-md-6 ">
                <label for="name">{{ __('default/views.name') }} *</label>
                <input disabled max="255" required type="text" class="form-control" id="name" name="name"
                       value="{{ old('name', isset($chapel) ? $chapel['name'] : null) }}">
            </div>
            <div class="form-group col-md-6">
                <label for="opening_date">{{ __('validation.attributes.opening_date') }}</label>
                <input disabled type="date" class="form-control" id="opening_date" name="opening_date"
                       value="{{ old('opening_date', isset($chapel) ? $chapel['opening_date'] : null) }}">
            </div>
            <div class="form-group col-md-6 ">
                <label for="responsible">{{ __('validation.attributes.responsible') }} *</label>
                <input disabled required type="text" class="form-control" id="responsible" name="responsible"
                       value="{{ old('responsible', isset($chapel) ? $chapel['responsible'] : null) }}">
            </div>
            <div class="form-group col-md-6 ">
                <label for="cnpj">{{ __('default/views.cnpj') }}</label>
                <input disabled type="text" class="form-control" id="cnpj" name="cnpj"
                       value="{{ old('cnpj', isset($chapel) ? $chapel['cnpj'] : null) }}">
            </div>
            <div class="form-group col-md-6 ">
                <label for="email">{{ __('default/views.email') }}</label>
                <input disabled type="email" class="form-control" id="email" name="email"
                       value="{{ old('email', isset($chapel) ? $chapel['email'] : null) }}">
            </div>
            <div class="form-group col-md-6 ">
                <label for="telephone">{{ __('default/views.telephone') }} *</label>
                <input disabled required type="text" class="form-control" id="telephone" name="telephone"
                       value="{{ old('telephone', isset($chapel) ? $chapel['telephone'] : null) }}">
            </div>
            <div class="form-group col-md-6">
                <label for="rgi_id">{{ __('rgi/views.rgi') }} * {{ old('rgi_id') }}</label>
                <select disabled required class="custom-select" id="rgi_id" name="rgi_id"
                        value="{{ old('rgi_id') }}">
                    <option selected disabled value="0">{{ __('default/views.selectOption') }}</option>
                    @foreach($rgis as $rgi)
                        <option @if(isset($chapel) && $chapel['rgi_id'] == $rgi->id) selected="selected" @endif
                        value="{{ $rgi->id }}">{{ 'RGI: ' . $rgi->rgi_number . ' - '  . $rgi->address->street . ' - ' . 'Nº: ' . $rgi->number  }}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="parish_id">{{ __('parishes/views.parish') }} *</label>
                <select disabled required class="custom-select" id="parish_id" name="parish_id"
                        value="{{ old('parish_id', isset($chapel) ? $chapel['parish_id'] : null) }}">
                    <option selected disabled value="0">{{ __('default/views.selectOption') }}</option>
                    @foreach($parishes as $parish)
                        <option @if(isset($chapel) && $chapel['parish_id'] == $parish->id) selected="selected" @endif
                        value="{{ $parish->id }}">{{ $parish->name }}</option>
                    @endforeach

                </select>
            </div>
        </div>
@endsection
