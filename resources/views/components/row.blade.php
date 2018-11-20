<tr>
    @foreach($fields as $field)
        <td>{{ $object->$field }}</td>
    @endforeach
    <td>
        <button data-modal-delete
                data-target="#modalDeleteCenter"
                data-url-destroy="{{ $urlDestroy }}"
                class="btn btn-danger">{{ __('default/actions.destroy') }}</button>
    </td>
</tr>