<x-app-layout :assets="$assets ?? []">

    {{-- Cabecera de la sección --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body d-flex justify-content-between align-items-center py-3">
            <div>
                <h4 class="fw-bold mb-1"><i class="bi bi-calendar3 me-2 text-primary"></i>Cronogramas por Sucursal</h4>
                <p class="text-muted mb-0 small">Consulta el calendario de turnos de cada sucursal</p>
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mx-3 mb-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    {{-- Tabla de Sucursales --}}
    <div class="row">
        <div class="col-sm-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title fw-bold mb-0">
                        <i class="bi bi-building me-2 text-primary"></i>Sucursales
                    </h5>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table id="tabla-cronogramas" class="table table-striped" role="grid">
                            <thead>
                                <tr>
                                    <th style="width: 40px;">#</th>
                                    <th>Sucursal</th>
                                    <th>Dirección</th>
                                    <th class="text-center" style="width: 160px;">Asignados</th>
                                    <th class="text-center" style="width: 50px;">Turnos</th>
                                    <th class="text-center" style="width: 50px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sucursales as $index => $sucursal)
                                    <tr>
                                        <td class="fw-bold text-muted align-middle">{{ $index + 1 }}</td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                                                     style="width: 36px; height: 36px; font-size: 0.8rem;">
                                                    {{ strtoupper(substr($sucursal->nombreSucursales, 0, 2)) }}
                                                </div>
                                                <span class="fw-semibold">{{ $sucursal->nombreSucursales }}</span>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <span class="d-inline-block text-truncate text-muted"
                                                  style="max-width: 500px;"
                                                  title="{{ $sucursal->direccionSucursales }}">
                                                {{ $sucursal->direccionSucursales ?? '—' }}
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge bg-info text-white px-3 py-2 rounded-pill">
                                                <i class="bi bi-people me-1"></i>{{ $sucursal->totalEmpleados }}
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge bg-primary text-white px-3 py-2 rounded-pill">
                                                <i class="bi bi-calendar-week me-1"></i>{{ $sucursal->totalTurnos }}
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <button type="button"
                                                class="btn btn-sm btn-success px-3 fw-semibold btn-ver-calendario"
                                                data-id-sucursal="{{ $sucursal->idSucursales }}"
                                                data-nombre-sucursal="{{ $sucursal->nombreSucursales }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalCalendarioCronograma">
                                                <i class="bi bi-calendar3 me-1"></i>Ver Calendario
                                            </button>
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

    @include('cronogramas.modal_cronogramas')

    @push('scripts')
    <script>
        $(document).ready(function () {
            $('#tabla-cronogramas').DataTable({
                language: { url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json" }
            });
        });
    </script>
    @endpush

</x-app-layout>
