<x-app-layout :assets="$assets ?? []">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="header-title">
                        <h4 class="card-title fw-bold mb-0">
                            <i class="bi bi-clock-history me-2 text-primary"></i>Listado de Turnos Laborales
                        </h4>
                    </div>
                    
                    <div class="d-flex align-items-center gap-2">
                        <div class="search-box">
                            <form action="{{ route('turnos.index') }}" method="GET" class="d-flex">
                                <input type="text" name="search" class="form-control me-2" placeholder="Buscar turno..." value="{{ request('search') }}">
                                <button class="btn btn-outline-primary" type="submit" title="Buscar">
                                    <i class="bi bi-search"></i>
                                </button>
                            </form>
                        </div>
                        
                        <button type="button" class="btn btn-primary" onclick="abrirModalCrearTurno()">
                            <i class="bi bi-plus-lg me-1"></i> Nuevo Turno
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        @php
                            $listaTurnos = $turnos ?? [];
                        @endphp

                        @forelse($listaTurnos as $turno)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card shadow-sm h-100 border-0" style="border-top: 5px solid {{ $turno->colorFondo ?? '#0d6efd' }} !important; background-color: #ffffff;">
                                    
                                    <div class="card-body d-flex flex-column p-4">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="card-title mb-1 fw-bold text-dark">
                                                    {{ $turno->nombreTurnos }}
                                                </h5>
                                                <span class="badge bg-light text-secondary border">
                                                    <i class="bi bi-tag-fill me-1"></i>{{ $turno->categoria->nombreCategorias ?? 'General' }}
                                                </span>
                                            </div>

                                            <span class="badge px-3 py-2 rounded-pill shadow-sm" 
                                                  style="background-color: {{ $turno->colorFondo }}; color: {{ $turno->colorTexto }}; font-weight: 600;">
                                                <i class="bi bi-palette me-1"></i> Vista
                                            </span>
                                        </div>

                                        <div class="p-3 mb-3 rounded-3 bg-light border flex-grow-1">
                                            <div class="row text-center align-items-center">
                                                <div class="col-5">
                                                    <small class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 0.75rem;">Hora Inicio</small>
                                                    <span class="fw-bold text-dark fs-6">
                                                        <i class="bi bi-clock me-1 text-success"></i>
                                                        {{ \Carbon\Carbon::parse($turno->horaInicio)->format('h:i A') }}
                                                    </span>
                                                </div>
                                                <div class="col-2 text-muted">
                                                    <i class="bi bi-arrow-right fs-5"></i>
                                                </div>
                                                <div class="col-5">
                                                    <small class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 0.75rem;">Hora Fin</small>
                                                    <span class="fw-bold text-dark fs-6">
                                                        <i class="bi bi-clock-fill me-1 text-danger"></i>
                                                        {{ \Carbon\Carbon::parse($turno->horaFin)->format('h:i A') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center small text-muted mb-3 px-1">
                                            <span>
                                                <strong>Fondo:</strong> <code class="ms-1">{{ $turno->colorFondo }}</code>
                                            </span>
                                            <span>
                                                <strong>Texto:</strong> <code class="ms-1">{{ $turno->colorTexto }}</code>
                                            </span>
                                        </div>

                                        <div class="d-flex gap-2 mt-auto pt-2 border-top">
                                            <button type="button" class="btn btn-warning btn-sm flex-fill fw-semibold" 
                                                    onclick="abrirModalEditarTurno({{ json_encode($turno) }})">
                                                <i class="bi bi-pencil-square me-1"></i> Editar
                                            </button>
                                            
                                            <button type="button" class="btn btn-danger btn-sm flex-fill fw-semibold" 
                                                    onclick="confirmarEliminarTurno('{{ $turno->idTurno }}', '{{ $turno->nombreTurnos }}')">
                                                <i class="bi bi-trash me-1"></i> Eliminar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center text-muted py-5">
                                <i class="bi bi-calendar-x fs-1 d-block mb-2 text-secondary"></i>
                                <h5>No hay turnos registrados</h5>
                                <p class="mb-0">Crea tu primer turno haciendo clic en el botón "Nuevo Turno".</p>
                            </div>
                        @endforelse
                    </div>

                    @if(method_exists($listaTurnos, 'links'))
                        <div class="d-flex justify-content-end mt-4">
                            {{ $listaTurnos->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('turnos.modal_create')
    @include('turnos.modal_edit')

    <script>
        function abrirModalCrearTurno() {
            var modal = new bootstrap.Modal(document.getElementById('modalCreateTurno'));
            modal.show();
        }

        function abrirModalEditarTurno(turno) {
            document.getElementById('edit_idTurno').value = turno.idTurno;
            document.getElementById('edit_nombreTurnos').value = turno.nombreTurnos;
            document.getElementById('edit_horaInicio').value = turno.horaInicio;
            document.getElementById('edit_horaFin').value = turno.horaFin;
            document.getElementById('edit_colorFondo').value = turno.colorFondo;
            document.getElementById('edit_colorTexto').value = turno.colorTexto;
            document.getElementById('edit_categoriaid').value = turno.categoriaid;

            var modal = new bootstrap.Modal(document.getElementById('modalEditTurno'));
            modal.show();
        }

        function confirmarEliminarTurno(id, nombre) {
            Swal.fire({
                title: '¿Eliminar turno?',
                text: `¿Estás seguro de eliminar el turno "${nombre}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`form-delete-turno-${id}`).submit();
                }
            });
        }
    </script>
</x-app-layout>