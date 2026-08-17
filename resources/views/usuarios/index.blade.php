<x-app-layout :assets="$assets ?? []">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="header-title">
                        <h4 class="card-title fw-bold mb-0">
                            <i class="bi bi-people-fill me-2 text-primary"></i>Listado de Usuarios
                        </h4>
                    </div>
                    <div class="search-box">
                        <form action="{{ route('usuarios.index') }}" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control me-2" placeholder="Buscar por nombre, apellido o usuario..." value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-search"></i>
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
                        @php
                            $esAdmin = $usuario->hasRole('admin') || $usuario->user_type === 'admin';
                            $esMismo = $usuario->id === auth()->id();
                        @endphp
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card shadow-sm h-100 {{ $esAdmin ? 'border-warning border-2' : 'border' }}">
                                @if($esAdmin)
                                    <div class="card-header py-1 px-3" style="background: linear-gradient(90deg, #f59e0b, #d97706); border-bottom: none;">
                                        <small class="text-white fw-semibold">
                                            <i class="bi bi-shield-fill-check me-1"></i> Administrador
                                        </small>
                                    </div>
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="card-title mb-0 fw-bold">
                                            {{ $usuario->first_name }} {{ $usuario->last_name }}
                                            @if($esMismo)
                                                <span class="badge bg-secondary ms-1" style="font-size: 0.65rem;">Tú</span>
                                            @endif
                                        </h5>
                                        <span class="badge bg-{{ $usuario->status == 'active' ? 'success' : 'danger' }}">
                                            {{ ucfirst($usuario->status) }}
                                        </span>
                                    </div>
                                    
                                    <div class="mb-3 flex-grow-1">
                                        <p class="mb-1 text-muted">
                                            <i class="bi bi-person me-2"></i><strong>Usuario:</strong> {{ $usuario->username }}
                                        </p>
                                        <p class="mb-1 text-muted">
                                            <i class="bi bi-shield-lock me-2"></i><strong>Tipo:</strong> {{ ucfirst($usuario->user_type) }}
                                        </p>
                                    </div>
                                    
                                    <div class="d-flex gap-2 mt-auto">
                                        @if($esMismo)
                                            <button class="btn btn-primary btn-sm flex-fill" disabled title="No puedes editar tu propio perfil">
                                                <i class="bi bi-key"></i> Cambiar Clave
                                            </button>
                                            <button class="btn btn-sm btn-warning flex-fill" disabled title="No puedes editar tu propio perfil">
                                                <i class="bi bi-person-gear"></i> Cambiar Rol
                                            </button>
                                        @else
                                            <button class="btn btn-primary btn-sm" onclick="abrirModalReset('{{ $usuario->id }}')">
                                                <i class="bi bi-key"></i>
                                                Cambiar Clave
                                            </button>
                                            <button type="button" class="btn btn-sm btn-warning flex-fill" onclick="abrirModalCambiarRol('{{ $usuario->id }}', '{{ $usuario->first_name }} {{ $usuario->last_name }}', '{{ $esAdmin ? 'admin' : 'user' }}')" title="Cambiar Rol">
                                                <i class="bi bi-person-gear"></i>
                                                Cambiar Rol
                                            </button>
                                        @endif
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
    @include('usuarios.reset_password')
    @include('usuarios.cambiar_rol')

    <script>
        function abrirModalReset(idUsuario) {
            document.getElementById('reset_user_id').value = idUsuario;
            document.getElementById('formResetPassword').reset();
            document.getElementById('passwordMatchError').classList.add('d-none');
            document.getElementById('password_confirmation').classList.remove('is-invalid');
            var modal = new bootstrap.Modal(document.getElementById('modalResetPassword'));
            modal.show();
        }
    </script>
</x-app-layout>
