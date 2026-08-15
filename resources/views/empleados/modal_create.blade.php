<div class="modal fade" id="modalCreateEmpleados" tabindex="-1" aria-labelledby="modalCreateEmpleadosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-3">
            <div class="modal-header bg-primary">
                <h5 class="modal-title fw-bold text-white" id="modalCreateEmpleadosLabel">
                    <i class="bi bi-person-plus-fill me-2"></i>Registrar Nuevo Empleado
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <form action="{{ route('empleados.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-12 text-center mb-3">
                            <label class="form-label fw-semibold d-block">Foto del Empleado <span class="text-danger">*</span></label>
                            <div class="position-relative d-inline-block">
                                <img id="avatarPreview" src="{{ asset('images/avatars/Empleados.png') }}" 
                                class="rounded-circle img-thumbnail shadow-sm" 
                                style="width: 130px; height: 130px; object-fit: cover; border: 3px solid #0d6efd;">
    
                                <label for="avatarEmpleados" class="btn btn-sm btn-primary rounded-circle position-absolute bottom-0 end-0 p-2 shadow" 
                                        title="Cambiar imagen" style="cursor: pointer;">
                                    <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.44 6.2364C17.48 6.30633 17.55 6.35627 17.64 6.35627C20.04 6.35627 22 8.3141 22 10.7114V16.6448C22 19.0422 20.04 21 17.64 21H6.36C3.95 21 2 19.0422 2 16.6448V10.7114C2 8.3141 3.95 6.35627 6.36 6.35627C6.44 6.35627 6.52 6.31632 6.55 6.2364L6.61 6.11654C6.64448 6.04397 6.67987 5.96943 6.71579 5.89376C6.97161 5.35492 7.25463 4.75879 7.43 4.40844C7.89 3.50943 8.67 3.00999 9.64 3H14.35C15.32 3.00999 16.11 3.50943 16.57 4.40844C16.7275 4.72308 16.9674 5.2299 17.1987 5.71839C17.2464 5.81921 17.2938 5.91924 17.34 6.01665L17.44 6.2364ZM16.71 10.0721C16.71 10.5716 17.11 10.9711 17.61 10.9711C18.11 10.9711 18.52 10.5716 18.52 10.0721C18.52 9.5727 18.11 9.16315 17.61 9.16315C17.11 9.16315 16.71 9.5727 16.71 10.0721ZM10.27 11.6204C10.74 11.1509 11.35 10.9012 12 10.9012C12.65 10.9012 13.26 11.1509 13.72 11.6104C14.18 12.0699 14.43 12.6792 14.43 13.3285C14.42 14.667 13.34 15.7558 12 15.7558C11.35 15.7558 10.74 15.5061 10.28 15.0466C9.82 14.5871 9.57 13.9778 9.57 13.3285V13.3185C9.56 12.6892 9.81 12.0799 10.27 11.6204ZM14.77 16.1054C14.06 16.8147 13.08 17.2542 12 17.2542C10.95 17.2542 9.97 16.8446 9.22 16.1054C8.48 15.3563 8.07 14.3774 8.07 13.3285C8.06 12.2897 8.47 11.3108 9.21 10.5616C9.96 9.81243 10.95 9.40289 12 9.40289C13.05 9.40289 14.04 9.81243 14.78 10.5516C15.52 11.3008 15.93 12.2897 15.93 13.3285C15.92 14.4173 15.48 15.3962 14.77 16.1054Z" fill="currentColor"></path>
                                    </svg>                        
                                </label>
                                <input type="file" class="d-none" id="avatarEmpleados" name="avatarEmpleados" required accept="image/*" onchange="previewImage(event)">
                            </div>
                            <div class="form-text mt-1">Haga clic en la cámara para subir una foto (JPG, PNG, WEBP).</div>
                        </div>

                        <hr class="my-2">

                        <div class="col-md-6">
                            <label for="nombreEmpleados" class="form-label fw-semibold">Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nombreEmpleados" name="nombreEmpleados" required maxlength="150">
                        </div>

                        <div class="col-md-6">
                            <label for="apellidoEmpleados" class="form-label fw-semibold">Apellido <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="apellidoEmpleados" name="apellidoEmpleados" required maxlength="150">
                        </div>

                        <div class="col-md-6">
                            <label for="tipodocumentoEmpleados" class="form-label fw-semibold">Tipo de Documento <span class="text-danger">*</span></label>

                            <div id="containerSelectDoc">
                                <select class="form-select" id="tipodocumentoEmpleados" name="tipodocumentoEmpleados" required onchange="checkTipoDoc(this)">
                                    <option value="" selected disabled>Seleccione una opción...</option>
                                    <option value="DNI">DNI</option>
                                    <option value="CI">CI</option>
                                    <option value="RUC">RUC</option>
                                    <option value="CE">CE</option>
                                    <option value="Pasaporte">Pasaporte</option>
                                    <option value="Otro">Otro...</option>
                                </select>
                            </div>

                            <div id="containerInputDoc" class="d-none">
                                <div class="input-group">
                                    <input type="text" class="form-control border-primary" id="otroTipoDocumento" name="tipodocumentoEmpleados_otro" placeholder="Escriba tipo de doc...">
                                    <button class="btn btn-outline-primary" type="button" onclick="cancelarOtroDoc()" title="Volver a la lista">
                                        <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                            
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C17.52 2 22 6.49 22 12L21.9962 12.2798C21.8478 17.6706 17.4264 22 12 22C6.49 22 2 17.52 2 12C2 6.49 6.49 2 12 2ZM8 13.98C8.3 14.27 8.77 14.27 9.06 13.97L12 11.02L14.94 13.97C15.23 14.27 15.71 14.27 16 13.98C16.3 13.68 16.3 13.21 16 12.92L12.53 9.43C12.39 9.29 12.2 9.21 12 9.21C11.8 9.21 11.61 9.29 11.47 9.43L8 12.92C7.85 13.06 7.78 13.25 7.78 13.44C7.78 13.64 7.85 13.83 8 13.98Z" fill="currentColor"></path>                            
                                        </svg>                        
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="numerodocumentoEmpleados" class="form-label fw-semibold">Número de Documento <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="numerodocumentoEmpleados" name="numerodocumentoEmpleados" required inputmode="numeric" maxlength="20" disabled>
                            <div class="form-text" id="docHelpText">Seleccione primero un tipo de documento.</div>
                        </div>

                        <div class="col-md-6">
                            <label for="telefonoEmpleados" class="form-label fw-semibold">Teléfono</label>
                            <input type="tel" class="form-control" id="telefonoEmpleados" name="telefonoEmpleados" inputmode="numeric" maxlength="9"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9)">
                        </div>

                        <div class="col-md-6">
                            <label for="fechanacimientoEmpleados" class="form-label fw-semibold">Fecha de Nacimiento <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="fechanacimientoEmpleados" name="fechanacimientoEmpleados" required>
                        </div>

                        <div class="col-md-6">
                            <label for="sexoEmpleados" class="form-label fw-semibold">Sexo <span class="text-danger">*</span></label>
                            <select class="form-select" id="sexoEmpleados" name="sexoEmpleados" required>
                                <option value="" selected disabled>Seleccione...</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otros">Otros</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="profesionEmpleados" class="form-label fw-semibold">Profesión / Cargo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="profesionEmpleados" name="profesionEmpleados" placeholder="Ej. Desarrollador" required maxlength="150">
                        </div>

                        <div class="col-md-6">
                            <label for="correoEmpleados" class="form-label fw-semibold">Correo Electrónico</label>
                            <input type="email" class="form-control" id="correoEmpleados" name="correoEmpleados" maxlength="150">
                        </div>

                        <div class="col-md-6">
                            <label for="direccionEmpleados" class="form-label fw-semibold">Dirección de Domicilio</label>
                            <input type="text" class="form-control" id="direccionEmpleados" name="direccionEmpleados" maxlength="150">
                        </div>

                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary px-4 fw-semibold">
                        <i class="bi bi-save me-1"></i> Guardar Empleado
                    </button>
                </div>
                
            </form>
        </div>
    </div>
