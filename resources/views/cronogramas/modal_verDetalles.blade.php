{{-- Mini-modal para detalle de evento al hacer clic --}}
<div class="modal fade" id="modalDetalleEvento" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            {{-- Header --}}
            <div class="modal-header border-0 py-3 px-4 bg-warning text-white">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle bg-white bg-opacity-10 d-flex align-items-center justify-content-center"
                         style="width: 34px; height: 34px;">
                        <i class="bi bi-info-circle fs-5 text-white"></i>
                    </div>
                    <div>
                        <h6 class="modal-title fw-bold mb-0 text-white">Detalle del Turno</h6>
                        <small class="text-white text-opacity-75" id="detallesFecha">—</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-dark btn-sm" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            {{-- Body --}}
            <div class="modal-body p-4">
                {{-- Empleado Section --}}
                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="rounded-3 bg-light p-2 d-flex align-items-center justify-content-center border"
                         style="width: 42px; height: 42px; min-width: 42px;">
                        <i class="bi bi-person text-secondary fs-4"></i>
                    </div>
                    <div class="flex-grow-1">
                        <label class="form-label fw-semibold text-secondary small mb-0">Empleado</label>
                        <h6 class="fw-bold text-dark mb-0" id="detallesEmpleado">—</h6>
                    </div>
                </div>

                {{-- Turno Section --}}
                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="rounded-3 bg-light p-2 d-flex align-items-center justify-content-center border"
                         style="width: 42px; height: 42px; min-width: 42px;">
                        <i class="bi bi-clock text-secondary fs-4"></i>
                    </div>
                    <div class="flex-grow-1">
                        <label class="form-label fw-semibold text-secondary small mb-0">Turno y Horario</label>
                        <h6 class="fw-bold text-dark mb-1" id="detallesTurno">—</h6>
                        <span class="badge bg-primary-subtle text-primary px-2 py-1 rounded-pill small" id="detallesHorario">—</span>
                    </div>
                </div>

                {{-- Nota Section --}}
                <div class="d-none" id="detallesNotaContainer">
                    <div class="d-flex align-items-start gap-3">
                        <div class="rounded-3 bg-light p-2 d-flex align-items-center justify-content-center border"
                             style="width: 42px; height: 42px; min-width: 42px;">
                            <i class="bi bi-chat-left-text text-secondary fs-4"></i>
                        </div>
                        <div class="flex-grow-1">
                            <label class="form-label fw-semibold text-secondary small mb-0">Nota</label>
                            <p class="mb-0 text-muted small bg-light p-2 rounded-3 border mt-1" id="detallesNota" style="white-space: pre-wrap;"></p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="modal-footer border-0 pt-0 px-4 pb-4 justify-content-center">
                <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg me-1"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>