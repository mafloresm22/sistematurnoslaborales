<div class="modal fade" id="modalResetPassword" tabindex="-1" aria-labelledby="modalResetPasswordLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="modalResetPasswordLabel" style="color: white;">
                    Cambiar Contraseña
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="formResetPassword" action="{{ route('reset-password') }}" method="POST">
                @csrf
                @method('PUT')
                
                <input type="hidden" name="user_id" id="reset_user_id">

                <div class="modal-body p-4">
                    
                    <div class="mb-3">
                        <label for="password" class="form-label font-weight-bold">
                            Nueva Contraseña <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                            <input type="password" 
                                   class="form-control" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Mínimo 8 caracteres" 
                                   required 
                                   minlength="8">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('password', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label font-weight-bold">
                            Confirmar Nueva Contraseña <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                            <input type="password" 
                                   class="form-control" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   placeholder="Repite la contraseña" 
                                   required 
                                   minlength="8">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('password_confirmation', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <div id="passwordMatchError" class="form-text text-danger d-none">
                            <i class="bi bi-exclamation-circle"></i>
                            Las contraseñas no coinciden.
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnSavePassword"> Actualizar Contraseña</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const formResetPassword = document.getElementById('formResetPassword');
    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password_confirmation');
    const passwordMatchError = document.getElementById('passwordMatchError');

    // Validar coincidencia de contraseñas en tiempo real
    function validatePasswords() {
        if (passwordConfirmInput.value.length > 0 && passwordInput.value !== passwordConfirmInput.value) {
            passwordMatchError.classList.remove('d-none');
            passwordConfirmInput.classList.add('is-invalid');
            return false;
        } else {
            passwordMatchError.classList.add('d-none');
            passwordConfirmInput.classList.remove('is-invalid');
            return true;
        }
    }

    passwordInput.addEventListener('input', validatePasswords);
    passwordConfirmInput.addEventListener('input', validatePasswords);

    formResetPassword.addEventListener('submit', function (e) {
        e.preventDefault();

        // 1. Validaciones previas
        if (passwordInput.value.length < 8) {
            Swal.fire({
                icon: 'warning',
                title: 'Contraseña corta',
                text: 'La contraseña debe tener al menos 8 caracteres.',
                confirmColor: '#0d6efd'
            });
            return;
        }

        if (passwordInput.value !== passwordConfirmInput.value) {
            Swal.fire({
                icon: 'error',
                title: 'Las contraseñas no coinciden',
                text: 'Por favor, verifica que ambas contraseñas sean idénticas.',
                confirmColor: '#0d6efd'
            });
            return;
        }

        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Se actualizará la contraseña del usuario.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, cambiar contraseña',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Procesando...',
                    text: 'Guardando los cambios',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Enviar el formulario a Laravel
                formResetPassword.submit();
            }
        });
    });

    // Limpiar campos al cerrar el modal
    document.getElementById('modalResetPassword').addEventListener('hidden.bs.modal', function () {
        formResetPassword.reset();
        passwordMatchError.classList.add('d-none');
        passwordConfirmInput.classList.remove('is-invalid');
    });
});

function togglePasswordVisibility(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon = btn.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}
</script>
