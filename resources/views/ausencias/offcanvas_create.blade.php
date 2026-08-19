<div class="offcanvas offcanvas-end shadow-lg" tabindex="-1" id="offcanvasCreateAusencia" aria-labelledby="offcanvasCreateAusenciaLabel" style="width: 500px;">
    <div class="offcanvas-header bg-primary py-3">
        <h5 class="offcanvas-title fw-bold text-white" id="offcanvasCreateAusenciaLabel">
            <i class="bi bi-calendar-plus me-2"></i>Nueva Ausencia
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body p-4">
        <form action="{{ route('ausencias.store') }}" method="POST" enctype="multipart/form-data" id="formCreateAusencia">
            @csrf

            <div class="mb-3">
                <label for="empleadoid" class="form-label fw-semibold text-secondary">
                    <i class="bi bi-person me-1"></i>Empleado <span class="text-danger">*</span>
                </label>
                <select class="form-select @error('empleadoid') is-invalid @enderror" id="empleadoid" name="empleadoid" required>
                    <option value="" selected disabled>Selecciona un empleado...</option>
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
                <label for="tipoAusencias" class="form-label fw-semibold text-secondary">
                    <i class="bi bi-tag me-1"></i>Tipo de Ausencia <span class="text-danger">*</span>
                </label>
                <select name="tipoAusencias" id="tipoAusencias" class="form-select @error('tipoAusencias') is-invalid @enderror" required>
                    <option value="" selected disabled>Seleccione un tipo de ausencia...</option>
                    <option value="Vacaciones" {{ old('tipoAusencias') == 'Vacaciones' ? 'selected' : '' }}>Vacaciones</option>
                    <option value="Enfermedad" {{ old('tipoAusencias') == 'Enfermedad' ? 'selected' : '' }}>Enfermedad</option>
                    <option value="Licencia de maternidad/paternidad" {{ old('tipoAusencias') == 'Licencia de maternidad/paternidad' ? 'selected' : '' }}>Licencia de maternidad/paternidad</option>
                    <option value="Licencia no remunerada" {{ old('tipoAusencias') == 'Licencia no remunerada' ? 'selected' : '' }}>Licencia no remunerada</option>
                    <option value="Día libre" {{ old('tipoAusencias') == 'Día libre' ? 'selected' : '' }}>Día libre</option>
                    <option value="Otro" {{ old('tipoAusencias') == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
                @error('tipoAusencias')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="fechaInicio" class="form-label fw-semibold text-secondary">
                        <i class="bi bi-calendar-event me-1"></i>Fecha de Inicio <span class="text-danger">*</span>
                    </label>
                    <input type="date" class="form-control @error('fechaInicio') is-invalid @enderror" 
                           id="fechaInicio" name="fechaInicio" value="{{ old('fechaInicio') }}" required>
                    @error('fechaInicio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="fechaFin" class="form-label fw-semibold text-secondary">
                        <i class="bi bi-calendar-check me-1"></i>Fecha de Fin <span class="text-danger">*</span>
                    </label>
                    <input type="date" class="form-control @error('fechaFin') is-invalid @enderror" 
                           id="fechaFin" name="fechaFin" value="{{ old('fechaFin') }}" required>
                    @error('fechaFin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="observacionesAusencias" class="form-label fw-semibold text-secondary">
                    <i class="bi bi-calendar-check me-1"></i>Observaciones
                </label>
                <textarea class="form-control @error('observacionesAusencias') is-invalid @enderror" 
                       id="observacionesAusencias" name="observacionesAusencias">{{ old('observacionesAusencias') }}</textarea>
                @error('observacionesAusencias')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="documentoAdjuntoAusencias" class="form-label fw-semibold text-secondary">
                    <i class="bi bi-file-earmark-arrow-up me-1"></i>Documento Adjunto (Justificación)
                </label>
                <input type="file" class="form-control @error('documentoAdjuntoAusencias') is-invalid @enderror" 
                       id="documentoAdjuntoAusencias" name="documentoAdjuntoAusencias" accept=".pdf,.jpg,.jpeg,.png">
                <div class="form-text text-muted small">Formatos permitidos: PDF, JPG, PNG.</div>
                @error('documentoAdjuntoAusencias')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end gap-2 border-top pt-3">
                <button type="button" class="btn btn-danger px-4" data-bs-dismiss="offcanvas">
                    <i class="bi bi-x-lg me-1"></i>Cancelar
                </button>
                <button type="submit" class="btn btn-primary px-4 fw-bold">
                    <i class="bi bi-save me-1"></i>Guardar Ausencia
                </button>
            </div>
        </form>
    </div>
</div>