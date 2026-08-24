<x-app-layout :assets="$assets ?? []">
@push('css')
    <link rel="stylesheet" href="{{ asset('css/role-permission.css') }}">
@endpush

<div>
    {{-- ===================== HEADER ===================== --}}
    <div class="rp-header">
        <div class="rp-header-info">
            <h2>
                <svg width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C9.243 2 7 4.243 7 7v1H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V10a2 2 0 00-2-2h-1V7c0-2.757-2.243-5-5-5zm-1 13.723V17a1 1 0 002 0v-1.277A2 2 0 1011 15.723zM9 7v1h6V7a3 3 0 00-6 0z" fill="currentColor"/>
                </svg>
                Roles y Permisos
            </h2>
            <p>Administra qué acciones puede realizar cada rol en el sistema</p>
        </div>
        <div class="rp-header-actions">
            <a href="#" class="btn btn-warning btn-icon"
               data-bs-toggle="tooltip"
               data-modal-form="form"
               data-size="small"
               data--href="{{ route('permission.create') }}"
               data-app-title="Nuevo permiso"
               title="Nuevo Permiso">
                <i class="btn-inner">
                    <svg width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
                </i>
                <span>Nuevo Permiso</span>
            </a>
            <a href="#" class="btn btn-primary btn-icon"
               data-bs-toggle="tooltip"
               data-modal-form="form"
               data-size="small"
               data--href="{{ route('role.create') }}"
               data-app-title="Nuevo rol"
               title="Nuevo Rol">
                <i class="btn-inner">
                    <svg width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
                </i>
                <span>Nuevo Rol</span>
            </a>
        </div>
    </div>

    {{-- ===================== ALERTS ===================== --}}
    @if(session('success'))
        <div class="rp-alert rp-alert-success">
            <svg width="18" viewBox="0 0 24 24" fill="none"><path d="M9 12l2 2 4-4M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="rp-alert rp-alert-error">
            <svg width="18" viewBox="0 0 24 24" fill="none"><path d="M12 9v4M12 17h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            {{ $errors->first() }}
        </div>
    @endif

    {{-- ===================== ROLE LEGEND ===================== --}}
    <div class="rp-legend">
        <span class="rp-legend-title">Roles activos:</span>
        @foreach($roles as $i => $role)
            <span class="rp-role-badge role-color-{{ $i % 6 }}"
                  style="background: color-mix(in srgb, var(--rc) 12%, white); color: var(--rc); border: 1.5px solid color-mix(in srgb, var(--rc) 25%, white);">
                <span class="dot" style="background: var(--rc);"></span>
                {{ ucfirst($role->name) }}
                <small style="opacity:.7;">({{ $role->permissions->count() }} perms)</small>
            </span>
        @endforeach
        @if($roles->isEmpty())
            <span style="font-size:.83rem; color:var(--rp-muted);">No hay roles creados aún.</span>
        @endif
    </div>

    {{-- ===================== FORM ===================== --}}
    <form method="POST" action="{{ route('role.permission.store') }}" id="rp-form">
        @csrf

        <div class="rp-modules">
            @foreach($modules as $moduleKey => $module)
            <div class="rp-module-card" id="card-{{ $moduleKey }}">

                {{-- Module header (toggle) --}}
                <div class="rp-module-header" onclick="toggleModule('{{ $moduleKey }}')">
                    <div class="rp-module-title">
                        <div class="rp-module-icon">
                            @include('role-permission.partials.module-icon', ['icon' => $module['icon']])
                        </div>
                        {{ $module['label'] }}
                    </div>
                    <div class="rp-module-meta">
                        <span class="rp-module-count">{{ count($module['perms']) }} permisos</span>
                        <svg class="rp-chevron" width="16" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>

                {{-- Module body --}}
                <div class="rp-module-body">
                    <table class="rp-perm-table">
                        <thead>
                            <tr>
                                <th>Permiso</th>
                                @foreach($roles as $i => $role)
                                    <th>
                                        <span class="role-color-{{ $i % 6 }}" style="color: var(--rc); font-weight:700;">
                                            {{ ucfirst($role->name) }}
                                        </span>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Select all row --}}
                            <tr class="rp-select-all-row">
                                <td>
                                    <span class="rp-select-all-label">
                                        <svg viewBox="0 0 24 24" fill="none"><path d="M9 11l3 3L22 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        Seleccionar todo
                                    </span>
                                </td>
                                @foreach($roles as $role)
                                    <td>
                                        <div class="rp-checkbox-wrap">
                                            <label class="rp-toggle">
                                                <input type="checkbox"
                                                       class="select-all-module"
                                                       data-module="{{ $moduleKey }}"
                                                       data-role="{{ $role->name }}"
                                                       onchange="selectAllModule('{{ $moduleKey }}','{{ $role->name }}',this.checked)"
                                                       {{ $role->permissions->whereIn('name', $module['perms'])->count() === count($module['perms']) ? 'checked' : '' }}>
                                                <span class="rp-toggle-slider"></span>
                                            </label>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>

                            {{-- Permission rows --}}
                            @foreach($module['perms'] as $permName)
                                @php
                                    $perm = $permissions->get($permName);
                                    $action = last(explode('.', $permName));
                                    $badgeClass = match($action) {
                                        'ver'    => 'badge-ver',
                                        'crear'  => 'badge-crear',
                                        'editar' => 'badge-editar',
                                        'eliminar' => 'badge-eliminar',
                                        default  => 'badge-other',
                                    };
                                @endphp
                                <tr>
                                    <td>
                                        <div class="perm-label">
                                            <span class="perm-dot"></span>
                                            {{ $permName }}
                                            <span class="perm-action-badge {{ $badgeClass }}">{{ $action }}</span>
                                        </div>
                                    </td>
                                    @foreach($roles as $role)
                                        <td>
                                            <div class="rp-checkbox-wrap">
                                                <label class="rp-toggle">
                                                    <input type="checkbox"
                                                           name="permissions[{{ $role->name }}][]"
                                                           value="{{ $permName }}"
                                                           class="perm-check module-{{ $moduleKey }}-role-{{ $role->name }}"
                                                           onchange="updateSelectAll('{{ $moduleKey }}','{{ $role->name }}')"
                                                           {{ $perm && $role->permissions->contains('name', $permName) ? 'checked' : '' }}>
                                                    <span class="rp-toggle-slider"></span>
                                                </label>
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>

        {{-- ===================== SAVE BAR ===================== --}}
        <div class="rp-save-bar mt-3">
            <p><strong>Importante:</strong> Los cambios aplican inmediatamente al guardar.</p>
            <button type="submit" class="btn-save-perms">
                <svg width="16" viewBox="0 0 24 24" fill="none">
                    <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <polyline points="17 21 17 13 7 13 7 21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <polyline points="7 3 7 8 15 8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Guardar Permisos
            </button>
        </div>
    </form>
</div>

<script>
    // Toggle módulo expand/collapse
    function toggleModule(key) {
        const card = document.getElementById('card-' + key);
        card.classList.toggle('collapsed');
    }

    // Seleccionar/deseleccionar todos los checkboxes de un módulo+rol
    function selectAllModule(moduleKey, roleName, checked) {
        const checks = document.querySelectorAll('.module-' + moduleKey + '-role-' + roleName);
        checks.forEach(c => c.checked = checked);
    }

    // Actualizar el toggle "seleccionar todo" cuando cambia un checkbox individual
    function updateSelectAll(moduleKey, roleName) {
        const all   = document.querySelectorAll('.module-' + moduleKey + '-role-' + roleName);
        const total = all.length;
        const checked = Array.from(all).filter(c => c.checked).length;

        const masterSelector = `input[data-module="${moduleKey}"][data-role="${roleName}"]`;
        const master = document.querySelector(masterSelector);
        if (master) {
            master.checked = (checked === total);
        }
    }
</script>
</x-app-layout>
