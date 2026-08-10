<div class="modal fade" id="modalEditCategoria" tabindex="-1" aria-labelledby="modalEditCategoriaLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="modalEditCategoriaLabel">Editar Categoría</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
         </div>
         <form id="formEditCategoria" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="modal-body">
               <div class="mb-3">
                  <label for="edit_nombreCategorias" class="form-label">Nombre de Categoría <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="edit_nombreCategorias" name="nombreCategorias"
                     placeholder="Ej. Turno Mañana" required maxlength="150">
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
               <button type="submit" class="btn btn-warning">Actualizar</button>
            </div>
         </form>
      </div>
   </div>
</div>
