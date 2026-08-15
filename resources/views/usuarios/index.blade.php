<x-app-layout :assets="$assets ?? []">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="header-title">
                        <h4 class="card-title">Listado de Usuarios</h4>
                    </div>
                    <div class="search-box">
                        <form action="{{ route('usuarios.index') }}" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control me-2" placeholder="Buscar por nombre, apellido o usuario..." value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-search"></i> Buscar
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @php
                            $listaUsuarios = $usuarios ?? ($users ?? []);
                        @endphp

                        @forelse($listaUsuarios as $usuario)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card shadow-sm border h-100">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="card-title mb-0 fw-bold">{{ $usuario->first_name }} {{ $usuario->last_name }}</h5>
                                        <span class="badge bg-{{ $usuario->status == 'active' ? 'success' : 'danger' }}">
                                            {{ ucfirst($usuario->status) }}
                                        </span>
                                    </div>
                                    
                                    <div class="mb-3 flex-grow-1">
                                        <p class="mb-1 text-muted">
                                            <i class="bi bi-person me-2"></i><strong>Username:</strong> {{ $usuario->username }}
                                        </p>
                                        <p class="mb-1 text-muted">
                                            <i class="bi bi-shield-lock me-2"></i><strong>Tipo:</strong> {{ ucfirst($usuario->user_type) }}
                                        </p>
                                    </div>
                                    
                                    <div class="d-flex gap-2 mt-auto">
                                        <button type="button" class="btn btn-sm btn-primary flex-fill" data-bs-toggle="modal" data-bs-target="#modalCambiarPassword" data-id="{{ $usuario->id }}" title="Cambiar Contraseña">
                                            <svg width="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM13 17H11V15H13V17ZM13 13H11V7H13V13Z" fill="currentColor"/>
                                            </svg>
                                            Contraseña
                                        </button>
                                        <button type="button" class="btn btn-sm btn-warning flex-fill" data-bs-toggle="modal" data-bs-target="#modalCambiarRol" data-id="{{ $usuario->id }}" title="Cambiar Rol">
                                            <svg width="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            Rol
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center text-muted py-5">
                            <p>No hay usuarios registrados o no se pasó la variable a la vista.</p>
                        </div>
                        @endforelse
                    </div>

                    @if(method_exists($listaUsuarios, 'links'))
                        <div class="d-flex justify-content-end mt-4">
                            {{ $listaUsuarios->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