</div>

<script>

    document.getElementById('modalCreateEmpleados').addEventListener('hidden.bs.modal', function () {
        this.querySelector('form').reset();
        document.getElementById('avatarPreview').src = "{{ asset('images/avatars/Empleados.png') }}";
        cancelarOtroDoc();
    });

    // Previsualización de Foto
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById('avatarPreview').src = reader.result;
        };
        if(event.target.files[0]){
            reader.readAsDataURL(event.target.files[0]);
        }
    }

    // Límites de caracteres según tipo de documento
    const limitesDoc = {
        'DNI':       { max: 8,  tipo: 'numeric',  texto: 'Exactamente 8 dígitos numéricos.' },
        'RUC':       { max: 11, tipo: 'numeric',  texto: 'Exactamente 11 dígitos numéricos.' },
        'CE':        { max: 12, tipo: 'text',     texto: 'Máximo 12 caracteres alfanuméricos.' },
        'Pasaporte': { max: 12, tipo: 'text',     texto: 'Máximo 12 caracteres alfanuméricos.' },
        'CI':        { max: 10, tipo: 'text',     texto: 'Máximo 10 caracteres alfanuméricos.' },
        'Otro':      { max: 20, tipo: 'text',     texto: 'Máximo 20 caracteres alfanuméricos.' }
    };

    function aplicarLimiteDoc(tipoDoc) {
        const input = document.getElementById('numerodocumentoEmpleados');
        const helpText = document.getElementById('docHelpText');
        const config = limitesDoc[tipoDoc] || limitesDoc['Otro'];

        input.maxLength = config.max;
        input.value = '';
        input.disabled = false;

        if (config.tipo === 'numeric') {
            input.inputMode = 'numeric';
            input.oninput = function() {
                this.value = this.value.replace(/[^0-9]/g, '').slice(0, config.max);
            };
        } else {
            input.inputMode = 'text';
            input.oninput = function() {
                this.value = this.value.replace(/[^a-zA-Z0-9]/g, '').slice(0, config.max);
            };
        }

        helpText.textContent = config.texto;
    }

    // Transición Select -> Input al elegir "Otro"
    function checkTipoDoc(select) {
        if (select.value === 'Otro') {
            document.getElementById('containerSelectDoc').classList.add('d-none');
            document.getElementById('containerInputDoc').classList.remove('d-none');
            
            select.disabled = true;
            const inputOtro = document.getElementById('otroTipoDocumento');
            inputOtro.required = true;
            inputOtro.focus();
        }

        // Aplicar límites según tipo seleccionado
        aplicarLimiteDoc(select.value);
    }

    // Volver al Select
    function cancelarOtroDoc() {
        document.getElementById('containerInputDoc').classList.add('d-none');
        document.getElementById('containerSelectDoc').classList.remove('d-none');
        
        const select = document.getElementById('tipodocumentoEmpleados');
        const inputOtro = document.getElementById('otroTipoDocumento');
        const inputDoc = document.getElementById('numerodocumentoEmpleados');
        
        select.disabled = false;
        select.value = '';
        inputOtro.required = false;
        inputOtro.value = '';

        inputDoc.value = '';
        inputDoc.disabled = true;
        inputDoc.maxLength = 20;
        inputDoc.oninput = null;
        document.getElementById('docHelpText').textContent = 'Seleccione primero un tipo de documento.';
    }
</script>