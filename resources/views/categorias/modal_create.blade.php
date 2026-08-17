<div class="modal fade" id="modalCreateCategoria" tabindex="-1" aria-labelledby="modalCreateCategoriaLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header bg-primary">
            <h5 class="modal-title" id="modalCreateCategoriaLabel" style="color: #ffffff">Nueva Categoría</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
         </div>
         <form action="{{ route('categorias.store') }}" method="POST">
            @csrf
            <div class="modal-body">
               <div class="mb-3">
                  <label for="nombreCategorias" class="form-label">Nombre de Categoría <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="nombreCategorias" name="nombreCategorias" required maxlength="150">
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
               <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
         </form>
      </div>
    </div>
</div>
