<div class="modal fade" id="modalCambiarEstadoAusencias" tabindex="-1" aria-labelledby="modalCambiarEstadoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger border-0 py-3">
                <h5 class="modal-title fw-bold text-white" id="modalCambiarEstadoLabel">
                    <i class="bi bi-arrow-left-right me-2"></i>Cambiar Estado de Ausencia
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formCambiarEstadoAusencias" action="" method="POST">
                @csrf
                @method('PATCH')

                <div class="modal-body p-4">

                    <p class="text-muted mb-4 text-center">
                        Selecciona el nuevo estado para la ausencia de <strong id="cambiarEstadoNombre">---</strong>.
                    </p>

                    {{-- Opciones de estado --}}
                    <div class="d-flex gap-3 justify-content-center mb-4">
                        <div class="form-check p-0">
                            <input class="btn-check" type="radio" name="estadoAusencias" id="estadoAprobado" value="Aprobado" required>
                            <label class="btn btn-outline-success px-4 py-3 fw-bold rounded-3" for="estadoAprobado">
                                <i class="bi bi-check-circle me-2 fs-5"></i>Aprobado
                            </label>
                        </div>
                        <div class="form-check p-0">
                            <input class="btn-check" type="radio" name="estadoAusencias" id="estadoRechazado" value="Rechazado" required>
                            <label class="btn btn-outline-danger px-4 py-3 fw-bold rounded-3" for="estadoRechazado">
                                <i class="bi bi-x-circle me-2 fs-5"></i>Rechazado
                            </label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light border-0 justify-content-center gap-2">
                    <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save me-1"></i>Guardar Estado
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
