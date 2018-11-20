@extends('layouts.app')

@section('content')
    @include('components.header', ['urlAction' => route('type_people.edit', ['id' => $type_person->id])])
    <div class="form-row">
        <div class="form-group col-md-6 ">
            <label for="description">{{ __('default/views.description') }} *</label>
            <input disabled required type="text" class="form-control" id="description" name="description"
                   value="{{ old('description', $type_person->description) }}">
        </div>
    </div>
@endsection
