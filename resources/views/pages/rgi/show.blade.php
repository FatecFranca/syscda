@extends('layouts.app')

@section('content')
    @include('components.header', ['urlAction' => route('rgi.edit', ['id' => $rgi->id])])
    <div class="form-row">
        <div class="form-group col-md-6 ">
            <label for="rgi_number">{{ __('rgi/views.rgi_number') }} *</label>
            <input disabled required type="number" class="form-control" id="rgi_number" name="rgi_number"
                   value="{{ $rgi->rgi_number }}">
        </div>
        <div class="form-group col-md-6">
            <label for="number">{{ __('rgi/views.house_number') }} *</label>
            <input disabled required min="1" type="number" class="form-control" id="number" name="number"
                   value="{{ $rgi->number }}">
        </div>
        <div class="form-group col-md-12">
            <label for="number">{{ __('rgi/views.rgi') }} *</label>
            <select disabled required class="custom-select" id="address_id" name="address_id"
                    value="{{ old('address_id') }}">
                <option selected disabled value="0">{{ __('default/views.selectOption') }}</option>
                @foreach($addresses as $address)
                    <option @if($rgi->address->id == $address->id) selected="selected"
                            @endif value="{{ $address->id }}">{{ $address->zipcode . ' - ' . $address->street . ' - ' . $address->neighborhood }}</option>
                @endforeach

            </select>
        </div>
    </div>
@endsection
