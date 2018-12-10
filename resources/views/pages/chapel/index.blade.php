@extends('layouts.app')

@section('content')
    @include('components.header', ['urlAction' => route('chapels.create')])
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">{{ __('default/views.id') }}</th>
                <th scope="col">{{ __('default/views.name') }}</th>
{{--                <th scope="col">{{ __('validation.attributes.zipcode') }}</th>--}}
                <th scope="col">{{ __('parishes/views.parish') }}</th>
                <th scope="col">{{ __('validation.attributes.opening_date') }}</th>
                <th scope="col">{{ __('default/views.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($chapels as $chapel)
                <tr>
                    <th scope="row">{{ $chapel->id }}</th>
                    <td>{{ $chapel->name }}</td>
                    {{--<td>{{ $chapel->address->zipcode }}</td>--}}
                    <td>{{ $chapel->parish->name }}</td>
                    <td>{{ $chapel->opening_date ? date_format(new DateTime($chapel->opening_date), 'd/m/Y') : null }}</td>
                    <td>
                        <a href="{{ route('chapels.show', ['id' => $chapel->id]) }}" style="color: white"
                           class="btn btn-secondary btn-sm">{{ __('default/actions.view') }}</a>
                        <a href="{{ route('chapels.edit', ['id' => $chapel->id]) }}"
                           class="btn btn-warning btn-sm">{{ __('default/actions.edit') }}</a>
                        <button data-modal-delete data-target="#modalDeleteCenter"
                                data-url-destroy="{{ route('chapels.destroy', ['id' => $chapel->id]) }}"
                                class="btn btn-danger btn-sm">{{ __('default/actions.destroy') }}</button>
                    </td>
                </tr>
            @empty
                <tr class="table-primary">
                    <td colspan="12" class="text-center font-weight-bold">
                        {{ __('chapels/views.no_results') }}
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ method_exists($chapels, 'links') ? $chapels->links() : '' }}
    </div>
@endsection
