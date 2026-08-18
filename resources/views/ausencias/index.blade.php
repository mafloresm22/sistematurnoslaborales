<x-app-layout :assets="$assets ?? []">
    {{-- Tarjetas Estadísticas Superiores --}}
    <div class="row mb-4">
        {{-- Card 1: Ausencias para el día de hoy --}}
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="card border-0 shadow-sm border-left-primary h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bolder text-white text-uppercase mb-1">
                                Ausencias Hoy
                            </div>
                            <div class="h2 mb-0 font-weight-bold text-white">
                                {{ $ausenciasHoy ?? 0 }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-shape bg-primary-subtle text-white rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-calendar-check fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 2: Ausencias Pendientes de Aprobación --}}
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="card border-0 shadow-sm border-left-warning h-100 py-2 bg-warning">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bolder text-white text-uppercase mb-1">
                                Pendientes de Revisión
                            </div>
                            <div class="h2 mb-0 font-weight-bold text-white">
                                {{ $ausenciasPendientes ?? 0 }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-shape bg-warning-subtle text-white rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-clock-history fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 3: Total de Ausencias Registradas --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm border-left-success h-100 py-2 bg-success">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bolder text-white text-uppercase mb-1">
                                Total de Ausencias
                            </div>
                            <div class="h2 mb-0 font-weight-bold text-white">
                                {{ $totalAusencias ?? $ausencias->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-shape bg-success-subtle text-white rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-people fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Fin de Tarjetas Estadísticas --}}

    <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
               <div class="header-title">
                  <h4 class="card-title fw-bold mb-0">
                     <i class="bi bi-clock-history me-2 text-primary"></i>Listado de Ausencias
                  </h4>
               </div>
               <button class="btn btn-primary shadow-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCreateAusencia" aria-controls="offcanvasCreateAusencia">
                   <i class="bi bi-plus-circle me-1"></i> Nueva Ausencia
               </button>
            </div>
            <div class="card-body px-0">

               {{-- Mensajes de éxito / error --}}
               @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                     {{ session('success') }}
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                  </div>
               @endif
               @if(session('error'))
                  <div class="alert alert-danger alert-dismissible fade show mx-3" role="alert">
                     {{ session('error') }}
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                  </div>
               @endif

               <div class="table-responsive">
                  <table id="tabla-ausencias" class="table table-striped" role="grid">
                     <thead>
                        <tr class="ligth">
                           <th>Empleado</th>
                           <th>Tipo de Ausencia</th>
                           <th>Desde y Hasta</th>
                           <th>Días</th>
                           <th>Estado</th>
                           <th style="min-width: 120px">Acciones</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($ausencias as $ausencia)
                           <tr>
                              <td>
                                 @if($ausencia->empleado)
                                    {{ $ausencia->empleado->nombreEmpleados }} {{ $ausencia->empleado->apellidoEmpleados }}
                                 @else
                                    <span class="text-muted">No asignado</span>
                                 @endif
                              </td>
                              <td>{{ $ausencia->tipoAusencias }}</td>
                              <td>
                                 {{ optional($ausencia->fechaInicio)->format('d-m-Y') }} - {{ optional($ausencia->fechaFin)->format('d-m-Y') }}
                              </td>
                              <td>{{ $ausencia->diasAusencias }}</td>
                              <td>
                                 <span class="badge bg-{{ $ausencia->estadoAusencias == 'Aprobado' ? 'success' : ($ausencia->estadoAusencias == 'Rechazado' ? 'danger' : 'warning') }}">
                                    {{ $ausencia->estadoAusencias }}
                                 </span>
                              </td>
                              <td>
                                 <div class="d-flex align-items-center gap-2">
                                    {{-- Ver Documento Adjunto / Detalles --}}
                                    <button type="button" class="btn btn-sm btn-icon btn-success btn-mostrar" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalDocumentoAdjunto" 
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="Ver Documento Adjunto"
                                        data-id-ausencia="{{ $ausencia->idAusencias }}"
                                        data-nombre="{{ optional($ausencia->empleado)->nombreEmpleados }}"
                                        data-apellido="{{ optional($ausencia->empleado)->apellidoEmpleados }}"
                                        data-tipo="{{ $ausencia->tipoAusencias }}"
                                        data-fechaini="{{ optional($ausencia->fechaInicio)->format('d-m-Y') }}"
                                        data-fechafin="{{ optional($ausencia->fechaFin)->format('d-m-Y') }}"
                                        data-dias="{{ $ausencia->diasAusencias }}"
                                        data-documento="{{ $ausencia->documentoAdjunto }}"
                                        data-observaciones="{{ $ausencia->observacionesAusencias }}"
                                        data-estado="{{ $ausencia->estadoAusencias }}"
                                        data-avatar="{{ optional($ausencia->empleado)->avatarEmpleados ? asset($ausencia->empleado->avatarEmpleados) : asset('images/avatars/Empleados.png') }}">
                                       <span class="btn-inner">
                                          <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M12 22C18.0625 22 22.625 17.4688 22.625 11.5C22.625 5.53125 18.0625 1 12 1C5.9375 1 1.375 5.53125 1.375 11.5C1.375 17.4688 5.9375 22 12 22Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                             <path d="M12 7.5C10.3438 7.5 9 8.84375 9 10.5C9 12.1562 10.3438 13.5 12 13.5C13.6562 13.5 15 12.1562 15 10.5C15 8.84375 13.6562 7.5 12 7.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                             <path d="M21.875 20.5C21.875 18.3438 19.6875 16.625 17 16.625H7C4.3125 16.625 2.125 18.3438 2.125 20.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          </svg>
                                       </span>
                                    </button>

                                    {{-- Editar Ausencia --}}
                                    <button type="button"
                                        class="btn btn-sm btn-icon btn-warning btn-editar"
                                        data-id-ausencia="{{ $ausencia->idAusencias }}"
                                        data-empleadoid="{{ $ausencia->empleadoid }}"
                                        data-tipo="{{ $ausencia->tipoAusencias }}"
                                        data-fechaini="{{ optional($ausencia->fechaInicio)->format('Y-m-d') }}"
                                        data-fechafin="{{ optional($ausencia->fechaFin)->format('Y-m-d') }}"
                                        data-estado="{{ $ausencia->estadoAusencias }}"
                                        data-observaciones="{{ $ausencia->observacionesAusencias }}"
                                        data-documento="{{ $ausencia->documentoAdjunto }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditAusencias"
                                        title="Editar Ausencia">
                                       <span class="btn-inner">
                                          <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                             <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                             <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          </svg>
                                       </span>
                                    </button>

                                    {{-- Eliminar Ausencia --}}
                                    <button type="button" 
                                       class="btn btn-sm btn-icon btn-danger btn-eliminar" 
                                       data-id-ausencia="{{ $ausencia->idAusencias }}"
                                       data-nombre="{{ optional($ausencia->empleado)->nombreEmpleados }} {{ optional($ausencia->empleado)->apellidoEmpleados }}"
                                       data-bs-toggle="modal" 
                                       data-bs-target="#modalEliminarAusencias" 
                                       title="Eliminar Ausencia">
                                       <span class="btn-inner">
                                          <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                             <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                             <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          </svg>
                                       </span>
                                    </button>
                                 </div>
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>

   {{-- Modales (Asegúrate de tener estos archivos creados o ajustados) --}}
   @include('ausencias.offcanvas_create')
   @include('ausencias.offcanvas_edit')
   @include('ausencias.modal_documentoAdjunto')
   @include('ausencias.modal_eliminar')

   @push('scripts')
    <script>
       // Inicializar DataTable en español
       $(document).ready(function() {
          $('#tabla-ausencias').DataTable({
             language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
             }
          });
       });

       // Mostrar datos en el modal de Ver Documento Adjunto / Detalles de Ausencia
       document.querySelectorAll('.btn-mostrar').forEach(function (btn) {
          btn.addEventListener('click', function () {
             const ds = this.dataset;

             if(document.getElementById('ausenciaAvatar')) {
                 document.getElementById('ausenciaAvatar').src = ds.avatar;
             }

             const lblEstado = document.getElementById('ausenciaEstado');
             if(lblEstado) {
                 lblEstado.textContent = ds.estado;
                 if(ds.estado === 'Aprobado') {
                     lblEstado.className = 'badge bg-success w-100';
                 } else if(ds.estado === 'Rechazado') {
                     lblEstado.className = 'badge bg-danger w-100';
                 } else {
                     lblEstado.className = 'badge bg-warning w-100';
                 }
             }

             if(document.getElementById('ausenciaEmpleadoNombre')) {
                 document.getElementById('ausenciaEmpleadoNombre').textContent = `${ds.nombre} ${ds.apellido}`;
             }
             if(document.getElementById('ausenciaTipo')) {
                 document.getElementById('ausenciaTipo').textContent = ds.tipo;
             }
             if(document.getElementById('ausenciaFechas')) {
                 document.getElementById('ausenciaFechas').textContent = `${ds.fechaini} al ${ds.fechafin}`;
             }
             if(document.getElementById('ausenciaDias')) {
                 document.getElementById('ausenciaDias').textContent = ds.dias + (ds.dias == 1 ? ' día' : ' días');
             }
             if(document.getElementById('ausenciaObservaciones')) {
                 document.getElementById('ausenciaObservaciones').textContent = ds.observaciones ? ds.observaciones : 'Ninguna';
             }

             const enlaceDoc = document.getElementById('ausenciaDocumentoLink');
             if(enlaceDoc) {
                 if(ds.documento) {
                     enlaceDoc.href = `{{ asset('storage') }}/${ds.documento}`;
                     enlaceDoc.style.display = 'inline-block';
                 } else {
                     enlaceDoc.style.display = 'none';
                 }
             }
          });
       });

       // Cargar datos en el modal de edición de Ausencias
       document.querySelectorAll('.btn-editar').forEach(function (btn) {
          btn.addEventListener('click', function () {
             const ds = this.dataset;
             const form = document.getElementById('formEditAusencias');

             if(form) {
                 form.action = `{{ url('ausencias') }}/${ds.idAusencia}`;
             }

             if(document.getElementById('edit_empleadoid')) {
                 document.getElementById('edit_empleadoid').value = ds.empleadoid;
             }
             if(document.getElementById('edit_tipoAusencias')) {
                 document.getElementById('edit_tipoAusencias').value = ds.tipo;
             }
             if(document.getElementById('edit_fechaInicio')) {
                 document.getElementById('edit_fechaInicio').value = ds.fechaini;
             }
             if(document.getElementById('edit_fechaFin')) {
                 document.getElementById('edit_fechaFin').value = ds.fechafin;
             }
             if(document.getElementById('edit_estadoAusencias')) {
                 document.getElementById('edit_estadoAusencias').value = ds.estado;
             }
             if(document.getElementById('edit_observacionesAusencias')) {
                 document.getElementById('edit_observacionesAusencias').value = ds.observaciones !== 'null' ? ds.observaciones : '';
             }
          });
       });

       // Configurar modal de Eliminar Ausencia
       document.querySelectorAll('.btn-eliminar').forEach(function (btn) {
          btn.addEventListener('click', function () {
             const ds = this.dataset;
             const form = document.getElementById('formEliminarAusencias');

             if(form) {
                 form.action = `{{ url('ausencias') }}/${ds.idAusencia}`;
             }
             if(document.getElementById('eliminar_nombreAusencia')) {
                 document.getElementById('eliminar_nombreAusencia').textContent = ds.nombre;
             }
          });
       });
    </script>
    @endpush
</x-app-layout>