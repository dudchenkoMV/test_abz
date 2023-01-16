<div class="modal fade" id="position_delete_modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Remove position') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to remove position <span id="position_modal_name"></span></p>
                <div class="row d-flex justify-content-end mt-5">
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-block btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                    <div class="col-sm-4">
                        <form id="position_modal_delete" action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-block btn-secondary">Remove</button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>
