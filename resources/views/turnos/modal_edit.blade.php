<div class="modal fade" id="modalEditTurno" tabindex="-1" aria-labelledby="modalEditTurnoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-warning">
                <h5 class="modal-title fw-bold" id="modalEditTurnoLabel" style="color: #FFFFFF">
                    <i class="bi bi-pencil-square me-2"></i>Editar Turno
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="" method="POST" id="formEditarTurno">
                @csrf
                @method('PUT')
                
                <input type="hidden" id="turno_idEdit" name="idTurno">

                <div class="modal-body p-4">

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="nombreTurnosSelectEdit" class="form-label fw-semibold">
                                Nombre del Turno <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-tag"></i></span>
                                <select class="form-select @error('nombreTurnos') is-invalid @enderror" id="nombreTurnosSelectEdit" name="nombreTurnos" required>
                                    <option value="" disabled>Selecciona un turno...</option>
                                    <option value="Turno Mañana">Turno Mañana</option>
                                    <option value="Turno Tarde">Turno Tarde</option>
                                    <option value="Turno Noche">Turno Noche</option>
                                    <option value="Otro">Otro...</option>
                                </select>
                                <input type="text" class="form-control d-none @error('nombreTurnos') is-invalid @enderror" 
                                       id="nombreTurnosInputEdit" placeholder="Especifique el nombre del turno">
                                <button type="button" class="btn btn-outline-secondary d-none" id="btnCancelarOtroEdit" title="Volver a la lista">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                            @error('nombreTurnos')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="categoriaidEdit" class="form-label fw-semibold">
                                Categoría <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-folder"></i></span>
                                <select class="form-select @error('categoriaid') is-invalid @enderror" id="categoriaidEdit" name="categoriaid" required>
                                    <option value="" disabled>Selecciona una categoría...</option>
                                    @foreach($listaCategorias ?? [] as $categoria)
                                        <option value="{{ $categoria->idCategorias }}">
                                            {{ $categoria->nombreCategorias }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('categoriaid')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4 text-muted opacity-25">

                    <h6 class="fw-bold mb-3 text-secondary">
                        <i class="bi bi-alarm me-1"></i> Horario del Turno
                    </h6>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="horaInicioEdit" class="form-label fw-semibold">
                                Hora de Inicio <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-clock"></i></span>
                                <input type="text" class="form-control timepicker-edit @error('horaInicio') is-invalid @enderror" 
                                       id="horaInicioEdit" name="horaInicio" placeholder="HH:MM (Ej: 08:00)" required readonly>
                            </div>
                            @error('horaInicio')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="horaFinEdit" class="form-label fw-semibold">
                                Hora de Fin <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-clock-fill"></i></span>
                                <input type="text" class="form-control timepicker-edit @error('horaFin') is-invalid @enderror" 
                                       id="horaFinEdit" name="horaFin" placeholder="HH:MM (Ej: 16:00)" required readonly>
                            </div>
                            @error('horaFin')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="timeline-container mt-4 mb-2 p-3 bg-light rounded border">
                        <h6 class="fw-bold mb-3 text-secondary text-center" style="font-size: 0.9rem;">
                            <i class="bi bi-calendar-range me-1"></i> Cronograma Visual del Turno
                        </h6>
                        <div class="d-flex justify-content-between align-items-end text-muted mb-2" style="font-size: 0.75rem; position: relative;">
                            <span>00:00</span>
                            <span>04:00</span>
                            <span>08:00</span>
                            <span>12:00</span>
                            <span>16:00</span>
                            <span>20:00</span>
                            <span>24:00</span>
                        </div>
                        <div class="progress" style="height: 24px; background-color: #e9ecef; position: relative; overflow: hidden; border-radius: 6px;">
                            <div style="position: absolute; left: 16.66%; width: 1px; height: 100%; background: rgba(0,0,0,0.1); z-index: 1;"></div>
                            <div style="position: absolute; left: 33.33%; width: 1px; height: 100%; background: rgba(0,0,0,0.1); z-index: 1;"></div>
                            <div style="position: absolute; left: 50%; width: 1px; height: 100%; background: rgba(0,0,0,0.1); z-index: 1;"></div>
                            <div style="position: absolute; left: 66.66%; width: 1px; height: 100%; background: rgba(0,0,0,0.1); z-index: 1;"></div>
                            <div style="position: absolute; left: 83.33%; width: 1px; height: 100%; background: rgba(0,0,0,0.1); z-index: 1;"></div>

                            <div id="timelineBar1Edit" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="position: absolute; height: 100%; left: 0%; width: 0%; z-index: 2; transition: all 0.3s ease;"></div>
                            <div id="timelineBar2Edit" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="position: absolute; height: 100%; left: 0%; width: 0%; z-index: 2; display: none; transition: all 0.3s ease;"></div>
                        </div>
                        <div class="text-center mt-3 text-secondary">
                            <span id="duracionTurnoEdit" class="badge bg-secondary px-3 py-2" style="font-size: 0.85rem;">
                                <i class="bi bi-info-circle me-1"></i> Selecciona las horas para ver en el cronograma
                            </span>
                        </div>
                    </div>

                    <hr class="my-4 text-muted opacity-25">

                    <h6 class="fw-bold mb-3 text-secondary">
                        <i class="bi bi-palette me-1"></i> Personalización de Estilo
                    </h6>

                    <div class="row g-3 align-items-center">
                        <div class="col-md-4">
                            <label for="colorFondoEdit" class="form-label fw-semibold">Color de Fondo</label>
                            <div class="input-group">
                                <input type="color" class="form-control form-control-color w-100" 
                                       id="colorFondoEdit" name="colorFondo" value="#0d6efd" title="Elige color de fondo" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="colorTextoEdit" class="form-label fw-semibold">Color del Texto</label>
                            <div class="input-group">
                                <input type="color" class="form-control form-control-color w-100" 
                                       id="colorTextoEdit" name="colorTexto" value="#ffffff" title="Elige color del texto" required>
                            </div>
                        </div>

                        <div class="col-md-4 text-center">
                            <label class="form-label fw-semibold d-block">Vista Previa</label>
                            <span id="previewBadgeEdit" class="badge px-3 py-2 rounded-pill shadow-sm fs-6" 
                                  style="background-color: #0d6efd; color: #ffffff; transition: all 0.2s ease;">
                                Ej. Turno Demo
                            </span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Actualizar Turno</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const formEditarTurno = document.getElementById('formEditarTurno');
        const inputHoraInicioEdit = document.getElementById('horaInicioEdit');
        const inputHoraFinEdit = document.getElementById('horaFinEdit');
        const bar1Edit = document.getElementById('timelineBar1Edit');
        const bar2Edit = document.getElementById('timelineBar2Edit');
        const duracionTurnoEdit = document.getElementById('duracionTurnoEdit');

        const inputColorFondoEdit = document.getElementById('colorFondoEdit');
        const inputColorTextoEdit = document.getElementById('colorTextoEdit');
        const previewBadgeEdit = document.getElementById('previewBadgeEdit');

        const selectTurnoEdit = document.getElementById('nombreTurnosSelectEdit');
        const inputTurnoEdit = document.getElementById('nombreTurnosInputEdit');
        const btnCancelarOtroEdit = document.getElementById('btnCancelarOtroEdit');

        function timeToMinutes(timeStr) {
            if (!timeStr) return 0;
            const parts = timeStr.split(':');
            return parseInt(parts[0], 10) * 60 + parseInt(parts[1], 10);
        }

        // Actualización del cronograma
        function updateTimelineEdit() {
            if (!inputHoraInicioEdit.value || !inputHoraFinEdit.value) return;

            const inicioMin = timeToMinutes(inputHoraInicioEdit.value);
            const finMin = timeToMinutes(inputHoraFinEdit.value);

            let leftPercent1 = 0, widthPercent1 = 0;
            let leftPercent2 = 0, widthPercent2 = 0;
            let duracion = 0;

            if (finMin < inicioMin) {
                duracion = (24 * 60) - inicioMin + finMin;

                leftPercent1 = (inicioMin / (24 * 60)) * 100;
                widthPercent1 = 100 - leftPercent1;

                leftPercent2 = 0;
                widthPercent2 = (finMin / (24 * 60)) * 100;

                bar1Edit.style.left = leftPercent1 + '%';
                bar1Edit.style.width = widthPercent1 + '%';

                bar2Edit.style.left = leftPercent2 + '%';
                bar2Edit.style.width = widthPercent2 + '%';
                bar2Edit.style.display = 'block';
            } else {
                duracion = finMin - inicioMin;
                leftPercent1 = (inicioMin / (24 * 60)) * 100;
                widthPercent1 = (duracion / (24 * 60)) * 100;

                bar1Edit.style.left = leftPercent1 + '%';
                bar1Edit.style.width = widthPercent1 + '%';

                bar2Edit.style.display = 'none';
            }

            const horas = Math.floor(duracion / 60);
            const mins = duracion % 60;

            duracionTurnoEdit.innerHTML = `<i class="bi bi-clock-history me-1"></i> <strong>Duración:</strong> ${horas}h ${mins > 0 ? mins + 'm' : ''}`;
            duracionTurnoEdit.className = 'badge bg-success px-3 py-2';
        }

        // Inicialización de Flatpickr para edición
        flatpickr(".timepicker-edit", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            minuteIncrement: 15,
            onChange: function() {
                updateTimelineEdit();
            }
        });

        // Actualización de colores
        function actualizarVistaPreviaEdit() {
            if(previewBadgeEdit && inputColorFondoEdit && inputColorTextoEdit) {
                previewBadgeEdit.style.backgroundColor = inputColorFondoEdit.value;
                previewBadgeEdit.style.color = inputColorTextoEdit.value;
            }

            if(bar1Edit && inputColorFondoEdit) {
                bar1Edit.style.backgroundColor = inputColorFondoEdit.value;
            }
            if(bar2Edit && inputColorFondoEdit) {
                bar2Edit.style.backgroundColor = inputColorFondoEdit.value;
            }
        }

        if(inputColorFondoEdit) inputColorFondoEdit.addEventListener('input', actualizarVistaPreviaEdit);
        if(inputColorTextoEdit) inputColorTextoEdit.addEventListener('input', actualizarVistaPreviaEdit);

        // Control del nombre del turno
        function actualizarTextoVistaPreviaEdit() {
            if (!previewBadgeEdit) return;

            let texto = 'Ej. Turno Demo';
            if (selectTurnoEdit && !selectTurnoEdit.classList.contains('d-none')) {
                if (selectTurnoEdit.value && selectTurnoEdit.value !== 'Otro') {
                    texto = selectTurnoEdit.value;
                }
            } else if (inputTurnoEdit && !inputTurnoEdit.classList.contains('d-none')) {
                if (inputTurnoEdit.value.trim() !== '') {
                    texto = inputTurnoEdit.value;
                }
            }
            previewBadgeEdit.textContent = texto;
        }

        if(selectTurnoEdit) selectTurnoEdit.addEventListener('change', actualizarTextoVistaPreviaEdit);
        if(inputTurnoEdit) inputTurnoEdit.addEventListener('input', actualizarTextoVistaPreviaEdit);

        if(selectTurnoEdit && inputTurnoEdit && btnCancelarOtroEdit) {
            selectTurnoEdit.addEventListener('change', function() {
                if (this.value === 'Otro') {
                    selectTurnoEdit.classList.add('d-none');
                    inputTurnoEdit.classList.remove('d-none');
                    btnCancelarOtroEdit.classList.remove('d-none');

                    inputTurnoEdit.name = 'nombreTurnos';
                    selectTurnoEdit.removeAttribute('name');

                    inputTurnoEdit.required = true;
                    selectTurnoEdit.required = false;

                    inputTurnoEdit.focus();
                }
            });

            btnCancelarOtroEdit.addEventListener('click', function() {
                inputTurnoEdit.classList.add('d-none');
                btnCancelarOtroEdit.classList.add('d-none');
                selectTurnoEdit.classList.remove('d-none');

                selectTurnoEdit.name = 'nombreTurnos';
                inputTurnoEdit.removeAttribute('name');

                selectTurnoEdit.required = true;
                inputTurnoEdit.required = false;

                selectTurnoEdit.value = '';
                inputTurnoEdit.value = '';
                actualizarTextoVistaPreviaEdit();
            });
        }

        // FUNCIÓN GLOBAL PARA ABRIR Y LLENAR EL MODAL
        window.abrirModalEditarTurno = function(turno) {
            // 1. Establecer Action del formulario
            formEditarTurno.action = `/turnos/${turno.idTurno}`;
            document.getElementById('turno_idEdit').value = turno.idTurno;

            // 2. Cargar Nombre del Turno
            const opcionesEstandar = ['Turno Mañana', 'Turno Tarde', 'Turno Noche'];
            if (opcionesEstandar.includes(turno.nombreTurnos)) {
                selectTurnoEdit.classList.remove('d-none');
                inputTurnoEdit.classList.add('d-none');
                btnCancelarOtroEdit.classList.add('d-none');

                selectTurnoEdit.name = 'nombreTurnos';
                inputTurnoEdit.removeAttribute('name');

                selectTurnoEdit.value = turno.nombreTurnos;
                inputTurnoEdit.value = '';
            } else {
                selectTurnoEdit.classList.add('d-none');
                inputTurnoEdit.classList.remove('d-none');
                btnCancelarOtroEdit.classList.remove('d-none');

                inputTurnoEdit.name = 'nombreTurnos';
                selectTurnoEdit.removeAttribute('name');

                selectTurnoEdit.value = 'Otro';
                inputTurnoEdit.value = turno.nombreTurnos;
            }

            // 3. Cargar Categoría
            document.getElementById('categoriaidEdit').value = turno.categoriaid;

            // 4. Cargar Horarios y Flatpickr
            // Recorta segundos si provienen de MySQL (e.g. "08:00:00" -> "08:00")
            const horaInicioClean = turno.horaInicio ? turno.horaInicio.substring(0, 5) : '';
            const horaFinClean = turno.horaFin ? turno.horaFin.substring(0, 5) : '';

            if (inputHoraInicioEdit._flatpickr) inputHoraInicioEdit._flatpickr.setDate(horaInicioClean);
            if (inputHoraFinEdit._flatpickr) inputHoraFinEdit._flatpickr.setDate(horaFinClean);

            inputHoraInicioEdit.value = horaInicioClean;
            inputHoraFinEdit.value = horaFinClean;

            // 5. Cargar Colores
            inputColorFondoEdit.value = turno.colorFondo || '#0d6efd';
            inputColorTextoEdit.value = turno.colorTexto || '#ffffff';

            // 6. Actualizar Vista Previa y Cronograma
            actualizarVistaPreviaEdit();
            actualizarTextoVistaPreviaEdit();
            updateTimelineEdit();

            // 7. Mostrar el Modal
            const modalInstance = new bootstrap.Modal(document.getElementById('modalEditTurno'));
            modalInstance.show();
        };
    });
</script>