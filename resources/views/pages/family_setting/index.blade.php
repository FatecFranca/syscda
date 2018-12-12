@extends('layouts.app')

@section('content')
    @include('components.header', ['urlAction' => route('family_settings.create')])
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">{{ __('default/views.id') }}</th>
                <th scope="col">{{ __('default/views.type_housing') }}</th>
                <th scope="col">{{ __('addresses/views.address') }}</th>
                <th scope="col">{{ __('default/views.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($family_settings as $family_setting)
                <tr>
                    <th scope="row">{{ $family_setting->id }}</th>
                    <td>{{ $family_setting->type_housing }}</td>
                    <td>{{ 'RGI: ' . $family_setting->rgi . $family_setting->rgi->address->street . 'Nº: ' . $family_setting->rgi->number }}</td>
                    <td>
                        <a href="{{ route('family_settings.show', ['id' => $family_setting->id]) }}" style="color: white"
                           class="btn btn-secondary btn-sm">{{ __('default/actions.view') }}</a>
                        <a href="{{ route('family_settings.edit', ['id' => $family_setting->id]) }}"
                           class="btn btn-warning btn-sm">{{ __('default/actions.edit') }}</a>
                        <button data-modal-delete data-target="#modalDeleteCenter"
                                data-url-destroy="{{ route('family_settings.destroy', ['id' => $family_setting->id]) }}"
                                class="btn btn-danger btn-sm">{{ __('default/actions.destroy') }}</button>
                    </td>
                </tr>
            @empty
                <tr class="table-primary">
                    <td colspan="12" class="text-center font-weight-bold">
                        {{ __('family_settings/views.no_results') }}
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ method_exists($family_settings, 'links') ? $family_settings->links() : '' }}
    </div>
@endsection
