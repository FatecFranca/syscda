@extends('layouts.app')

@section('content')
    @include('components.header', ['urlAction' => route('foranias.edit', ['id' => $forania->id])])
    <div class="form-row">
        <div class="form-group col-md-6 ">
            <label for="name">{{ __('validation.attributes.name') }} *</label>
            <input disabled max="255" required type="text" class="form-control" id="name" name="name"
                   value="{{ old('name', $forania->name) }}">
        </div>
        <div class="form-group col-md-6">
            <label for="opening_date">{{ __('validation.attributes.opening_date') }}</label>
            <input disabled type="date" class="form-control" id="opening_date" name="opening_date"
                   value="{{ old('opening_date', $forania->opening_date)}}">
        </div>
        <div class="form-group col-md-6">
            <label for="number">{{ __('dioceses/views.diocese') }} *</label>
            <select disabled required class="custom-select" id="diocese_id" name="diocese_id"
                    value="{{ old('diocese_id', $forania->diocese_id) }}">
                <option selected disabled value="0">{{ __('default/views.selectOption') }}</option>
                @foreach($dioceses as $diocese)
                    <option @if($diocese->id == $forania->diocese_id) selected="selected" @endif value="{{ $diocese->id }}">{{ $diocese->name }}</option>
                @endforeach

            </select>
        </div>
    </div>
@endsection
