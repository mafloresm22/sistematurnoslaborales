<div class="modal fade" id="modalCreateTurno" tabindex="-1" aria-labelledby="modalCreateTurnoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary">
                <h5 class="modal-title fw-bold" id="modalCreateTurnoLabel" style="color:white">
                    <i class="bi bi-clock-history me-2"></i>Crear Nuevo Turno
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('turnos.store') }}" method="POST" id="formCrearTurno">
                @csrf
                <div class="modal-body p-4">
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="nombreTurnosSelect" class="form-label fw-semibold">
                                Nombre del Turno <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-tag"></i></span>
                                <select class="form-select @error('nombreTurnos') is-invalid @enderror" id="nombreTurnosSelect" name="nombreTurnos" required>
                                    <option value="" selected disabled>Selecciona un turno...</option>
                                    <option value="Turno Mañana">Turno Mañana</option>
                                    <option value="Turno Tarde">Turno Tarde</option>
                                    <option value="Turno Noche">Turno Noche</option>
                                    <option value="Otro">Otro...</option>
                                </select>
                                <input type="text" class="form-control d-none @error('nombreTurnos') is-invalid @enderror" 
                                       id="nombreTurnosInput" placeholder="Especifique el nombre del turno">
                                <button type="button" class="btn btn-outline-secondary d-none" id="btnCancelarOtro" title="Volver a la lista">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                            @error('nombreTurnos')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="categoriaid" class="form-label fw-semibold">
                                Categoría <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-folder"></i></span>
                                <select class="form-select @error('categoriaid') is-invalid @enderror" id="categoriaid" name="categoriaid" required>
                                    <option value="" selected disabled>Selecciona una categoría...</option>
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
                            <label for="horaInicio" class="form-label fw-semibold">
                                Hora de Inicio <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-clock"></i></span>
                                <input type="text" class="form-control timepicker @error('horaInicio') is-invalid @enderror" 
                                       id="horaInicio" name="horaInicio" placeholder="HH:MM (Ej: 08:00)" required readonly>
                            </div>
                            @error('horaInicio')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="horaFin" class="form-label fw-semibold">
                                Hora de Fin <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-clock-fill"></i></span>
                                <input type="text" class="form-control timepicker @error('horaFin') is-invalid @enderror" 
                                       id="horaFin" name="horaFin" placeholder="HH:MM (Ej: 16:00)" required readonly>
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
                            <!-- Marcas divisorias -->
                            <div style="position: absolute; left: 16.66%; width: 1px; height: 100%; background: rgba(0,0,0,0.1); z-index: 1;"></div>
                            <div style="position: absolute; left: 33.33%; width: 1px; height: 100%; background: rgba(0,0,0,0.1); z-index: 1;"></div>
                            <div style="position: absolute; left: 50%; width: 1px; height: 100%; background: rgba(0,0,0,0.1); z-index: 1;"></div>
                            <div style="position: absolute; left: 66.66%; width: 1px; height: 100%; background: rgba(0,0,0,0.1); z-index: 1;"></div>
                            <div style="position: absolute; left: 83.33%; width: 1px; height: 100%; background: rgba(0,0,0,0.1); z-index: 1;"></div>

                            <!-- Barras de tiempo -->
                            <div id="timelineBar1" class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="position: absolute; height: 100%; left: 0%; width: 0%; z-index: 2; transition: all 0.3s ease;"></div>
                            <div id="timelineBar2" class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="position: absolute; height: 100%; left: 0%; width: 0%; z-index: 2; display: none; transition: all 0.3s ease;"></div>
                        </div>
                        <div class="text-center mt-3 text-secondary">
                            <span id="duracionTurno" class="badge bg-secondary px-3 py-2" style="font-size: 0.85rem;">
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
                            <label for="colorFondo" class="form-label fw-semibold">Color de Fondo</label>
                            <div class="input-group">
                                <input type="color" class="form-control form-control-color w-100" 
                                       id="colorFondo" name="colorFondo" value="#0d6efd" title="Elige color de fondo" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="colorTexto" class="form-label fw-semibold">Color del Texto</label>
                            <div class="input-group">
                                <input type="color" class="form-control form-control-color w-100" 
                                       id="colorTexto" name="colorTexto" value="#ffffff" title="Elige color del texto" required>
                            </div>
                        </div>

                        <div class="col-md-4 text-center">
                            <label class="form-label fw-semibold d-block">Vista Previa</label>
                            <span id="previewBadge" class="badge px-3 py-2 rounded-pill shadow-sm fs-6" 
                                  style="background-color: #0d6efd; color: #ffffff; transition: all 0.2s ease;">
                                Ej. Turno Demo
                            </span>
                        </div>
                    </div>

                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary px-4 fw-semibold">Guardar Turno</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Variables para el cronograma
        const inputHoraInicio = document.getElementById('horaInicio');
        const inputHoraFin = document.getElementById('horaFin');
        const bar1 = document.getElementById('timelineBar1');
        const bar2 = document.getElementById('timelineBar2');
        const duracionTurno = document.getElementById('duracionTurno');

        function timeToMinutes(timeStr) {
            if (!timeStr) return 0;
            const [h, m] = timeStr.split(':').map(Number);
            return h * 60 + m;
        }

        function updateTimeline() {
            if (!inputHoraInicio.value || !inputHoraFin.value) return;

            const inicioMin = timeToMinutes(inputHoraInicio.value);
            const finMin = timeToMinutes(inputHoraFin.value);
            
            let leftPercent1 = 0, widthPercent1 = 0;
            let leftPercent2 = 0, widthPercent2 = 0;
            let duracion = 0;

            if (finMin < inicioMin) {
                // Cruza la medianoche (ej. 22:00 a 06:00)
                duracion = (24 * 60) - inicioMin + finMin;
                
                leftPercent1 = (inicioMin / (24 * 60)) * 100;
                widthPercent1 = 100 - leftPercent1;
                
                leftPercent2 = 0;
                widthPercent2 = (finMin / (24 * 60)) * 100;
                
                bar1.style.left = leftPercent1 + '%';
                bar1.style.width = widthPercent1 + '%';
                
                bar2.style.left = leftPercent2 + '%';
                bar2.style.width = widthPercent2 + '%';
                bar2.style.display = 'block';
            } else {
                // Turno normal en el mismo día
                duracion = finMin - inicioMin;
                leftPercent1 = (inicioMin / (24 * 60)) * 100;
                widthPercent1 = (duracion / (24 * 60)) * 100;
                
                bar1.style.left = leftPercent1 + '%';
                bar1.style.width = widthPercent1 + '%';
                
                bar2.style.display = 'none';
            }
            
            const horas = Math.floor(duracion / 60);
            const mins = duracion % 60;
            
            // Actualizar badge de duración
            duracionTurno.innerHTML = `<i class="bi bi-clock-history me-1"></i> <strong>Duración:</strong> ${horas}h ${mins > 0 ? mins + 'm' : ''}`;
            duracionTurno.classList.remove('bg-secondary');
            duracionTurno.classList.add('bg-success');
        }

        // 1. Inicializar el selector de hora
        flatpickr(".timepicker", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            minuteIncrement: 15,
            onChange: function(selectedDates, dateStr, instance) {
                updateTimeline();
            }
        });

        // 2. Controladores para la Vista Previa Dinámica de Colores
        const inputColorFondo = document.getElementById('colorFondo');
        const inputColorTexto = document.getElementById('colorTexto');
        const previewBadge = document.getElementById('previewBadge');

        function actualizarVistaPrevia() {
            if(previewBadge && inputColorFondo && inputColorTexto) {
                previewBadge.style.backgroundColor = inputColorFondo.value;
                previewBadge.style.color = inputColorTexto.value;
            }
            
            // Actualizar colores del cronograma también
            if(bar1 && inputColorFondo) {
                bar1.classList.remove('bg-primary');
                bar1.style.backgroundColor = inputColorFondo.value;
            }
            if(bar2 && inputColorFondo) {
                bar2.classList.remove('bg-primary');
                bar2.style.backgroundColor = inputColorFondo.value;
            }
        }

        if(inputColorFondo) inputColorFondo.addEventListener('input', actualizarVistaPrevia);
        if(inputColorTexto) inputColorTexto.addEventListener('input', actualizarVistaPrevia);

        // 3. Control del Selector "Nombre del Turno"
        const selectTurno = document.getElementById('nombreTurnosSelect');
        const inputTurno = document.getElementById('nombreTurnosInput');
        const btnCancelarOtro = document.getElementById('btnCancelarOtro');
        
        function actualizarTextoVistaPrevia() {
            if (!previewBadge) return;
            
            let texto = 'Ej. Turno Demo';
            if (selectTurno && !selectTurno.classList.contains('d-none')) {
                if (selectTurno.value && selectTurno.value !== 'Otro') {
                    texto = selectTurno.value;
                }
            } else if (inputTurno && !inputTurno.classList.contains('d-none')) {
                if (inputTurno.value.trim() !== '') {
                    texto = inputTurno.value;
                }
            }
            
            previewBadge.textContent = texto;
        }

        if(selectTurno) selectTurno.addEventListener('change', actualizarTextoVistaPrevia);
        if(inputTurno) inputTurno.addEventListener('input', actualizarTextoVistaPrevia);

        if(selectTurno && inputTurno && btnCancelarOtro) {
            selectTurno.addEventListener('change', function() {
                if (this.value === 'Otro') {
                    selectTurno.classList.add('d-none');
                    inputTurno.classList.remove('d-none');
                    btnCancelarOtro.classList.remove('d-none');
                    
                    inputTurno.name = 'nombreTurnos';
                    selectTurno.removeAttribute('name');
                    
                    inputTurno.required = true;
                    selectTurno.required = false;
                    
                    inputTurno.focus();
                }
            });

            btnCancelarOtro.addEventListener('click', function() {
                inputTurno.classList.add('d-none');
                btnCancelarOtro.classList.add('d-none');
                selectTurno.classList.remove('d-none');
                
                selectTurno.name = 'nombreTurnos';
                inputTurno.removeAttribute('name');
                
                selectTurno.required = true;
                inputTurno.required = false;
                
                selectTurno.value = '';
                inputTurno.value = '';
                actualizarTextoVistaPrevia();
            });
        }

        // 4. Limpiar los campos
        const modalCreateTurno = document.getElementById('modalCreateTurno');
        if(modalCreateTurno) {
            modalCreateTurno.addEventListener('hidden.bs.modal', function () {
                // Resetear el formulario principal
                const form = document.getElementById('formCrearTurno');
                if (form) {
                    form.reset();
                    const invalidInputs = form.querySelectorAll('.is-invalid');
                    invalidInputs.forEach(input => input.classList.remove('is-invalid'));
                }
                
                // Restablecer colores a default y actualizar la vista
                if(inputColorFondo) inputColorFondo.value = '#0d6efd';
                if(inputColorTexto) inputColorTexto.value = '#ffffff';
                if(previewBadge) previewBadge.textContent = 'Ej. Turno Demo';
                actualizarVistaPrevia();
                
                // Limpiar el cronograma
                if (bar1) bar1.style.width = '0%';
                if (bar2) {
                    bar2.style.width = '0%';
                    bar2.style.display = 'none';
                }
                if (duracionTurno) {
                    duracionTurno.innerHTML = `<i class="bi bi-info-circle me-1"></i> Selecciona las horas para ver en el cronograma`;
                    duracionTurno.className = 'badge bg-secondary px-3 py-2';
                }

                // Limpiar inputs flatpickr a través de su API
                if(inputHoraInicio && inputHoraInicio._flatpickr) inputHoraInicio._flatpickr.clear();
                if(inputHoraFin && inputHoraFin._flatpickr) inputHoraFin._flatpickr.clear();

                // Resetear el input "Otro"
                if(selectTurno && inputTurno && btnCancelarOtro) {
                    inputTurno.classList.add('d-none');
                    btnCancelarOtro.classList.add('d-none');
                    selectTurno.classList.remove('d-none');
                    
                    selectTurno.name = 'nombreTurnos';
                    inputTurno.removeAttribute('name');
                    
                    selectTurno.required = true;
                    inputTurno.required = false;
                }
            });
        }
    });
</script>