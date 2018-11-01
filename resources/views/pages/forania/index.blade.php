@extends('layouts.app')

@section('content')
    @include('components.header', ['urlAction' => route('foranias.create')])
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">{{ __('default/views.id') }}</th>
                <th scope="col">{{ __('default/views.name') }}</th>
                <th scope="col">{{ __('validation.attributes.opening_date') }}</th>
                <th scope="col">{{ __('dioceses/views.diocese') }}</th>
                <th scope="col">{{ __('default/views.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($foranias as $forania)
                <tr>
                    <th scope="row">{{ $forania->id }}</th>
                    <td>{{ $forania->name }}</td>
                    <td>{{ $forania->opening_date ? date_format(new DateTime($forania->opening_date), 'd/m/Y') : null }}</td>
                    <td>{{ $forania->diocese->name }}</td>
                    <td>
                        <a href="{{ route('foranias.show', ['id' => $forania->id]) }}" style="color: white"
                           class="btn btn-secondary btn-sm">{{ __('default/actions.view') }}</a>
                        <a href="{{ route('foranias.edit', ['id' => $forania->id]) }}"
                           class="btn btn-warning btn-sm">{{ __('default/actions.edit') }}</a>
                        <button data-modal-delete data-target="#modalDeleteCenter"
                                data-url-destroy="{{ route('foranias.destroy', ['id' => $forania->id]) }}"
                                class="btn btn-danger btn-sm">{{ __('default/actions.destroy') }}</button>
                    </td>
                </tr>
            @empty
                <tr class="table-primary">
                    <td colspan="12" class="text-center font-weight-bold">
                        {{ __('foranias/views.no_results') }}
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ method_exists($foranias, 'links') ? $foranias->links() : '' }}
    </div>
@endsection
