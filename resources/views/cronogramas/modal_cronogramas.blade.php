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

                {{-- Tip de interacción --}}
                <p class="text-muted small text-center mt-3 mb-0">
                    <i class="bi bi-info-circle me-1"></i>
                    Haz clic en un día vacío para asignar un turno, o en un evento para ver su detalle.
                </p>

            </div>

            <div class="modal-footer bg-light border-0 justify-content-center">
                <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg me-1"></i>Cerrar
                </button>
            </div>

        </div>
    </div>
</div>

@include('cronogramas.modal_verDetalles')
@include('cronogramas.modal_create')

<script>
    let _calendarioSucursalId   = null;
    let _calendarioSucursalNombre = null;

    const empleadosPorSucursal = {}; 
    const turnosDisponibles    = @json($turnos ?? []);

    (function poblarTurnos() {
        const sel = document.getElementById('selectTurno');
        if (!sel) return;
        turnosDisponibles.forEach(function (t) {
            const opt       = document.createElement('option');
            opt.value       = t.idTurno;
            opt.textContent = t.nombreTurnos + ' ' + t.horaInicio + ' - ' + t.horaFin;
            opt.dataset.color = t.colorFondo ?? '#0d6efd';
            opt.dataset.categoria = t.categoria ? t.categoria.nombreCategorias : '';
            sel.appendChild(opt);
        });
    })();

    document.querySelectorAll('.btn-ver-calendario').forEach(function (btn) {
        btn.addEventListener('click', function () {
            _calendarioSucursalId     = this.dataset.idSucursal;
            _calendarioSucursalNombre = this.dataset.nombreSucursal;

            const tituloEl = document.getElementById('calendarioTituloSucursal');
            if (tituloEl) tituloEl.textContent = _calendarioSucursalNombre;

            const modalEl = document.getElementById('modalCalendarioCronograma');
            modalEl.addEventListener('shown.bs.modal', function handler() {
                inicializarCalendario(_calendarioSucursalId);
                modalEl.removeEventListener('shown.bs.modal', handler);
            }, { once: true });
        });
    });

    let calendarioInstance = null;

    function inicializarCalendario(idSucursal) {
        const calendarEl = document.getElementById('fullCalendarioCronograma');
        if (!calendarEl) return;

        document.getElementById('calendarioCargando').style.display = '';

        if (calendarioInstance) {
            calendarioInstance.destroy();
            calendarioInstance = null;
        }

        calendarioInstance = new FullCalendar.Calendar(calendarEl, {
            locale: 'es',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left:   'prev,next today',
                center: 'title',
                right:  'dayGridMonth,timeGridWeek,listWeek'
            },
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week:  'Semana',
                list:  'Lista',
            },
            dayCellClassNames: 'cursor-pointer',
            events: `{{ url('cronogramas') }}/${idSucursal}/eventos`,

            // Ocultar spinner cuando el calendario termina de pintar la vista
            datesSet: function () {
                document.getElementById('calendarioCargando').style.display = 'none';
            },

            eventClick: function (info) {
                const props = info.event.extendedProps;
                document.getElementById('detallesEmpleado').textContent = props.empleado;
                document.getElementById('detallesTurno').textContent = props.turno;
                document.getElementById('detallesHorario').textContent = props.horario;
                const fechaObj = info.event.start;
                const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                document.getElementById('detallesFecha').textContent = fechaObj.toLocaleDateString('es-ES', opciones);

                const notaContainer = document.getElementById('detallesNotaContainer');
                const notaText = document.getElementById('detallesNota');
                if (props.nota && props.nota.trim() !== '' && props.nota.toLowerCase() !== 'ninguno') {
                    notaText.textContent = props.nota;
                    notaContainer.classList.remove('d-none');
                } else {
                    notaContainer.classList.add('d-none');
                }

                const popoverModal = new bootstrap.Modal(document.getElementById('modalDetalleEvento'));
                popoverModal.show();
            },

            dateClick: function (info) {
                abrirModalCrear(info.dateStr, idSucursal);
            },

            noEventsContent: 'No hay turnos asignados para esta sucursal.',
            height: 'auto',
        });

        calendarioInstance.render();

        setTimeout(function () {
            document.getElementById('calendarioCargando').style.display = 'none';
        }, 300);
    }

    // ─── Abrir mini-modal de creación ────────────────────────────────────────
    function abrirModalCrear(fecha, idSucursal) {
        const form = document.getElementById('formCrearCronograma');
        form.classList.remove('was-validated');
        form.reset();
        ocultarAlertaCrear();

        // Setear fecha en el input date visible
        document.getElementById('inputFechaCronograma').value    = fecha;
        document.getElementById('inputSucursalCronograma').value = idSucursal;

        // Mostrar fecha formateada en el header del modal
        const fechaObj   = new Date(fecha + 'T00:00:00');
        const opciones   = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const fechaTexto = fechaObj.toLocaleDateString('es-ES', opciones);
        document.getElementById('labelFechaSeleccionada').textContent = fechaTexto;

        // Inicializar Select2 si jQuery está disponible
        if (typeof $ !== 'undefined') {
            $('#selectEmpleado').select2({
                theme: 'bootstrap-5',
                placeholder: 'Busca un empleado…',
                allowClear: true,
                dropdownParent: $('#modalCrearCronograma'),
                language: {
                    noResults: function () { return 'No se encontraron empleados.'; },
                    searching:  function () { return 'Buscando…'; },
                }
            });

            $('#selectTurno').select2({
                theme: 'bootstrap-5',
                placeholder: 'Selecciona un turno…',
                allowClear: true,
                dropdownParent: $('#modalCrearCronograma'),
                templateResult: function (state) {
                    if (!state.id) return state.text;
                    const color = state.element.dataset.color || '#0d6efd';
                    const categoria = state.element.dataset.categoria;
                    const badgeHtml = categoria ? `<span class="badge bg-secondary text-white ms-auto py-1 px-2" style="font-size: 0.7rem;">${categoria}</span>` : '';
                    return $(`
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <div class="d-flex align-items-center">
                                <span class="rounded-circle me-2" style="width: 8px; height: 8px; background-color: ${color}; display: inline-block;"></span>
                                <span>${state.text}</span>
                            </div>
                            ${badgeHtml}
                        </div>
                    `);
                },
                templateSelection: function (state) {
                    if (!state.id) return state.text;
                    const categoria = state.element.dataset.categoria;
                    const catText = categoria ? ` [${categoria}]` : '';
                    return state.text + catText;
                }
            });
        }

        cargarEmpleados(idSucursal);

        const modal = new bootstrap.Modal(document.getElementById('modalCrearCronograma'));
        modal.show();
    }

    // Destruir Select2 al cerrar el mini-modal para evitar duplicados
    document.getElementById('modalCrearCronograma').addEventListener('hidden.bs.modal', function () {
        if (typeof $ !== 'undefined') {
            if ($('#selectEmpleado').data('select2')) {
                $('#selectEmpleado').select2('destroy');
            }
            if ($('#selectTurno').data('select2')) {
                $('#selectTurno').select2('destroy');
            }
        }
    });

    // ─── Cargar empleados de la sucursal (con caché) ─────────────────────────
    function cargarEmpleados(idSucursal) {
        if (empleadosPorSucursal[idSucursal]) {
            poblarSelectEmpleados(empleadosPorSucursal[idSucursal]);
            return;
        }

        fetch(`{{ url('cronogramas') }}/${idSucursal}/empleados`)
            .then(function (r) { return r.json(); })
            .then(function (data) {
                empleadosPorSucursal[idSucursal] = data;
                poblarSelectEmpleados(data);
            })
            .catch(function () {
                // Si falla, dejar el select vacío con placeholder
            });
    }

    function poblarSelectEmpleados(empleados) {
        // Limpiar y reconstruir opciones via jQuery/Select2
        const $sel = $('#selectEmpleado');
        $sel.empty().append(new Option('', '', false, false));
        empleados.forEach(function (e) {
            $sel.append(new Option(
                e.nombreEmpleados + ' ' + e.apellidoEmpleados,
                e.idEmpleados,
                false,
                false
            ));
        });
        $sel.trigger('change'); 
    }

    // ─── Guardar cronograma ───────────────────────────────────────────────────
    document.getElementById('btnGuardarCronograma').addEventListener('click', function () {
        const form = document.getElementById('formCrearCronograma');

        // Validación nativa de HTML5
        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        const btnTexto   = document.getElementById('btnGuardarTexto');
        const btnSpinner = document.getElementById('btnGuardarSpinner');
        btnTexto.classList.add('d-none');
        btnSpinner.classList.remove('d-none');
        ocultarAlertaCrear();

        const formData = new FormData(form);

        fetch('{{ route('cronogramas.store') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept':       'application/json',
            },
            body: formData,
        })
        .then(function (r) { return r.json().then(function (d) { return { ok: r.ok, data: d }; }); })
        .then(function (res) {
            btnTexto.classList.remove('d-none');
            btnSpinner.classList.add('d-none');

            if (res.ok && res.data.success) {
                // Cerrar mini-modal
                bootstrap.Modal.getInstance(document.getElementById('modalCrearCronograma')).hide();
                // Recargar eventos del calendario
                if (calendarioInstance) {
                    calendarioInstance.refetchEvents();
                }
            } else {
                const mensajes = res.data.errors
                    ? Object.values(res.data.errors).flat().join(' ')
                    : (res.data.message ?? 'Error al guardar el cronograma.');
                mostrarAlertaCrear(mensajes);
            }
        })
        .catch(function () {
            btnTexto.classList.remove('d-none');
            btnSpinner.classList.add('d-none');
            mostrarAlertaCrear('Ocurrió un error inesperado. Inténtalo de nuevo.');
        });
    });

    function mostrarAlertaCrear(msg) {
        document.getElementById('textoAlertCrear').textContent = msg;
        document.getElementById('alertCrearCronograma').classList.remove('d-none');
    }
    function ocultarAlertaCrear() {
        document.getElementById('alertCrearCronograma').classList.add('d-none');
    }
</script>
