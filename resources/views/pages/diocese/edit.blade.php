@extends('layouts.app')

@section('content')
    <form class="form" method="POST" action="{{ route('dioceses.update', ['id' => $diocese->id]) }}">
        @method('PUT')
        @csrf
        @include('components.header')
        <div class="form-row">
            <div class="form-group col-md-6 ">
                <label for="name">{{ __('default/views.name') }} *</label>
                <input required type="text" class="form-control" id="name" name="name"
                       value="{{ old('name', isset($diocese) ? $diocese['name'] : null) }}">
                @if(count($errors) && $errors->first('name'))
                    <div class="badge badge-danger">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="opening_date">{{ __('validation.attributes.opening_date') }}</label>
                <input type="date" class="form-control" id="opening_date" name="opening_date"
                       value="{{ old('opening_date', isset($diocese) ? $diocese['opening_date'] : null) }}">
                @if(count($errors) && $errors->first('opening_date'))
                    <div class="badge badge-danger">
                        {{ $errors->first('opening_date') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6 ">
                <label for="responsible">{{ __('validation.attributes.responsible') }} *</label>
                <input required type="text" class="form-control" id="responsible" name="responsible"
                       value="{{ old('responsible', isset($diocese) ? $diocese['responsible'] : null) }}">
                @if(count($errors) && $errors->first('responsible'))
                    <div class="badge badge-danger">
                        {{ $errors->first('responsible') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6 ">
                <label for="telephone">{{ __('default/views.telephone') }} *</label>
                <input required type="text" class="form-control" id="telephone" name="telephone"
                       value="{{ old('telephone', isset($diocese) ? $diocese['telephone'] : null) }}">
                @if(count($errors) && $errors->first('telephone'))
                    <div class="badge badge-danger">
                        {{ $errors->first('telephone') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6 ">
                <label for="cnpj">{{ __('default/views.cnpj') }}</label>
                <input type="text" class="form-control" id="cnpj" name="cnpj"
                       value="{{ old('cnpj', isset($diocese) ? $diocese['cnpj'] : null) }}">
                @if(count($errors) && $errors->first('cnpj'))
                    <div class="badge badge-danger">
                        {{ $errors->first('cnpj') }}
                    </div>
                @endif
                @if(session('message'))
                    <div class="badge badge-danger">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6 ">
                <label for="email">{{ __('default/views.email') }}</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="{{ old('email', isset($diocese) ? $diocese['email'] : null) }}">
                @if(count($errors) && $errors->first('email'))
                    <div class="badge badge-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="rgi_id">{{ __('rgi/views.rgi') }} *</label>
                <select required class="custom-select" id="rgi_id" name="rgi_id"
                        value="{{ old('rgi_id') }}">
                    <option selected disabled value="0">{{ __('default/views.selectOption') }}</option>
                    @foreach($rgis as $rgi)
                        <option @if(isset($diocese) && $diocese['rgi_id'] == $rgi->id) selected="selected" @endif
                        value="{{ $rgi->id }}">{{ 'RGI: ' . $rgi->rgi_number . ' - '  . $rgi->address->street . ' - ' . 'Nº: ' . $rgi->number  }}</option>
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
