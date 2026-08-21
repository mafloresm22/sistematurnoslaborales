<div class="offcanvas offcanvas-end shadow-lg" tabindex="-1" id="offcanvasEditAusencia" aria-labelledby="offcanvasEditAusenciaLabel" style="width: 500px;">
    <div class="offcanvas-header bg-warning py-3">
        <h5 class="offcanvas-title fw-bold text-white" id="offcanvasEditAusenciaLabel">
            <i class="bi bi-pencil-square me-2"></i>Editar Ausencia
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body p-4">
        <!-- El action se puede actualizar dinámicamente mediante JavaScript o con la ruta base de edición -->
        <form action="" method="POST" enctype="multipart/form-data" id="formEditAusencia">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="empleadoid_edit" class="form-label fw-semibold text-secondary">
                    <i class="bi bi-person me-1"></i>Empleado <span class="text-danger">*</span>
                </label>
                <select class="form-select @error('empleadoid') is-invalid @enderror" id="empleadoid_edit" name="empleadoid" required>
                    <option value="" disabled>Selecciona un empleado...</option>
                    @foreach($listaEmpleados ?? [] as $empleado)
                        <option value="{{ $empleado->idEmpleados }}">
                            {{ $empleado->nombreEmpleados }} {{ $empleado->apellidoEmpleados }}
                        </option>
                    @endforeach
                </select>
                @error('empleadoid')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tipoAusencias_edit" class="form-label fw-semibold text-secondary">
                    <i class="bi bi-tag me-1"></i>Tipo de Ausencia <span class="text-danger">*</span>
                </label>
                <select name="tipoAusencias" id="tipoAusencias_edit" class="form-select @error('tipoAusencias') is-invalid @enderror" required>
                    <option value="" disabled>Seleccione un tipo de ausencia...</option>
                    <option value="Vacaciones">Vacaciones</option>
                    <option value="Enfermedad">Enfermedad</option>
                    <option value="Licencia de maternidad/paternidad">Licencia de maternidad/paternidad</option>
                    <option value="Licencia no remunerada">Licencia no remunerada</option>
                    <option value="Día libre">Día libre</option>
                    <option value="Otro">Otro</option>
                </select>
                @error('tipoAusencias')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="fechaInicio_edit" class="form-label fw-semibold text-secondary">
                        <i class="bi bi-calendar-event me-1"></i>Fecha de Inicio <span class="text-danger">*</span>
                    </label>
                    <input type="date" class="form-control @error('fechaInicio') is-invalid @enderror" 
                           id="fechaInicio_edit" name="fechaInicio" required>
                    @error('fechaInicio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="fechaFin_edit" class="form-label fw-semibold text-secondary">
                        <i class="bi bi-calendar-check me-1"></i>Fecha de Fin <span class="text-danger">*</span>
                    </label>
                    <input type="date" class="form-control @error('fechaFin') is-invalid @enderror" 
                           id="fechaFin_edit" name="fechaFin" required>
                    @error('fechaFin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="observacionesAusencias_edit" class="form-label fw-semibold text-secondary">
                    <i class="bi bi-chat-left-text me-1"></i>Observaciones
                </label>
                <textarea class="form-control @error('observacionesAusencias') is-invalid @enderror" 
                          id="observacionesAusencias_edit" name="observacionesAusencias"></textarea>
                @error('observacionesAusencias')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="documentoAdjuntoAusencias_edit" class="form-label fw-semibold text-secondary">
                    <i class="bi bi-file-earmark-arrow-up me-1"></i>Documento Adjunto (Justificación)
                </label>
                
                <div id="documentoActualContenedor" class="mb-2 d-none">
                    <span class="text-muted small">Documento actual:</span>
                    <a href="#" id="documentoActualLink" target="_blank" class="btn btn-sm btn-outline-primary ms-2 py-0 px-2">
                        <i class="bi bi-eye"></i> Ver
                    </a>
                </div>

                <input type="file" class="form-control @error('documentoAdjuntoAusencias') is-invalid @enderror" 
                       id="documentoAdjuntoAusencias_edit" name="documentoAdjuntoAusencias" accept=".pdf,.jpg,.jpeg,.png">
                <div class="form-text text-muted small">Formatos permitidos: PDF, JPG, PNG. Déjalo en blanco si no deseas cambiarlo.</div>
                @error('documentoAdjuntoAusencias')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end gap-2 border-top pt-3">
                <button type="button" class="btn btn-danger px-4" data-bs-dismiss="offcanvas">
                    <i class="bi bi-x-lg me-1"></i>Cancelar
                </button>
                <button type="submit" class="btn btn-warning px-4">
                    <i class="bi bi-save me-1"></i>Actualizar Ausencia
                </button>
            </div>
        </form>
    </div>
</div>