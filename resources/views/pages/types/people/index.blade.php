@extends('layouts.app')

@section('content')
    @include('components.header', ['urlAction' => route('type_people.create')])
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">{{ __('default/views.id') }}</th>
                <th scope="col">{{ __('default/views.description') }}</th>
                <th scope="col">{{ __('default/views.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($type_people as $type_person)
                <tr>
                    <th scope="row">{{ $type_person->id }}</th>
                    <td>{{ $type_person->description }}</td>
                    <td>
                        <a href="{{ route('type_people.show', ['id' => $type_person->id]) }}" style="color: white"
                           class="btn btn-secondary btn-sm">{{ __('default/actions.view') }}</a>
                        <a href="{{ route('type_people.edit', ['id' => $type_person->id]) }}"
                           class="btn btn-warning btn-sm">{{ __('default/actions.edit') }}</a>
                        <button data-modal-delete data-target="#modalDeleteCenter"
                                data-url-destroy="{{ route('type_people.destroy', ['id' => $type_person->id]) }}"
                                class="btn btn-danger btn-sm">{{ __('default/actions.destroy') }}</button>
                    </td>
                </tr>
            @empty
                <tr class="table-primary">
                    <td colspan="12" class="text-center font-weight-bold">
                        {{ __('types/people/views.no_results') }}
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ method_exists($type_people, 'links') ? $type_people->links() : '' }}
    </div>
@endsection
