<x-app-layout :assets="$assets ?? []">
    @php
        $totalEmpleados = \App\Models\Empleados::count();
        $empleadosActivos = \App\Models\Empleados::where('estadoEmpleados', 'Activo')->count();
        $totalTurnos = \App\Models\Turnos::count();
        $totalSucursales = \App\Models\Sucursales::count();
        $ausenciasPendientes = \App\Models\Ausencias::where('estadoAusencias', 'Pendiente')->count();
        $totalAusencias = \App\Models\Ausencias::count();
    @endphp

    <!-- Cards de Estadísticas del Sistema (Solo vista de Inicio) -->
    <div class="row">
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted fw-semibold d-block mb-1 fs-7">Total Empleados</span>
                            <h2 class="mb-1 fw-bold text-dark">{{ $totalEmpleados }}</h2>
                            <span class="badge bg-soft-success text-success rounded-pill px-2 py-1">
                                <i class="bi bi-person-check-fill me-1"></i>{{ $empleadosActivos }} Activos
                            </span>
                        </div>
                        <div class="bg-soft-primary p-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                            <i class="bi bi-people-fill fs-3 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted fw-semibold d-block mb-1 fs-7">Turnos Registrados</span>
                            <h2 class="mb-1 fw-bold text-dark">{{ $totalTurnos }}</h2>
                            <span class="badge bg-soft-info text-info rounded-pill px-2 py-1">
                                <i class="bi bi-clock-history me-1"></i>Configurados
                            </span>
                        </div>
                        <div class="bg-soft-info p-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                            <i class="bi bi-clock-fill fs-3 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted fw-semibold d-block mb-1 fs-7">Sucursales</span>
                            <h2 class="mb-1 fw-bold text-dark">{{ $totalSucursales }}</h2>
                            <span class="badge bg-soft-success text-success rounded-pill px-2 py-1">
                                <i class="bi bi-geo-alt-fill me-1"></i>Sedes Activas
                            </span>
                        </div>
                        <div class="bg-soft-success p-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                            <i class="bi bi-building-fill fs-3 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted fw-semibold d-block mb-1 fs-7">Ausencias Pendientes</span>
                            <h2 class="mb-1 fw-bold text-dark">{{ $ausenciasPendientes }}</h2>
                            <span class="badge bg-soft-warning text-warning rounded-pill px-2 py-1">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $totalAusencias }} Registros
                            </span>
                        </div>
                        <div class="bg-soft-warning p-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                            <i class="bi bi-calendar-event-fill fs-3 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

