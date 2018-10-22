@extends('layouts.app')

@section('content')
    <form class="form" method="POST" action="{{ route('addresses.store') }}">
        @csrf
        @include('components.header')
        <div class="form-row">
            <div class="form-group col-md-6 ">
                <label for="zipcode">{{ __('validation.attributes.zipcode') }} *</label>
                <input required type="text" class="form-control" id="zipcode" name="zipcode" value="{{ old('zipcode') }}">
                @if(count($errors) && $errors->first('cep'))
                    <div class="badge badge-danger">
                        {{ $errors->first('zipcode') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="street">{{ __('validation.attributes.street_id') }} *</label>
                <input required type="text" class="form-control" id="street" name="street" value="{{ old('street') }}">
                @if(count($errors) && $errors->first('street'))
                    <div class="badge badge-danger">
                        {{ $errors->first('street') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="neighborhood">{{ __('validation.attributes.neighborhood') }} *</label>
                <input required type="text" class="form-control" id="neighborhood" name="neighborhood" value="{{ old('neighborhood') }}">
                @if(count($errors) && $errors->first('neighborhood'))
                    <div class="badge badge-danger">
                        {{ $errors->first('neighborhood') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="city">{{ __('validation.attributes.city_id') }} *</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}">
                @if(count($errors) && $errors->first('city'))
                    <div class="badge badge-danger">
                        {{ $errors->first('city') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="uf">{{ __('validation.attributes.uf') }} *</label>
                <input required type="text" class="form-control" id="uf" name="uf" value="{{ old('uf') }}">
                @if(count($errors) && $errors->first('uf'))
                    <div class="badge badge-danger">
                        {{ $errors->first('uf') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="complement">{{ __('validation.attributes.complement') }}</label>
                <input type="text" class="form-control" id="complement" name="complement" value="{{ old('complement') }}">
                @if(count($errors) && $errors->first('complement'))
                    <div class="badge badge-danger">
                        {{ $errors->first('complement') }}
                    </div>
                @endif
            </div>
        </div>
    </form>
@endsection
