<div class="modal fade" id="modalEliminarEmpleados" tabindex="-1" aria-labelledby="modalEliminarEmpleadosLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarEmpleadosLabel">Cambiar Estado del Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEliminarEmpleados" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Cambiar estado para el empleado: <strong id="eliminar_nombreEmpleado"></strong></p>
                    
                    <div class="form-group">
                        <label class="form-label" for="estadoEmpleados">Nuevo Estado:</label>
                        <select class="form-select" name="estadoEmpleados" id="select_estadoEmpleados" required>
                            <!-- Las opciones se generarán mediante JavaScript dependiendo del estado actual -->
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
