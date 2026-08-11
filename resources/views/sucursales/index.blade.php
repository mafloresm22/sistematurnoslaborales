<x-app-layout :assets="$assets ?? []">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
               <div class="header-title">
                  <h4 class="card-title">Sucursales</h4>
               </div>
               <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreateSucursales">
                  <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                     <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  Nueva Sucursal
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
                  <table id="tabla-sucursales" class="table table-striped" role="grid">
                     <thead>
                        <tr class="ligth">
                           <th>#</th>
                           <th>Sucursales</th>
                           <th>Direcciones</th>
                           <th>Fecha de Creación</th>
                           <th style="min-width: 120px">Acciones</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($sucursales as $sucursal)
                           <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $sucursal->nombreSucursales }}</td>
                              <td>{{ $sucursal->direccionSucursales }}</td>
                              <td>{{ $sucursal->created_at ? $sucursal->created_at->format('d/m/Y') : '—' }}</td>
                              <td>
                                 <div class="d-flex align-items-center gap-2">
                                    {{-- Editar --}}
                                    <button type="button"
                                       class="btn btn-sm btn-icon btn-warning btn-editar"
                                       data-id-sucursales="{{ $sucursal->idSucursales }}"
                                       data-nombre-sucursales="{{ $sucursal->nombreSucursales }}"
                                       data-direccion-sucursales="{{ $sucursal->direccionSucursales }}"
                                       data-bs-toggle="modal"
                                       data-bs-target="#modalEditSucursales"
                                       title="Editar">
                                       <span class="btn-inner">
                                          <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                             <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                             <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          </svg>
                                       </span>
                                    </button>

                                    {{-- Eliminar --}}
                                    <form action="{{ route('sucursales.destroy', $sucursal->idSucursales) }}" method="POST" class="form-eliminar">
                                       @csrf
                                       @method('DELETE')
                                       <button type="button" class="btn btn-sm btn-icon btn-danger btn-eliminar" title="Eliminar">
                                          <span class="btn-inner">
                                             <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                             </svg>
                                          </span>
                                       </button>
                                    </form>
                                 </div>
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>

               {{-- Paginación --}}
               @if($sucursales->hasPages())
                  <div class="d-flex justify-content-center mt-3">
                     {{ $sucursales->links() }}
                  </div>
               @endif

            </div>
         </div>
      </div>
   </div>

   {{-- Modales --}}
   @include('sucursales.modal_create')
   @include('sucursales.modal_edit')

   @push('scripts')
    <script>
       // --- LÓGICA DE UBIGEO DESDE LA API ---
       const API_DEPARTAMENTOS = "{{ env('UBIGEO_DEPARTAMENTOS_URL') }}";
       const API_PROVINCIAS = "{{ env('UBIGEO_PROVINCIAS_URL') }}";
       const API_DISTRITOS = "{{ env('UBIGEO_DISTRITOS_URL') }}";

       let departamentosData = [];
       let provinciasData = {};
       let distritosData = {};

       function cargarUbigeosAPI() {
           $.when(
               $.getJSON(API_DEPARTAMENTOS),
               $.getJSON(API_PROVINCIAS),
               $.getJSON(API_DISTRITOS)
           ).done(function(depRes, provRes, distRes) {
               departamentosData = depRes[0];
               provinciasData = provRes[0];
               distritosData = distRes[0];

               let $dep = $('#selDepartamento');
               $dep.empty().append('<option value="">Seleccione...</option>');
               departamentosData.forEach(function(dep) {
                   $dep.append(`<option value="${dep.id_ubigeo}">${dep.nombre_ubigeo}</option>`);
               });

               let $editDep = $('#edit_selDepartamento');
               $editDep.empty().append('<option value="">Seleccione...</option>');
               departamentosData.forEach(function(dep) {
                   $editDep.append(`<option value="${dep.id_ubigeo}">${dep.nombre_ubigeo}</option>`);
               });
           }).fail(function(err) {
               console.error("Error al cargar ubigeos desde la API:", err);
           });
       }

       function actualizarDireccionOculta() {
           let dep = $('#selDepartamento option:selected').text();
           let prov = $('#selProvincia option:selected').text();
           let dist = $('#selDistrito option:selected').text();
           let det = $('#direccionDetalle').val().trim();
           
           if($('#selDepartamento').val() && $('#selProvincia').val() && $('#selDistrito').val() && det) {
               let fullAddress = `Peru / ${dep} / ${prov} / ${dist} - ${det}`;
               $('#direccionSucursales').val(fullAddress);
           } else {
               $('#direccionSucursales').val('');
           }
       }

       function actualizarDireccionOcultaEdit() {
           let dep = $('#edit_selDepartamento option:selected').text();
           let prov = $('#edit_selProvincia option:selected').text();
           let dist = $('#edit_selDistrito option:selected').text();
           let det = $('#edit_direccionDetalle').val().trim();
           
           if($('#edit_selDepartamento').val() && $('#edit_selProvincia').val() && $('#edit_selDistrito').val() && det) {
               let fullAddress = `Peru / ${dep} / ${prov} / ${dist} - ${det}`;
               $('#edit_direccionSucursales').val(fullAddress);
           } else {
               $('#edit_direccionSucursales').val('');
           }
       }

       // Cargar datos en el modal de edicion
       document.querySelectorAll('.btn-editar').forEach(function (btn) {
          btn.addEventListener('click', function () {
             const idSucursales = this.dataset.idSucursales;
             const nombre = this.dataset.nombreSucursales;
             const direccion = this.dataset.direccionSucursales || '';
             const form = document.getElementById('formEditSucursales');

             form.action = `{{ url('sucursales') }}/${idSucursales}`;
             document.getElementById('edit_nombreSucursales').value = nombre;
             document.getElementById('edit_direccionSucursales').value = direccion;

             // Parsear la dirección guardada (Formato: "Peru / Departamento / Provincia / Distrito - Detalle")
             let depNombre = '', provNombre = '', distNombre = '', detalle = direccion;

             if (direccion.includes(' - ')) {
                const parts = direccion.split(' - ');
                detalle = parts.slice(1).join(' - ');
                const ubigeoParts = parts[0].split('/').map(s => s.trim());
                if (ubigeoParts.length >= 4) {
                   depNombre = ubigeoParts[1];
                   provNombre = ubigeoParts[2];
                   distNombre = ubigeoParts[3];
                }
             }

             document.getElementById('edit_direccionDetalle').value = detalle;

             // Seleccionar Departamento
             let depId = '';
             if (depNombre && departamentosData) {
                const depObj = departamentosData.find(d => d.nombre_ubigeo.toLowerCase() === depNombre.toLowerCase());
                if (depObj) depId = depObj.id_ubigeo;
             }

             const $editDep = $('#edit_selDepartamento');
             const $editProv = $('#edit_selProvincia');
             const $editDist = $('#edit_selDistrito');

             $editDep.val(depId);

             // Llenar y seleccionar Provincia
             $editProv.empty().append('<option value="">Seleccione...</option>').prop('disabled', true);
             $editDist.empty().append('<option value="">Seleccione...</option>').prop('disabled', true);

             if (depId && provinciasData[depId]) {
                let provId = '';
                provinciasData[depId].forEach(function(prov) {
                   $editProv.append(`<option value="${prov.id_ubigeo}">${prov.nombre_ubigeo}</option>`);
                   if (prov.nombre_ubigeo.toLowerCase() === provNombre.toLowerCase()) {
                      provId = prov.id_ubigeo;
                   }
                });
                $editProv.prop('disabled', false).val(provId);

                // Llenar y seleccionar Distrito
                if (provId && distritosData[provId]) {
                   let distId = '';
                   distritosData[provId].forEach(function(dist) {
                      $editDist.append(`<option value="${dist.id_ubigeo}">${dist.nombre_ubigeo}</option>`);
                      if (dist.nombre_ubigeo.toLowerCase() === distNombre.toLowerCase()) {
                         distId = dist.id_ubigeo;
                      }
                   });
                   $editDist.prop('disabled', false).val(distId);
                }
             }

             actualizarDireccionOcultaEdit();
          });
       });

       // Eliminar
       document.querySelectorAll('.btn-eliminar').forEach(function (btn) {
          btn.addEventListener('click', function (e) {
             e.preventDefault();
             const form = this.closest('form');
             Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
             }).then((result) => {
                if (result.isConfirmed) {
                   form.submit();
                }
             });
          });
       });

       // Inicializar DataTable en español
       $(document).ready(function() {
          $('#tabla-sucursales').DataTable({
             language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
             }
          });

          cargarUbigeosAPI();

          // Listeners para modal Crear
          $('#selDepartamento').on('change', function() {
              let depId = $(this).val();
              let $prov = $('#selProvincia');
              let $dist = $('#selDistrito');

              $prov.empty().append('<option value="">Seleccione...</option>').prop('disabled', true);
              $dist.empty().append('<option value="">Seleccione...</option>').prop('disabled', true);

              if (depId && provinciasData[depId]) {
                  provinciasData[depId].forEach(function(prov) {
                      $prov.append(`<option value="${prov.id_ubigeo}">${prov.nombre_ubigeo}</option>`);
                  });
                  $prov.prop('disabled', false);
              }
              actualizarDireccionOculta();
          });

          $('#selProvincia').on('change', function() {
              let provId = $(this).val();
              let $dist = $('#selDistrito');

              $dist.empty().append('<option value="">Seleccione...</option>').prop('disabled', true);

              if (provId && distritosData[provId]) {
                  distritosData[provId].forEach(function(dist) {
                      $dist.append(`<option value="${dist.id_ubigeo}">${dist.nombre_ubigeo}</option>`);
                  });
                  $dist.prop('disabled', false);
              }
              actualizarDireccionOculta();
          });

          $('#selDistrito').on('change', function() {
              actualizarDireccionOculta();
          });

          $('#direccionDetalle').on('input', function() {
              actualizarDireccionOculta();
          });

          // Listeners para modal Editar
          $('#edit_selDepartamento').on('change', function() {
              let depId = $(this).val();
              let $prov = $('#edit_selProvincia');
              let $dist = $('#edit_selDistrito');

              $prov.empty().append('<option value="">Seleccione...</option>').prop('disabled', true);
              $dist.empty().append('<option value="">Seleccione...</option>').prop('disabled', true);

              if (depId && provinciasData[depId]) {
                  provinciasData[depId].forEach(function(prov) {
                      $prov.append(`<option value="${prov.id_ubigeo}">${prov.nombre_ubigeo}</option>`);
                  });
                  $prov.prop('disabled', false);
              }
              actualizarDireccionOcultaEdit();
          });

          $('#edit_selProvincia').on('change', function() {
              let provId = $(this).val();
              let $dist = $('#edit_selDistrito');

              $dist.empty().append('<option value="">Seleccione...</option>').prop('disabled', true);

              if (provId && distritosData[provId]) {
                  distritosData[provId].forEach(function(dist) {
                      $dist.append(`<option value="${dist.id_ubigeo}">${dist.nombre_ubigeo}</option>`);
                  });
                  $dist.prop('disabled', false);
              }
              actualizarDireccionOcultaEdit();
          });

          $('#edit_selDistrito').on('change', function() {
              actualizarDireccionOcultaEdit();
          });

          $('#edit_direccionDetalle').on('input', function() {
              actualizarDireccionOcultaEdit();
          });

          $('#modalCreateSucursales').on('hidden.bs.modal', function () {
              $(this).find('form')[0].reset();
              $('#selProvincia').empty().append('<option value="">Seleccione...</option>').prop('disabled', true);
              $('#selDistrito').empty().append('<option value="">Seleccione...</option>').prop('disabled', true);
              $('#direccionSucursales').val('');
          });

          $('#modalEditSucursales').on('hidden.bs.modal', function () {
              $(this).find('form')[0].reset();
              $('#edit_selProvincia').empty().append('<option value="">Seleccione...</option>').prop('disabled', true);
              $('#edit_selDistrito').empty().append('<option value="">Seleccione...</option>').prop('disabled', true);
              $('#edit_direccionSucursales').val('');
          });
       });
    </script>
    @endpush

</x-app-layout>
