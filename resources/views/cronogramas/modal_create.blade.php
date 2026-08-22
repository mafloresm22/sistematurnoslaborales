{{-- Mini-modal: Crear Cronograma al hacer clic en un día --}}
<div class="modal fade" id="modalCrearCronograma" tabindex="-1" aria-labelledby="modalCrearCronogramaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            {{-- Header --}}
            <div class="modal-header border-0 py-3 px-4 bg-primary">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center"
                         style="width: 34px; height: 34px;">
                        <i class="bi bi-calendar-plus text-white fs-6"></i>
                    </div>
                    <div>
                        <h6 class="modal-title fw-bold text-white mb-0" id="modalCrearCronogramaLabel">
                            Asignar Turno
                        </h6>
                        <small class="text-white text-opacity-75" id="labelFechaSeleccionada">—</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white btn-sm" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            {{-- Body --}}
            <div class="modal-body p-4">
                <form id="formCrearCronograma" novalidate>
                    @csrf
                    {{-- Campos ocultos para lógica interna --}}
                    <input type="hidden" id="inputSucursalCronograma" name="sucursalesid">

                    {{-- Empleado --}}
                    <div class="mb-3">
                        <label for="selectEmpleado" class="form-label fw-semibold text-secondary small mb-1">
                            <i class="bi bi-person me-1"></i>Empleado
                        </label>
                        <select class="form-select form-select select2-empleado"
                                id="selectEmpleado" name="empleadoid" required style="width: 100%;">
                            <option value=""></option>
                        </select>
                        <div class="invalid-feedback">Selecciona un empleado.</div>
                    </div>

                    {{-- Turno --}}
                    <div class="mb-3">
                        <label for="selectTurno" class="form-label fw-semibold text-secondary small mb-1">
                            <i class="bi bi-clock me-1"></i>Turno
                        </label>
                        <select class="form-select form-select" id="selectTurno" name="turnoid" required style="width: 100%;">
                            <option value="" disabled selected>Selecciona un turno…</option>
                        </select>
                        <div class="invalid-feedback">Selecciona un turno.</div>
                    </div>

                    {{-- Fecha --}}
                    <div class="mb-3">
                        <label for="inputFechaCronograma" class="form-label fw-semibold text-secondary small mb-1">
                            <i class="bi bi-calendar-event me-1"></i>Fecha
                        </label>
                        <input type="date" class="form-control form-control" readonly
                               id="inputFechaCronograma" name="fechaCronograma">
                        <div class="invalid-feedback">Selecciona una fecha válida.</div>
                    </div>

                    {{-- Nota --}}
                    <div class="mb-2">
                        <label for="inputNota" class="form-label fw-semibold text-secondary small mb-1">
                            <i class="bi bi-pencil me-1"></i>Nota <span class="fw-normal text-muted">(opcional)</span>
                        </label>
                        <textarea class="form-control form-control" id="inputNota" name="notaCronograma"
                                  rows="2" placeholder="Observaciones del turno…" style="resize: none;"></textarea>
                    </div>

                    {{-- Feedback de errores --}}
                    <div id="alertCrearCronograma" class="alert alert-danger alert-sm py-2 px-3 small d-none mt-2 mb-0 rounded-3">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        <span id="textoAlertCrear"></span>
                    </div>
                </form>
            </div>

            <div class="modal-footer border-0 pt-0 px-4 pb-4 gap-2">
                <button type="button" class="btn btn-danger px-3" data-bs-dismiss="modal">
                    <i class="bi bi-x me-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary px-4" id="btnGuardarCronograma">
                    <span id="btnGuardarTexto"><i class="bi bi-check2 me-1"></i>Guardar</span>
                    <span id="btnGuardarSpinner" class="d-none">
                        <span class="spinner-border spinner-border-sm me-1" role="status"></span>Guardando…
                    </span>
                </button>
            </div>

        </div>
    </div>
</div>
