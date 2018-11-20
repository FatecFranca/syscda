@extends('layouts.app')

@section('content')
    @include('components.header', ['urlAction' => route('people.create')])
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">{{ __('default/views.id') }}</th>
                <th scope="col">{{ __('default/views.name') }}</th>
                <th scope="col">{{ __('default/views.date_birthday') }}</th>
                <th scope="col">{{ __('default/views.telephone') }}</th>
                <th scope="col">{{ __('default/views.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($people as $person)
                <tr>
                    <td scope="row">{{ $person->id }}</td>
                    <td>{{ $person->name }}</td>
                    <td>{{ $person->date_birthday }}</td>
                    <td>{{ $person->telephone }}</td>
                    <td>
                        <a href="{{ route('people.show', ['id' => $person->id]) }}" style="color: white"
                           class="btn btn-secondary btn-sm">{{ __('default/actions.view') }}</a>
                        <a href="{{ route('people.edit', ['id' => $person->id]) }}"
                           class="btn btn-warning btn-sm">{{ __('default/actions.edit') }}</a>
                        <button data-modal-delete data-target="#modalDeleteCenter"
                                data-url-destroy="{{ route('people.destroy', ['id' => $person->id]) }}"
                                class="btn btn-danger btn-sm">{{ __('default/actions.destroy') }}</button>
                    </td>
                </tr>
            @empty
                <tr class="table-primary">
                    <td colspan="12" class="text-center font-weight-bold">
                        {{ __('people/views.no_results') }}
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ method_exists($people, 'links') ? $people->links() : '' }}
    </div>
@endsection
