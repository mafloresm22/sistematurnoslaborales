<div class="modal fade" id="modalDocumentoAdjunto" tabindex="-1" aria-labelledby="modalDocumentoAdjuntoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary border-0 py-3">
                <h5 class="modal-title fw-bold text-white" id="modalDocumentoAdjuntoLabel">
                    <i class="bi bi-file-earmark-check me-2"></i>Documento Adjunto
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                
                {{-- Mensaje por si no hay documento --}}
                <div id="noDocumentoMensaje" class="alert alert-warning d-none mb-0">
                    <i class="bi bi-exclamation-triangle me-2"></i>Esta ausencia no tiene un documento adjunto.
                </div>

                {{-- Contenedor del Preview --}}
                <div id="previewDocumentoContenedor" class="mb-3 d-none bg-light p-2 rounded shadow-sm">
                    <!-- JS inyectará el iframe o la img aquí -->
                </div>

                {{-- Botón de descarga --}}
                <div class="mt-4">
                    <a href="#" id="btnDescargarDocumento" class="btn btn-success fw-bold px-4 rounded-pill d-none" target="_blank" download>
                        <i class="bi bi-download me-2"></i>Descargar Documento
                    </a>
                </div>

            </div>
            <div class="modal-footer bg-light border-0 justify-content-center">
                <button type="button" class="btn btn-danger px-4 fw-bold" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
