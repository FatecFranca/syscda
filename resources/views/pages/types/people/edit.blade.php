@extends('layouts.app')

@section('content')
    <form class="form" method="POST" action="{{ route('type_people.update', ['id' => $type_person->id]) }}">
        @method('PUT')
        @csrf
        @include('components.header')
        <div class="form-row">
            <div class="form-group col-md-6 ">
                <label for="description">{{ __('default/views.description') }} *</label>
                <input required type="text" class="form-control" id="description" name="description"
                       value="{{ old('description', $type_person->description) }}">
                @if(count($errors) && $errors->first('description'))
                    <div class="badge badge-danger">
                        {{ $errors->first('description') }}
                    </div>
                @endif
            </div>
        </div>
    </form>
@endsection
