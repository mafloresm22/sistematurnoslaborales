<div class="modal fade" id="modalCreateSucursales" tabindex="-1" aria-labelledby="modalCreateSucursalesLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="modalCreateSucursalesLabel">Nueva Sucursal</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
         </div>
         <form action="{{ route('sucursales.store') }}" method="POST">
            @csrf
            <div class="modal-body">
               <div class="mb-3">
                  <label for="nombreSucursales" class="form-label">Nombre de Sucursal <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="nombreSucursales" name="nombreSucursales" required maxlength="150">
               </div>
               <div class="mb-3">
                  <label class="form-label">País</label>
                  <input type="text" class="form-control" value="Perú" disabled>
               </div>
               <div class="row">
                  <div class="col-md-4 mb-3">
                     <label for="selDepartamento" class="form-label">Departamento <span class="text-danger">*</span></label>
                     <select class="form-select" id="selDepartamento" required>
                        <option value="">Seleccione...</option>
                     </select>
                  </div>
                  <div class="col-md-4 mb-3">
                     <label for="selProvincia" class="form-label">Provincia <span class="text-danger">*</span></label>
                     <select class="form-select" id="selProvincia" required disabled>
                        <option value="">Seleccione...</option>
                     </select>
                  </div>
                  <div class="col-md-4 mb-3">
                     <label for="selDistrito" class="form-label">Distrito <span class="text-danger">*</span></label>
                     <select class="form-select" id="selDistrito" required disabled>
                        <option value="">Seleccione...</option>
                     </select>
                  </div>
               </div>
               <div class="mb-3">
                  <label for="direccionDetalle" class="form-label">Dirección <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="direccionDetalle" required maxlength="150" placeholder="Ej: Av. Principal 123">
               </div>
               <input type="hidden" id="direccionSucursales" name="direccionSucursales">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
               <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
         </form>
      </div>
    </div>
</div>
