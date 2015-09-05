
<div class="modal fade" id="delete-modal" role="dialog" aria-describedby="delete-modal-title">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="delete-modal-title">{{ Lang::get('content::messages.delete_category') }}</h4>
            </div>
            <div class="modal-body">
                <p>{{ Lang::get('content::messages.delete_category_confirm') }} {{ Lang::get('content::messages.change_warning') }}</p>
            </div>
            <div class="modal-footer">
                {{ csrf_field() }}
                <input type="hidden" class="category">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ Lang::get('content::messages.cancel') }}</button>
                <button type="button" class="btn btn-primary delete-button">{{ Lang::get('content::messages.delete') }}</button>
            </div>
        </div>
    </div>
</div>
