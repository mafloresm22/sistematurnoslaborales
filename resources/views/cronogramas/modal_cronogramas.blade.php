{{-- Modal: Calendario de Cronograma por Sucursal --}}
<div class="modal fade" id="modalCalendarioCronograma" tabindex="-1" aria-labelledby="modalCalendarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header bg-primary border-0 py-3">
                <h5 class="modal-title fw-bold text-white" id="modalCalendarioLabel">
                    <i class="bi bi-calendar3 me-2"></i>Calendario de Turnos —
                    <span id="calendarioTituloSucursal" class="fw-light fst-italic"></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">

                {{-- Leyenda de carga --}}
                <div id="calendarioCargando" class="text-center py-4 text-muted">
                    <div class="spinner-border text-primary mb-3" role="status"></div>
                    <p>Cargando calendario...</p>
                </div>

                {{-- Contenedor del calendario FullCalendar --}}
                <div id="fullCalendarioCronograma" style="min-height: 500px;"></div>

            </div>

            <div class="modal-footer bg-light border-0 justify-content-center">
                <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg me-1"></i>Cerrar
                </button>
            </div>

        </div>
    </div>
</div>

{{-- Mini-modal para detalle de evento al hacer clic --}}
<div class="modal fade" id="modalDetalleEvento" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-dark text-white border-0 py-2">
                <h6 class="modal-title fw-bold mb-0"><i class="bi bi-info-circle me-2"></i>Detalle del Turno</h6>
                <button type="button" class="btn-close btn-close-white btn-sm" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body py-3 px-4 small lh-lg" id="popoverEventoContenido">
                —
            </div>
            <div class="modal-footer border-0 py-2 justify-content-center">
                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

{{-- FullCalendar CDN --}}
@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.11/locales/es.global.min.js"></script>
@endpush
