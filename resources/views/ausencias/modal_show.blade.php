<div class="modal fade" id="modalShowAusencia" tabindex="-1" aria-labelledby="modalShowAusenciaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-success border-0 py-3">
                <h5 class="modal-title fw-bold text-white" id="modalShowAusenciaLabel">
                    <i class="bi bi-file-earmark-person me-2"></i>Detalles de Ausencia
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                {{-- Encabezado con Avatar y Nombre --}}
                <div class="text-center mb-4">
                    <img src="" id="ausenciaAvatar" class="rounded-circle border border-3 border-success shadow-sm mb-3" width="90" height="90" style="object-fit: cover;" alt="Avatar del empleado">
                    <h4 class="fw-bold mb-1 text-dark" id="ausenciaEmpleadoNombre">Nombre del Empleado</h4>
                    <div class="mt-2">
                        <span id="ausenciaEstado" class="badge px-3 py-2 rounded-pill fs-6 shadow-sm">Pendiente</span>
                    </div>
                </div>

                {{-- Detalles principales --}}
                <div class="row g-3">
                    <div class="col-12">
                        <div class="p-3 bg-light rounded shadow-sm border-start border-4 border-success">
                            <h4 class="text-muted fw-bold mb-1"><i class="bi bi-tag me-2 text-success"></i>Tipo de Ausencia</h4>
                            <p class="mb-0 fs-5 fw-semibold text-dark" id="ausenciaTipo">Tipo</p>
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded shadow-sm h-100 border-start border-4 border-info">
                            <h4 class="text-muted fw-bold mb-1"><i class="bi bi-calendar-range me-2 text-info"></i>Fechas</h4>
                            <p class="mb-0 fw-semibold text-dark" id="ausenciaFechas">Inicio a Fin</p>
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded shadow-sm h-100 border-start border-4 border-warning">
                            <h4 class="text-muted fw-bold mb-1"><i class="bi bi-clock-history me-2 text-warning"></i>Duración</h4>
                            <p class="mb-0 fw-semibold text-dark" id="ausenciaDias">X días</p>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="p-3 bg-light rounded shadow-sm">
                            <h4 class="text-muted fw-bold mb-1"><i class="bi bi-chat-left-text me-2 text-secondary"></i>Observaciones</h4>
                            <p class="mb-0 text-dark" id="ausenciaObservaciones">Sin observaciones</p>
                        </div>
                    </div>
                </div>

                {{-- Botón para ver documento (se oculta si no hay documento por JS) --}}
                <div class="mt-4 text-center">
                    <a href="#" id="ausenciaDocumentoLink" target="_blank" class="btn btn-outline-success btn-lg px-4 shadow-sm rounded-pill fw-bold" style="display: none;">
                        <i class="bi bi-file-earmark-text me-2"></i>Ver Documento Adjunto
                    </a>
                </div>
            </div>
            <div class="modal-footer bg-light border-0 justify-content-center">
                <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
