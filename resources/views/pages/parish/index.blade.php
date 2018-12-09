@extends('layouts.app')

@section('content')
    @include('components.header', ['urlAction' => route('parishes.create')])
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">{{ __('default/views.id') }}</th>
                <th scope="col">{{ __('default/views.name') }}</th>
                {{--<th scope="col">{{ __('validation.attributes.zipcode') }}</th>--}}
                <th scope="col">{{ __('foranias/views.forania') }}</th>
                <th scope="col">{{ __('validation.attributes.opening_date') }}</th>
                <th scope="col">{{ __('default/views.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($parishes as $parish)
                <tr>
                    <th scope="row">{{ $parish->id }}</th>
                    <td>{{ $parish->name }}</td>
                    {{--<td>{{ $parish->address->zipcode }}</td>--}}
                    <td>{{ $parish->forania->name }}</td>
                    <td>{{ $parish->opening_date ? date_format(new DateTime($parish->opening_date), 'd/m/Y') : null }}</td>
                    <td>
                        <a href="{{ route('parishes.show', ['id' => $parish->id]) }}" style="color: white"
                           class="btn btn-secondary btn-sm">{{ __('default/actions.view') }}</a>
                        <a href="{{ route('parishes.edit', ['id' => $parish->id]) }}"
                           class="btn btn-warning btn-sm">{{ __('default/actions.edit') }}</a>
                        <button data-modal-delete data-target="#modalDeleteCenter"
                                data-url-destroy="{{ route('parishes.destroy', ['id' => $parish->id]) }}"
                                class="btn btn-danger btn-sm">{{ __('default/actions.destroy') }}</button>
                    </td>
                </tr>
            @empty
                <tr class="table-primary">
                    <td colspan="12" class="text-center font-weight-bold">
                        {{ __('parishes/views.no_results') }}
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ method_exists($parishes, 'links') ? $parishes->links() : '' }}
    </div>
@endsection
