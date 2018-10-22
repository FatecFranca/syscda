@extends('layouts.app')

@section('content')
    @include('components.header', ['urlAction' => route('addresses.create')])
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">{{ __('default/views.id') }}</th>
                <th scope="col">{{__('validation.attributes.zipcode') }}</th>
                <th scope="col">{{ __('validation.attributes.street_id') }}</th>
                <th scope="col">{{ __('validation.attributes.neighborhood') }}</th>
                <th scope="col">{{ __('default/views.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($addresses as $address)
                <tr>
                    <th scope="row">{{ $address->id }}</th>
                    <td>{{ $address->zipcode }}</td>
                    <td>{{ $address->street }}</td>
                    <td>{{ $address->neighborhood }}</td>
                    <td>
                        <a href="{{ route('addresses.show', ['id' => $address->id]) }}" style="color: white" class="btn btn-secondary btn-sm">{{ __('default/actions.view') }}</a>
                        <a href="{{ route('addresses.edit', ['id' => $address->id]) }}" class="btn btn-warning btn-sm">{{ __('default/actions.edit') }}</a>
                        <button data-modal-delete data-target="#modalDeleteCenter"
                                data-url-destroy="{{ route('addresses.destroy', ['id' => $address->id]) }}"
                                class="btn btn-danger btn-sm">{{ __('default/actions.destroy') }}</button>
                    </td>
                </tr>
            @empty
                <tr class="table-primary">
                    <td colspan="12" class="text-center font-weight-bold">
                        {{ __('rgi/views.no_results') }}
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ method_exists($addresses, 'links') ? $addresses->links() : '' }}
    </div>
@endsection
