@extends('layouts.app')

@section('content')
    @include('components.header', ['urlAction' => route('dioceses.create')])
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">{{ __('default/views.id') }}</th>
                <th scope="col">{{ __('default/views.name') }}</th>
                <th scope="col">{{ __('validation.attributes.opening_date') }}</th>
                {{--<th scope="col">{{ __('validation.attributes.zipcode') }}</th>--}}
                <th scope="col">{{ __('default/views.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($dioceses as $diocese)
                <tr>
                    <th scope="row">{{ $diocese->id }}</th>
                    <td>{{ $diocese->name }}</td>
                    <td>{{ $diocese->opening_date ? date_format(new DateTime($diocese->opening_date), 'd/m/Y') : null }}</td>
{{--                    <td>{{ $diocese->address->zipcode }}</td>--}}
                    <td>
                        <a href="{{ route('dioceses.show', ['id' => $diocese->id]) }}" style="color: white"
                           class="btn btn-secondary btn-sm">{{ __('default/actions.view') }}</a>
                        <a href="{{ route('dioceses.edit', ['id' => $diocese->id]) }}"
                           class="btn btn-warning btn-sm">{{ __('default/actions.edit') }}</a>
                        <button data-modal-delete data-target="#modalDeleteCenter"
                                data-url-destroy="{{ route('dioceses.destroy', ['id' => $diocese->id]) }}"
                                class="btn btn-danger btn-sm">{{ __('default/actions.destroy') }}</button>
                    </td>
                </tr>
            @empty
                <tr class="table-primary">
                    <td colspan="12" class="text-center font-weight-bold">
                        {{ __('dioceses/views.no_results') }}
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ method_exists($dioceses, 'links') ? $dioceses->links() : '' }}
    </div>
@endsection
