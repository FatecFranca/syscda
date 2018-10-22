@extends('layouts.app')

@section('content')
    <form class="form" method="POST" action="{{ route('rgi.store') }}">
        @csrf
        @include('components.header')
        <div class="form-row">
            <div class="form-group col-md-6 ">
                <label for="rgi_number">{{ __('rgi/views.rgi_number') }} *</label>
                <input required type="number" class="form-control" id="rgi_number" name="rgi_number"
                       value="{{ old('rgi_number', $rgi->rgi_number) }}">
                @if(count($errors) && $errors->first('rgi_number'))
                    <div class="badge badge-danger">
                        {{ $errors->first('rgi_number') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="number">{{ __('rgi/views.house_number') }} *</label>
                <input required min="1" type="number" class="form-control" id="number" name="number"
                       value="{{ old('number', $rgi->number) }}">
                @if(count($errors) && $errors->first('number'))
                    <div class="badge badge-danger">
                        {{ $errors->first('number') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-12">
                <label for="number">{{ __('rgi/views.rgi') }} *</label>
                <select required class="custom-select" id="address_id" name="address_id"
                        value="{{ old('address_id', $rgi->address_id) }}">
                    <option selected disabled value="0">{{ __('default/views.selectOption') }}</option>
                    @foreach($addresses as $address)
                        <option @if($rgi->address->id == $address->id) selected="selected"
                                @endif value="{{ $address->id }}">{{ $address->zipcode . ' - ' . $address->street . ' - ' . $address->neighborhood }}</option>
                    @endforeach

                </select>
                @if(count($errors) && $errors->first('address_id'))
                    <div class="badge badge-danger">
                        {{ $errors->first('address_id') }}
                    </div>
                @endif
            </div>
        </div>
    </form>
@endsection
