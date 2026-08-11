<x-app-layout :assets="$assets ?? []">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
               <div class="header-title">
                  <h4 class="card-title">Categorías</h4>
               </div>
               <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreateCategoria">
                  <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                     <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  Nueva Categoría
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
                  <table id="tabla-categorias" class="table table-striped" role="grid">
                     <thead>
                        <tr class="ligth">
                           <th>#</th>
                           <th>Nombre de Categoría</th>
                           <th>Fecha de Creación</th>
                           <th style="min-width: 120px">Acciones</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse($categorias as $categoria)
                           <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $categoria->nombreCategorias }}</td>
                              <td>{{ $categoria->created_at ? $categoria->created_at->format('d/m/Y') : '—' }}</td>
                              <td>
                                 <div class="d-flex align-items-center gap-2">
                                    {{-- Editar --}}
                                    <button type="button"
                                       class="btn btn-sm btn-icon btn-warning btn-editar"
                                       data-id-categorias="{{ $categoria->idCategorias }}"
                                       data-nombre-categorias="{{ $categoria->nombreCategorias }}"
                                       data-bs-toggle="modal"
                                       data-bs-target="#modalEditCategoria"
                                       title="Editar">
                                       <span class="btn-inner">
                                          <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                             <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                             <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          </svg>
                                          Editar
                                       </span>
                                    </button>

                                    {{-- Eliminar --}}
                                    <form action="{{ route('categorias.destroy', $categoria->idCategorias) }}" method="POST" class="form-eliminar">
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
                                          Eliminar
                                       </button>
                                    </form>
                                 </div>
                              </td>
                           </tr>
                        @empty
                           <tr>
                              <td colspan="4" class="text-center py-4 text-muted">No hay categorías registradas.</td>
                           </tr>
                        @endforelse
                     </tbody>
                  </table>
               </div>

               {{-- Paginación --}}
               @if($categorias->hasPages())
                  <div class="d-flex justify-content-center mt-3">
                     {{ $categorias->links() }}
                  </div>
               @endif

            </div>
         </div>
      </div>
   </div>

   {{-- Modales --}}
   @include('categorias.modal_create')
   @include('categorias.modal_edit')

   @push('scripts')
   <script>
      // Cargar datos en el modal de edicion
      document.querySelectorAll('.btn-editar').forEach(function (btn) {
         btn.addEventListener('click', function () {
            const idCategorias = this.dataset.idCategorias;
            const nombre = this.dataset.nombreCategorias;
            const form = document.getElementById('formEditCategoria');

            form.action = `{{ url('categorias') }}/${idCategorias}`;
            document.getElementById('edit_nombreCategorias').value = nombre;
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
   </script>
   @endpush

</x-app-layout>
