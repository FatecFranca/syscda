<div class="modal fade" id="modalDeleteCenter" tabindex="-1" role="dialog" aria-labelledby="modalDeleteCenterTitle" aria-hidden="true">
    <input type="hidden" id="urlDestroyModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteCenterTitle">Deseja remover este registro?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('default/actions.close') }}</button>
                <button id="modalBtnDestroy" type="button" class="btn btn-danger">{{ __('default/actions.destroy') }}</button>
            </div>
        </div>
    </div>
</div>