@extends('layouts.app')

@section('content')
        @include('components.header', ['urlAction' => route('chapels.edit', ['id' => $chapel->id])])
        <div class="form-row">
            <div class="form-group col-md-6 ">
                <label for="name">{{ __('validation.attributes.name') }} *</label>
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
                <label for="cnpj">{{ __('validation.attributes.cnpj') }}</label>
                <input disabled type="text" class="form-control" id="cnpj" name="cnpj"
                       value="{{ old('cnpj', isset($chapel) ? $chapel['cnpj'] : null) }}">
            </div>
            <div class="form-group col-md-6 ">
                <label for="email">{{ __('validation.attributes.email') }}</label>
                <input disabled type="email" class="form-control" id="email" name="email"
                       value="{{ old('email', isset($chapel) ? $chapel['email'] : null) }}">
            </div>
            <div class="form-group col-md-6 ">
                <label for="telephone">{{ __('validation.attributes.telephone') }} *</label>
                <input disabled required type="text" class="form-control" id="telephone" name="telephone"
                       value="{{ old('telephone', isset($chapel) ? $chapel['telephone'] : null) }}">
            </div>
            <div class="form-group col-md-6">
                <label for="address_id">{{ __('addresses/views.address') }} *</label>
                <select disabled required class="custom-select" id="address_id" name="address_id"
                        value="{{ old('address_id', isset($chapel) ? $chapel['address_id'] : null) }}">
                    <option selected disabled value="0">{{ __('default/views.selectOption') }}</option>
                    @foreach($addresses as $address)
                        <option @if(isset($chapel) && $chapel['address_id'] == $address->id) selected="selected" @endif
                        value="{{ $address->id }}">{{ $address->zipcode . ' - ' . $address->street . ' - ' . $address->neighborhood }}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="parish_id">{{ __('parishes/views.parish') }} *</label>
                <select disabled required class="custom-select" id="parish_id" name="parish_id"
                        value="{{ old('parish_id', isset($chapel) ? $chapel['parish_id'] : null) }}">
                    <option selected disabled value="0">{{ __('default/views.selectOption') }}</option>
                    @foreach($parishes as $parish)
                        <option @if(isset($chapel) && $chapel['forania_id'] == $parish->id) selected="selected" @endif
                        value="{{ $parish->id }}">{{ $parish->name }}</option>
                    @endforeach

                </select>
            </div>
        </div>
@endsection
