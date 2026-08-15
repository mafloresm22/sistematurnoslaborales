<div class="modal fade" id="modalMostrarEmpleados" tabindex="-1" aria-labelledby="modalMostrarEmpleadosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 bg-transparent">
            
            <div class="dni-card shadow-lg rounded-4 overflow-hidden position-relative bg-white text-dark border">
                <div class="dni-header bg-primary text-white p-3 d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-light opacity-75 fs-7">SISTEMA DE CONTROL DE EMPLEADOS</small>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="dni-body p-4">
                    <div class="row align-items-center">
                        
                        <div class="col-4 text-center border-end pe-4">
                            <div class="dni-avatar-wrapper position-relative mb-3">
                                <img id="dniAvatar" src="" alt="Foto Empleado" 
                                     class="img-fluid rounded-3 border-2 border-secondary shadow-sm object-fit-cover" 
                                     style="width: 120px; height: 140px;">
                            </div>
                            <span class="badge bg-success w-100 py-2 fs-7" id="dniEstado">ACTIVO</span>
                        </div>

                        <div class="col-8 ps-4">
                            <div class="mb-3">
                                <span class="text-muted text-uppercase fw-bold d-block fs-7 mb-1" id="dniLabelTipo">N° Documento</span>
                                <span class="fs-4 fw-bolder text-primary tracking-wide" id="dniNumeroDocumento">---</span>
                            </div>

                            <div class="row gy-3 gx-2">
                                <div class="col-12">
                                    <span class="text-muted text-uppercase fw-bold d-block fs-7 mb-1">Apellidos</span>
                                    <span class="fw-bold text-uppercase fs-6 text-dark" id="dniApellidos">---</span>
                                </div>
                                
                                <div class="col-12">
                                    <span class="text-muted text-uppercase fw-bold d-block fs-7 mb-1">Nombres</span>
                                    <span class="fw-bold text-uppercase fs-6 text-dark" id="dniNombres">---</span>
                                </div>

                                <div class="col-6">
                                    <span class="text-muted text-uppercase fw-bold d-block fs-7 mb-1">Sexo</span>
                                    <span class="fw-semibold text-capitalize fs-6" id="dniSexo">---</span>
                                </div>

                                <div class="col-6">
                                    <span class="text-muted text-uppercase fw-bold d-block fs-7 mb-1">F. Nacimiento</span>
                                    <span class="fw-semibold fs-6" id="dniFechaNac">---</span>
                                </div>

                                <div class="col-12 mt-3">
                                    <span class="text-muted text-uppercase fw-bold d-block fs-7 mb-1">Profesion / Cargo</span>
                                    <span class="fw-semibold text-primary fs-6" id="dniProfesion">---</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 text-secondary opacity-25">

                    <div class="row gy-3 gx-2 fs-7">
                        <div class="col-5">
                            <i class="bi bi-telephone-fill text-muted me-1"></i>
                            <span class="fw-semibold" id="dniTelefono">---</span>
                        </div>
                        <div class="col-7">
                            <i class="bi bi-envelope-fill text-muted me-1"></i>
                            <span class="fw-semibold text-truncate d-inline-block mw-100 align-bottom" id="dniCorreo">---</span>
                        </div>
                        <div class="col-12">
                            <i class="bi bi-geo-alt-fill text-muted me-2"></i>
                            <span class="fw-semibold" id="dniDireccion">---</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>