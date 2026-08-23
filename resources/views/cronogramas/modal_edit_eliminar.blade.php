{{-- Modal: Gestionar, Editar y Eliminar Turnos por Sucursal --}}
<div class="modal fade" id="modalEditEliminarCronograma" tabindex="-1" aria-labelledby="modalEditEliminarLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            {{-- Header --}}
            <div class="modal-header border-0 py-3 px-4 bg-warning text-white">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center"
                         style="width: 38px; height: 38px;">
                        <i class="bi bi-pencil-square text-white fs-5"></i>
                    </div>
                    <div>
                        <h6 class="modal-title fw-bold text-white mb-0" id="modalEditEliminarLabel">
                            Gestionar Turnos Asignados
                        </h6>
                        <small class="text-white text-opacity-75" id="labelSucursalGestionar">—</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white btn-sm" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            {{-- Body --}}
            <div class="modal-body p-4">

                {{-- 1. CONTENEDOR DE LISTADO --}}
                <div id="listCronogramasContainer">
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-7">
                            <h5 class="fw-bold mb-0 text-dark">Lista de Turnos</h5>
                        </div>
                        <div class="col-md-5 mt-2 mt-md-0">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control bg-light border-start-0 ps-0" 
                                       id="inputBuscarTurno" placeholder="Buscar por empleado o fecha...">
                            </div>
                        </div>
                    </div>

                    {{-- Loading Spinner --}}
                    <div id="loadingListar" class="text-center py-5 text-muted">
                        <div class="spinner-border text-warning mb-3" role="status"></div>
                        <p class="mb-0">Cargando asignaciones...</p>
                    </div>

                    {{-- Table Area --}}
                    <div id="tableListarContainer" class="d-none">
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light sticky-top" style="top: 0; z-index: 1;">
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Empleado</th>
                                        <th>Turno / Horario</th>
                                        <th class="text-center" style="width: 140px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyCronogramas">
                                    {{-- Dinámico --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- 2. CONTENEDOR DE EDICION (INLINE FORM) --}}
                <div id="editCronogramaContainer" class="d-none">
                    <h5 class="fw-bold mb-3 text-dark">
                        <i class="bi bi-pencil-square me-2 text-warning"></i>Modificar Asignación
                    </h5>

                    <form id="formActualizarCronograma" novalidate>
                        <input type="hidden" id="edit_idCronograma">
                        
                        <div class="row">
                            {{-- Empleado --}}
                            <div class="col-md-6 mb-3">
                                <label for="edit_selectEmpleado" class="form-label fw-semibold text-secondary small mb-1">
                                    <i class="bi bi-person me-1"></i>Empleado
                                </label>
                                <select class="form-select select2-empleado-edit" id="edit_selectEmpleado" name="empleadoid" required style="width: 100%;">
                                    <option value=""></option>
                                </select>
                                <div class="invalid-feedback">Selecciona un empleado.</div>
                            </div>

                            {{-- Turno --}}
                            <div class="col-md-6 mb-3">
                                <label for="edit_selectTurno" class="form-label fw-semibold text-secondary small mb-1">
                                    <i class="bi bi-clock me-1"></i>Turno
                                </label>
                                <select class="form-select" id="edit_selectTurno" name="turnoid" required style="width: 100%;">
                                    <option value="" disabled>Selecciona un turno…</option>
                                </select>
                                <div class="invalid-feedback">Selecciona un turno.</div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Fecha --}}
                            <div class="col-md-6 mb-3">
                                <label for="edit_inputFecha" class="form-label fw-semibold text-secondary small mb-1">
                                    <i class="bi bi-calendar-event me-1"></i>Fecha
                                </label>
                                <input type="date" class="form-control" id="edit_inputFecha" name="fechaCronograma" required>
                                <div class="invalid-feedback">Selecciona una fecha válida.</div>
                            </div>
                        </div>

                        {{-- Feedback de errores --}}
                        <div id="alertEditarCronograma" class="alert alert-danger alert-sm py-2 px-3 small d-none mt-2 mb-0 rounded-3">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            <span id="textoAlertEditar"></span>
                        </div>
                    </form>
                </div>

            </div>

            {{-- Footer --}}
            <div class="modal-footer border-0 pt-0 px-4 pb-4">
                {{-- Botones de Listado --}}
                <div id="footerListar" class="w-100 d-flex justify-content-between align-items-center">
                    <span class="text-muted small"><i class="bi bi-info-circle me-1"></i>Haz clic en Editar o Eliminar según corresponda.</span>
                    <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i>Cerrar
                    </button>
                </div>

                {{-- Botones de Edición --}}
                <div id="footerEditar" class="w-100 d-flex justify-content-center gap-2 d-none">
                    <button type="button" class="btn btn-danger px-3" id="btnCancelarEdicion">
                        <i class="bi bi-arrow-left me-1"></i>Volver
                    </button>
                    <button type="button" class="btn btn-warning text-white px-4" id="btnGuardarEdicion">
                        <span id="btnGuardarEdicionTexto"><i class="bi bi-check2 me-1"></i>Guardar Cambios</span>
                        <span id="btnGuardarEdicionSpinner" class="d-none">
                            <span class="spinner-border spinner-border-sm me-1" role="status"></span>Guardando…
                        </span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    let _editSucursalId = null;
    let _cronogramasCargados = [];

    // Poblar dropdown de turnos en el formulario de edición al cargar la página
    (function poblarTurnosEdicion() {
        const sel = document.getElementById('edit_selectTurno');
        if (!sel || typeof turnosDisponibles === 'undefined') return;
        turnosDisponibles.forEach(function (t) {
            const opt = document.createElement('option');
            opt.value = t.idTurno;
            opt.textContent = t.nombreTurnos + ' ' + t.horaInicio + ' - ' + t.horaFin;
            opt.dataset.color = t.colorFondo ?? '#0d6efd';
            opt.dataset.categoria = t.categoria ? t.categoria.nombreCategorias : '';
            sel.appendChild(opt);
        });
    })();

    // Función principal para abrir el modal
    function confirmarEditar(idSucursal, nombreSucursal) {
        _editSucursalId = idSucursal;
        
        // Configurar título del modal
        document.getElementById('labelSucursalGestionar').textContent = nombreSucursal;

        // Mostrar listado por defecto
        mostrarVistaListado();

        // Mostrar Modal
        const modal = new bootstrap.Modal(document.getElementById('modalEditEliminarCronograma'));
        modal.show();

        // Cargar datos
        cargarCronogramasSucursal(idSucursal);
    }

    // Cambiar a vista de listado
    function mostrarVistaListado() {
        document.getElementById('listCronogramasContainer').classList.remove('d-none');
        document.getElementById('editCronogramaContainer').classList.add('d-none');
        document.getElementById('footerListar').classList.remove('d-none');
        document.getElementById('footerEditar').classList.add('d-none');
        document.getElementById('inputBuscarTurno').value = '';
        ocultarAlertaEditar();
    }

    // Cambiar a vista de edición
    function mostrarVistaEdicion() {
        document.getElementById('listCronogramasContainer').classList.add('d-none');
        document.getElementById('editCronogramaContainer').classList.remove('d-none');
        document.getElementById('footerListar').classList.add('d-none');
        document.getElementById('footerEditar').classList.remove('d-none');
    }

    // Cargar cronogramas de la sucursal desde el servidor
    function cargarCronogramasSucursal(idSucursal) {
        document.getElementById('loadingListar').classList.remove('d-none');
        document.getElementById('tableListarContainer').classList.add('d-none');

        fetch(`{{ url('cronogramas') }}/${idSucursal}/listar`)
            .then(r => r.json())
            .then(data => {
                _cronogramasCargados = data;
                pintarTablaCronogramas(data);
            })
            .catch(() => {
                document.getElementById('tbodyCronogramas').innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center text-danger py-4">
                            <i class="bi bi-exclamation-octagon fs-4 mb-2 d-block"></i>
                            Error al cargar los turnos asignados.
                        </td>
                    </tr>
                `;
                document.getElementById('loadingListar').classList.add('d-none');
                document.getElementById('tableListarContainer').classList.remove('d-none');
            });
    }

    // Pintar los datos en el tbody
    function pintarTablaCronogramas(cronogramas) {
        const tbody = document.getElementById('tbodyCronogramas');
        tbody.innerHTML = '';

        if (cronogramas.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        No hay turnos asignados en esta sucursal.
                    </td>
                </tr>
            `;
        } else {
            cronogramas.forEach(c => {
                const fechaFormat = formatearFechaString(c.fechaCronograma);
                const nombreEmpleado = `${c.empleado.nombreEmpleados} ${c.empleado.apellidoEmpleados}`;
                const nombreTurno = `${c.turno.nombreTurnos} (${c.turno.horaInicio.substring(0, 5)} - ${c.turno.horaFin.substring(0, 5)})`;
                const colorFondo = c.turno.colorFondo ?? '#0d6efd';

                const tr = document.createElement('tr');
                tr.dataset.empleado = nombreEmpleado.toLowerCase();
                tr.dataset.fecha = c.fechaCronograma.substring(0, 10);

                tr.innerHTML = `
                    <td><span class="fw-semibold text-dark">${fechaFormat}</span></td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center fw-bold text-secondary"
                                 style="width: 30px; height: 30px; font-size: 0.75rem;">
                                ${c.empleado.nombreEmpleados.charAt(0)}${c.empleado.apellidoEmpleados.charAt(0)}
                            </div>
                            <span>${nombreEmpleado}</span>
                        </div>
                    </td>
                    <td>
                        <span class="badge text-white px-2 py-1" style="background-color: ${colorFondo};">
                            ${nombreTurno}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            <button class="btn btn-sm btn-outline-warning" onclick="abrirFormularioEditar(${c.idCronograma})">
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" onclick="eliminarCronograma(${c.idCronograma}, '${nombreEmpleado}', '${fechaFormat}')">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </div>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        document.getElementById('loadingListar').classList.add('d-none');
        document.getElementById('tableListarContainer').classList.remove('d-none');
    }

    // Buscador en tiempo real
    document.getElementById('inputBuscarTurno').addEventListener('keyup', function () {
        const query = this.value.toLowerCase().trim();
        const rows = document.querySelectorAll('#tbodyCronogramas tr');

        rows.forEach(r => {
            if (r.cells.length === 1 && r.cells[0].colSpan === 5) return; // Fila de sin resultados o error
            const empName = r.dataset.empleado || '';
            const fechaVal = r.dataset.fecha || '';
            
            if (empName.includes(query) || fechaVal.includes(query)) {
                r.classList.remove('d-none');
            } else {
                r.classList.add('d-none');
            }
        });
    });

    // Formateador de fecha
    function formatearFechaString(fechaRaw) {
        if (!fechaRaw) return '';
        const fecha = new Date(fechaRaw.substring(0, 10) + 'T00:00:00');
        const opciones = { day: '2-digit', month: '2-digit', year: 'numeric' };
        return fecha.toLocaleDateString('es-ES', opciones);
    }

    // Cargar empleados al select del formulario de edición
    function cargarEmpleadosEditar(idSucursal, callback) {
        if (empleadosPorSucursal[idSucursal]) {
            poblarSelectEmpleadosEditar(empleadosPorSucursal[idSucursal]);
            if (callback) callback();
            return;
        }

        fetch(`{{ url('cronogramas') }}/${idSucursal}/empleados`)
            .then(r => r.json())
            .then(data => {
                empleadosPorSucursal[idSucursal] = data;
                poblarSelectEmpleadosEditar(data);
                if (callback) callback();
            });
    }

    function poblarSelectEmpleadosEditar(empleados) {
        const $sel = $('#edit_selectEmpleado');
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

    // Abrir Formulario de Edición
    function abrirFormularioEditar(idCronograma) {
        const crono = _cronogramasCargados.find(c => c.idCronograma === idCronograma);
        if (!crono) return;

        // Resetear validaciones
        const form = document.getElementById('formActualizarCronograma');
        form.classList.remove('was-validated');
        ocultarAlertaEditar();

        // Rellenar campos ocultos e inputs básicos
        document.getElementById('edit_idCronograma').value = crono.idCronograma;
        document.getElementById('edit_inputFecha').value = crono.fechaCronograma.substring(0, 10);

        // Cargar empleados de la sucursal y setear el actual
        cargarEmpleadosEditar(_editSucursalId, function () {
            // Inicializar Select2 si jquery/select2 está disponible
            if (typeof $ !== 'undefined') {
                $('#edit_selectEmpleado').select2({
                    theme: 'bootstrap-5',
                    placeholder: 'Busca un empleado…',
                    allowClear: true,
                    dropdownParent: $('#modalEditEliminarCronograma'),
                    language: {
                        noResults: function () { return 'No se encontraron empleados.'; },
                        searching:  function () { return 'Buscando…'; },
                    }
                });

                $('#edit_selectTurno').select2({
                    theme: 'bootstrap-5',
                    placeholder: 'Selecciona un turno…',
                    allowClear: true,
                    dropdownParent: $('#modalEditEliminarCronograma'),
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

            // Seleccionar empleado y turno
            $('#edit_selectEmpleado').val(crono.empleadoid).trigger('change');
            $('#edit_selectTurno').val(crono.turnoid).trigger('change');

            mostrarVistaEdicion();
        });
    }

    function destruirSelect2Edicion() {
        if (typeof $ !== 'undefined') {
            if ($('#edit_selectEmpleado').data('select2')) {
                $('#edit_selectEmpleado').select2('destroy');
            }
            if ($('#edit_selectTurno').data('select2')) {
                $('#edit_selectTurno').select2('destroy');
            }
        }
    }

    // Botón Volver / Cancelar
    document.getElementById('btnCancelarEdicion').addEventListener('click', function () {
        destruirSelect2Edicion();
        mostrarVistaListado();
    });

    // Guardar cambios
    document.getElementById('btnGuardarEdicion').addEventListener('click', function () {
        const form = document.getElementById('formActualizarCronograma');
        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        const idCronograma = document.getElementById('edit_idCronograma').value;
        const btnTexto = document.getElementById('btnGuardarEdicionTexto');
        const btnSpinner = document.getElementById('btnGuardarEdicionSpinner');

        btnTexto.classList.add('d-none');
        btnSpinner.classList.remove('d-none');
        ocultarAlertaEditar();

        const payload = {
            empleadoid: document.getElementById('edit_selectEmpleado').value,
            turnoid: document.getElementById('edit_selectTurno').value,
            fechaCronograma: document.getElementById('edit_inputFecha').value
        };

        fetch(`{{ url('cronogramas') }}/${idCronograma}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(payload)
        })
        .then(r => r.json().then(d => ({ ok: r.ok, data: d })))
        .then(res => {
            btnTexto.classList.remove('d-none');
            btnSpinner.classList.add('d-none');

            if (res.ok && res.data.success) {
                Swal.fire({
                    title: '¡Actualizado!',
                    text: 'El turno se actualizó correctamente.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });

                destruirSelect2Edicion();
                mostrarVistaListado();
                cargarCronogramasSucursal(_editSucursalId);

                // Recargar el calendario si está inicializado
                if (calendarioInstance) {
                    calendarioInstance.refetchEvents();
                }
            } else {
                const msg = res.data.errors
                    ? Object.values(res.data.errors).flat().join(' ')
                    : (res.data.message ?? 'Error al actualizar el turno.');
                mostrarAlertaEditar(msg);
            }
        })
        .catch(() => {
            btnTexto.classList.remove('d-none');
            btnSpinner.classList.add('d-none');
            mostrarAlertaEditar('Ocurrió un error inesperado al guardar los cambios.');
        });
    });

    // Eliminar Cronograma
    function eliminarCronograma(idCronograma, empleado, fecha) {
        Swal.fire({
            title: '¿Eliminar turno asignado?',
            text: `¿Estás seguro de eliminar el turno asignado a ${empleado} el día ${fecha}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`{{ url('cronogramas') }}/${idCronograma}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(r => r.json())
                .then(res => {
                    if (res.success) {
                        Swal.fire({
                            title: '¡Eliminado!',
                            text: res.message,
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        cargarCronogramasSucursal(_editSucursalId);

                        // Recargar el calendario si está inicializado
                        if (calendarioInstance) {
                            calendarioInstance.refetchEvents();
                        }
                    } else {
                        Swal.fire('Error', res.message || 'No se pudo eliminar el turno.', 'error');
                    }
                })
                .catch(() => {
                    Swal.fire('Error', 'Ocurrió un error inesperado al eliminar el turno.', 'error');
                });
            }
        });
    }

    // Funciones auxiliares para mostrar errores en edición
    function mostrarAlertaEditar(msg) {
        document.getElementById('textoAlertEditar').textContent = msg;
        document.getElementById('alertEditarCronograma').classList.remove('d-none');
    }

    // Ocultar alerta de errores en edición
    function ocultarAlertaEditar() {
        document.getElementById('alertEditarCronograma').classList.add('d-none');
    }

    // Destruir select2 al cerrar el modal completo para evitar duplicaciones
    document.getElementById('modalEditEliminarCronograma').addEventListener('hidden.bs.modal', function () {
        destruirSelect2Edicion();
    });
</script>
