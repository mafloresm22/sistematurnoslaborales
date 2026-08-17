<div class="modal fade" id="modalEditSucursales" tabindex="-1" aria-labelledby="modalEditSucursalesLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header bg-warning">
            <h5 class="modal-title" id="modalEditSucursalesLabel" style="color: #ffffff">Editar Sucursal</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
         </div>
         <form id="formEditSucursales" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
               <div class="mb-3">
                  <label for="edit_nombreSucursales" class="form-label">Nombre de Sucursal <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="edit_nombreSucursales" name="nombreSucursales" required maxlength="150">
               </div>
               <div class="mb-3">
                  <label class="form-label">País</label>
                  <input type="text" class="form-control" value="Perú" disabled>
               </div>
               <div class="row">
                  <div class="col-md-4 mb-3">
                     <label for="edit_selDepartamento" class="form-label">Departamento <span class="text-danger">*</span></label>
                     <select class="form-select" id="edit_selDepartamento" required>
                        <option value="">Seleccione...</option>
                     </select>
                  </div>
                  <div class="col-md-4 mb-3">
                     <label for="edit_selProvincia" class="form-label">Provincia <span class="text-danger">*</span></label>
                     <select class="form-select" id="edit_selProvincia" required disabled>
                        <option value="">Seleccione...</option>
                     </select>
                  </div>
                  <div class="col-md-4 mb-3">
                     <label for="edit_selDistrito" class="form-label">Distrito <span class="text-danger">*</span></label>
                     <select class="form-select" id="edit_selDistrito" required disabled>
                        <option value="">Seleccione...</option>
                     </select>
                  </div>
               </div>
               <div class="mb-3">
                  <label for="edit_direccionDetalle" class="form-label">Dirección <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="edit_direccionDetalle" required maxlength="150" placeholder="Ej: Av. Principal 123">
               </div>
               <input type="hidden" id="edit_direccionSucursales" name="direccionSucursales">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
               <button type="submit" class="btn btn-warning">Actualizar</button>
            </div>
         </form>
      </div>
    </div>
</div>
