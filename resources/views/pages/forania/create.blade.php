@extends('layouts.app')

@section('content')
    <form class="form" method="POST" action="{{ route('foranias.store') }}">
        @csrf
        @include('components.header')
        <div class="form-row">
            <div class="form-group col-md-6 ">
                <label for="name">{{ __('validation.attributes.name') }} *</label>
                <input max="255" required type="text" class="form-control" id="name" name="name"
                       value="{{ old('name') }}">
                @if(count($errors) && $errors->first('name'))
                    <div class="badge badge-danger">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="opening_date">{{ __('validation.attributes.opening_date') }}</label>
                <input type="date" class="form-control" id="opening_date" name="opening_date"
                       value="{{ old('opening_date')}}">
                @if(count($errors) && $errors->first('opening_date'))
                    <div class="badge badge-danger">
                        {{ $errors->first('opening_date') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="number">{{ __('dioceses/views.diocese') }} *</label>
                <select required class="custom-select" id="diocese_id" name="diocese_id"
                        value="{{ old('diocese_id') }}">
                    <option selected disabled value="0">{{ __('default/views.selectOption') }}</option>
                    @foreach($dioceses as $diocese)
                        <option value="{{ $diocese->id }}">{{ $diocese->name }}</option>
                    @endforeach

                </select>
                @if(count($errors) && $errors->first('diocese_id'))
                    <div class="badge badge-danger">
                        {{ $errors->first('diocese_id') }}
                    </div>
                @endif
            </div>
        </div>
    </form>
@endsection
