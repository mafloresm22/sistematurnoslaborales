{{ Form::open(['url' => '#','method' => 'post']) }}
    <div class="form-group">
        <label class="form-label">Nombre del Rol</label>
        {{ Form::text('title', old('title'), ['class' => 'form-control','id' => 'role-title', 'required']) }}
    </div>
    <div class="d-flex justify-content-end mt-2">
        <button type="button" class="btn btn-danger mx-1" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary mx-1" data-bs-dismiss="modal">Guardar</button>
    </div>
{{ Form::close() }}