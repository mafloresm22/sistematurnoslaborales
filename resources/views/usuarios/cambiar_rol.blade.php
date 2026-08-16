<div class="modal fade" id="modalCambiarRol" tabindex="-1" aria-labelledby="modalCambiarRolLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modalCambiarRolLabel">Cambiar Rol de Usuario</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formChangeRole" action="{{ route('cambiar-rol') }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="user_id" id="role_user_id">
                <input type="hidden" name="role" id="selected_role" value="User" required>

                <div class="modal-body p-4 text-center">
                    <p class="text-muted mb-4">
                        Selecciona el rol para <strong id="role_user_name" class="text-dark"></strong>:
                    </p>

                    <div class="d-flex justify-content-center gap-3 my-3">

                        <button type="button" 
                                id="btnRoleAdmin" 
                                class="btn btn-outline-warning px-4 py-2"
                                onclick="selectRole('admin')">
                            <i class="bi bi-shield-lock-fill me-2"></i>Admin
                        </button>

                        <button type="button" 
                                id="btnRoleUser" 
                                class="btn btn-outline-primary px-4 py-2"
                                onclick="selectRole('user')">
                            <i class="bi bi-person-badge-fill me-2"></i>User
                        </button>
                    </div>
                </div>

                <div class="modal-footer bg-light justify-content-center">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary"> Guardar Cambio</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
function selectRole(role) {
    const btnAdmin  = document.getElementById('btnRoleAdmin');
    const btnUser   = document.getElementById('btnRoleUser');
    const inputRole = document.getElementById('selected_role');

    inputRole.value = role;

    if (role === 'admin') {
        btnAdmin.className = 'btn btn-warning px-4 py-2';
        btnUser.className  = 'btn btn-outline-primary px-4 py-2';
    } else {
        btnUser.className  = 'btn btn-primary px-4 py-2';
        btnAdmin.className = 'btn btn-outline-warning px-4 py-2';
    }
}

function abrirModalCambiarRol(id, nombre, rolActual) {
    document.getElementById('role_user_id').value = id;
    document.getElementById('role_user_name').textContent = nombre;

    const rolNormalizado = (rolActual && rolActual.toLowerCase() === 'admin') ? 'admin' : 'user';
    selectRole(rolNormalizado);

    const modal = new bootstrap.Modal(document.getElementById('modalCambiarRol'));
    modal.show();
}
</script>