{{ Form::open(['route' => 'practice-tool-categories.store', 'method' => 'post']) }}
<div class="modal-body">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('name', __('Name'), ['class' => 'col-form-label']) }}
                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'required' => 'required']) }}
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" value="{{ __('Cancel') }}" class="btn btn-secondary btn-light" data-bs-dismiss="modal">
            <input type="submit" value="{{ __('Save') }}" class="btn btn-primary ms-2">
        </div>
    </div>
</div>
{{ Form::close() }}
