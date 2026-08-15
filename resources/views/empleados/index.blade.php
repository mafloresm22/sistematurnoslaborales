<x-app-layout :assets="$assets ?? []">
    <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
               <div class="header-title">
                  <h4 class="card-title">Empleados</h4>
               </div>
               <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreateEmpleados">
                  <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                     <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  Nuevo Empleado
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
                  <table id="tabla-empleados" class="table table-striped" role="grid">
                     <thead>
                        <tr class="ligth">
                           <th>#</th>
                           <th>Foto</th>
                           <th>Empleados</th>
                           <th>Número Documento</th>
                           <th>Profesión</th>
                           <th>Telefono</th>
                           <th>Estado</th>
                           <th style="min-width: 120px">Acciones</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($empleados as $empleado)
                           <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>
                              @if($empleado->avatarEmpleados)
                                 <img src="{{ $empleado->avatarEmpleados }}" class="avatar-sm rounded-circle" style="width: 40px; height: 40px; object-fit: cover;" alt="">
                              @else
                                 <div class="avatar-sm bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white">
                                    <span>{{ strtoupper(substr($empleado->nombreEmpleados, 0, 1)) }}</span>
                                 </div>
                              @endif
                              </td>
                              <td>{{ $empleado->nombreEmpleados }} {{ $empleado->apellidoEmpleados }}</td>
                              <td>{{ $empleado->tipodocumentoEmpleados }} - {{ $empleado->numerodocumentoEmpleados }}</td>
                              <td>{{ $empleado->profesionEmpleados }}</td>
                              <td>{{ $empleado->telefonoEmpleados }}</td>
                              <td>
                                 <span class="badge bg-{{ $empleado->estadoEmpleados == 'Activo' ? 'success' : ($empleado->estadoEmpleados == 'Inactivo' ? 'danger' : 'warning') }}">
                                    {{ $empleado->estadoEmpleados }}
                                 </span>
                              </td>
                              <td>
                                 <div class="d-flex align-items-center gap-2">
                                    {{-- Show --}}
                                    <button type="button" class="btn btn-sm btn-icon btn-success btn-mostrar" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalMostrarEmpleados" 
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="Ver Empleado"
                                        data-id-empleado="{{ $empleado->idEmpleados }}"
                                        data-nombre="{{ $empleado->nombreEmpleados }}"
                                        data-apellido="{{ $empleado->apellidoEmpleados }}"
                                        data-tipodoc="{{ $empleado->tipodocumentoEmpleados }}"
                                        data-numdoc="{{ $empleado->numerodocumentoEmpleados }}"
                                        data-telefono="{{ $empleado->telefonoEmpleados }}"
                                        data-fechanac="{{ $empleado->fechanacimientoEmpleados ? $empleado->fechanacimientoEmpleados->format('Y-m-d') : '' }}"
                                        data-sexo="{{ $empleado->sexoEmpleados }}"
                                        data-profesion="{{ $empleado->profesionEmpleados }}"
                                        data-correo="{{ $empleado->usuario ? $empleado->usuario->email : '' }}"
                                        data-direccion="{{ $empleado->direccionEmpleados }}"
                                        data-estado="{{ $empleado->estadoEmpleados }}"
                                        data-avatar="{{ $empleado->avatarEmpleados ? $empleado->avatarEmpleados : asset('images/avatars/Empleados.png') }}"
                                        data-usuarioid="{{ $empleado->usuarioid }}">
                                       <span class="btn-inner">
                                          <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M12 22C18.0625 22 22.625 17.4688 22.625 11.5C22.625 5.53125 18.0625 1 12 1C5.9375 1 1.375 5.53125 1.375 11.5C1.375 17.4688 5.9375 22 12 22Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                             <path d="M12 7.5C10.3438 7.5 9 8.84375 9 10.5C9 12.1562 10.3438 13.5 12 13.5C13.6562 13.5 15 12.1562 15 10.5C15 8.84375 13.6562 7.5 12 7.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                             <path d="M21.875 20.5C21.875 18.3438 19.6875 16.625 17 16.625H7C4.3125 16.625 2.125 18.3438 2.125 20.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          </svg>
                                       </span>
                                    </button>
                                    {{-- Editar --}}
                                     <button type="button"
                                        class="btn btn-sm btn-icon btn-warning btn-editar"
                                        data-id-empleado="{{ $empleado->idEmpleados }}"
                                        data-nombre="{{ $empleado->nombreEmpleados }}"
                                        data-apellido="{{ $empleado->apellidoEmpleados }}"
                                        data-tipodoc="{{ $empleado->tipodocumentoEmpleados }}"
                                        data-numdoc="{{ $empleado->numerodocumentoEmpleados }}"
                                        data-telefono="{{ $empleado->telefonoEmpleados }}"
                                        data-fechanac="{{ $empleado->fechanacimientoEmpleados ? $empleado->fechanacimientoEmpleados->format('Y-m-d') : '' }}"
                                        data-sexo="{{ $empleado->sexoEmpleados }}"
                                        data-profesion="{{ $empleado->profesionEmpleados }}"
                                        data-correo="{{ $empleado->usuario ? $empleado->usuario->email : '' }}"
                                        data-direccion="{{ $empleado->direccionEmpleados }}"
                                        data-estado="{{ $empleado->estadoEmpleados }}"
                                        data-avatar="{{ $empleado->avatarEmpleados ? $empleado->avatarEmpleados : asset('images/avatars/Empleados.png') }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditEmpleados"
                                        title="Editar"
                                        {{ in_array($empleado->estadoEmpleados, ['Inactivo', 'Suspendido']) ? 'disabled' : '' }}>
                                       <span class="btn-inner">
                                          <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                             <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                             <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          </svg>
                                       </span>
                                    </button>

                                    {{-- Eliminar / Cambiar Estado --}}
                                    <button type="button" 
                                       class="btn btn-sm btn-icon btn-danger btn-eliminar" 
                                       data-id-empleado="{{ $empleado->idEmpleados }}"
                                       data-nombre="{{ $empleado->nombreEmpleados }} {{ $empleado->apellidoEmpleados }}"
                                       data-estado="{{ $empleado->estadoEmpleados }}"
                                       data-bs-toggle="modal" 
                                       data-bs-target="#modalEliminarEmpleados" 
                                       title="Cambiar Estado">
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

   {{-- Modales --}}
   @include('empleados.modal_create')
   @include('empleados.modal_edit')
   @include('empleados.modal_eliminar')
   @include('empleados.index_show')

   @push('scripts')
    <script>
       // Inicializar DataTable en español
       $(document).ready(function() {
          $('#tabla-empleados').DataTable({
             language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
             }
          });
       });

       // Mostrar datos en el modal de Ver Empleado
       document.querySelectorAll('.btn-mostrar').forEach(function (btn) {
          btn.addEventListener('click', function () {
             const ds = this.dataset;
             
             document.getElementById('dniAvatar').src = ds.avatar;
             
             const dniEstado = document.getElementById('dniEstado');
             dniEstado.textContent = ds.estado;
             if(ds.estado === 'Activo') {
                 dniEstado.className = 'badge bg-success w-100';
             } else if(ds.estado === 'Inactivo') {
                 dniEstado.className = 'badge bg-danger w-100';
             } else {
                 dniEstado.className = 'badge bg-warning w-100';
             }

             document.getElementById('dniLabelTipo').textContent = ds.tipodoc;
             document.getElementById('dniNumeroDocumento').textContent = ds.numdoc;
             document.getElementById('dniApellidos').textContent = ds.apellido;
             document.getElementById('dniNombres').textContent = ds.nombre;
             document.getElementById('dniSexo').textContent = ds.sexo;
             document.getElementById('dniFechaNac').textContent = ds.fechanac;
             document.getElementById('dniProfesion').textContent = ds.profesion;
             document.getElementById('dniTelefono').textContent = ds.telefono !== 'Ninguno' ? ds.telefono : '---';
             document.getElementById('dniCorreo').textContent = ds.correo !== 'Ninguno' ? ds.correo : '---';
             document.getElementById('dniDireccion').textContent = ds.direccion !== 'Ninguno' ? ds.direccion : '---';
             document.getElementById('dniUsuarioId').textContent = ds.usuarioid;
          });
       });

       // Cargar datos en el modal de edicion
       document.querySelectorAll('.btn-editar').forEach(function (btn) {
          btn.addEventListener('click', function () {
             const ds = this.dataset;
             const form = document.getElementById('formEditEmpleados');

             form.action = `{{ url('empleados') }}/${ds.idEmpleado}`;
             
             document.getElementById('edit_nombreEmpleados').value = ds.nombre;
             document.getElementById('edit_apellidoEmpleados').value = ds.apellido;
             document.getElementById('edit_telefonoEmpleados').value = ds.telefono !== 'Ninguno' ? ds.telefono : '';
             document.getElementById('edit_fechanacimientoEmpleados').value = ds.fechanac;
             document.getElementById('edit_sexoEmpleados').value = ds.sexo;
             document.getElementById('edit_profesionEmpleados').value = ds.profesion;
             document.getElementById('edit_correoEmpleados').value = ds.correo !== 'Ninguno' ? ds.correo : '';
             document.getElementById('edit_direccionEmpleados').value = ds.direccion !== 'Ninguno' ? ds.direccion : '';
             document.getElementById('edit_avatarPreview').src = ds.avatar;

             // Lógica del Select de Documento
             const selectDoc = document.getElementById('edit_tipodocumentoEmpleados');
             const inputOtro = document.getElementById('edit_otroTipoDocumento');
             const docOptions = Array.from(selectDoc.options).map(o => o.value);
             
             if (docOptions.includes(ds.tipodoc)) {
                 selectDoc.value = ds.tipodoc;
                 editCheckTipoDoc(selectDoc);
             } else {
                 selectDoc.value = 'Otro';
                 editCheckTipoDoc(selectDoc);
                 inputOtro.value = ds.tipodoc;
             }
             
             document.getElementById('edit_numerodocumentoEmpleados').value = ds.numdoc;
          });
       });

       // Eliminar/Cambiar Estado
       document.querySelectorAll('.btn-eliminar').forEach(function (btn) {
          btn.addEventListener('click', function () {
             const ds = this.dataset;
             const form = document.getElementById('formEliminarEmpleados');
            
             form.action = `{{ url('empleados') }}/${ds.idEmpleado}`; // Actualizar action del formulario
             document.getElementById('eliminar_nombreEmpleado').textContent = ds.nombre; // Mostrar nombre del empleado
             const selectEstado = document.getElementById('select_estadoEmpleados'); // Configurar las opciones del select según el estado actual
             selectEstado.innerHTML = '';
             
             const estadoActual = ds.estado;
             let opciones = [];
             
             if (estadoActual === 'Activo') {
                opciones = [
                   { value: 'Inactivo', text: 'Inactivo' },
                   { value: 'Suspendido', text: 'Suspendido' }
                ];
             } else if (estadoActual === 'Inactivo') {
                opciones = [
                   { value: 'Activo', text: 'Activo' },
                   { value: 'Suspendido', text: 'Suspendido' }
                ];
             } else if (estadoActual === 'Suspendido') {
                opciones = [
                   { value: 'Activo', text: 'Activo' }
                ];
             }
             
             opciones.forEach(opt => {
                const option = document.createElement('option');
                option.value = opt.value;
                option.textContent = opt.text;
                selectEstado.appendChild(option);
             });
          });
       });
    </script>
    @endpush
</x-app-layout>