@extends('layouts.app')

@section('content')
    @include('components.header', ['urlAction' => route('rgi.create')])
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">{{ __('default/views.id') }}</th>
                <th scope="col">{{ __('rgi/views.rgi_short') }}</th>
                <th scope="col">{{ __('rgi/views.house_number') }}</th>
                <th scope="col">{{ __('addresses/views.zipcode') }}</th>
                <th scope="col">{{ __('default/views.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($rgis as $rgi)
                <tr>
                    <th scope="row">{{ $rgi->id }}</th>
                    <td>{{ $rgi->rgi_number }}</td>
                    <td>{{ $rgi->number }}</td>
                    <td>{{ $rgi->address->zipcode }}</td>
                    <td>
                        <a href="{{ route('rgi.show', ['id' => $rgi->id]) }}" style="color: white"
                           class="btn btn-secondary btn-sm">{{ __('default/actions.view') }}</a>
                        <a href="{{ route('rgi.edit', ['id' => $rgi->id]) }}"
                           class="btn btn-warning btn-sm">{{ __('default/actions.edit') }}</a>
                        <button data-modal-delete data-target="#modalDeleteCenter"
                                data-url-destroy="{{ route('rgi.destroy', ['id' => $rgi->id]) }}"
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
        {{ method_exists($rgis, 'links') ? $rgis->links() : '' }}
    </div>
@endsection
