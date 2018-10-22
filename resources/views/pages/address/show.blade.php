@extends('layouts.app')

@section('content')
    @csrf
    @include('components.header', ['urlAction' => route('addresses.edit', ['id' => $address->id])])
    <div class="form-row">
        <div class="form-group col-md-6 ">
            <label for="zipcode">{{ __('validation.attributes.zipcode') }} *</label>
            <input disabled required type="text" class="form-control" id="zipcode" name="zipcode"
                   value="{{ $address->zipcode }}">
        </div>
        <div class="form-group col-md-6">
            <label for="street">{{ __('validation.attributes.street_id') }} *</label>
            <input disabled required type="text" class="form-control" id="street" name="street"
                   value="{{ $address->street }}">
        </div>
        <div class="form-group col-md-6">
            <label for="neighborhood">{{ __('validation.attributes.neighborhood') }} *</label>
            <input disabled required type="text" class="form-control" id="neighborhood" name="neighborhood"
                   value="{{ $address->neighborhood }}">
        </div>
        <div class="form-group col-md-6">
            <label for="city">{{ __('validation.attributes.city_id') }} *</label>
            <input disabled type="text" class="form-control" id="city" name="city" value="{{ $address->city }}">
        </div>
        <div class="form-group col-md-6">
            <label for="uf">{{ __('validation.attributes.uf') }} *</label>
            <input disabled required type="text" class="form-control" id="uf" name="uf" value="{{ $address->uf }}">
        </div>
        <div class="form-group col-md-6">
            <label for="complement">{{ __('validation.attributes.complement') }}</label>
            <input disabled type="text" class="form-control" id="complement" name="complement"
                   value="{{ $address->complement }}">
        </div>
    </div>
@endsection
