<script type="text/javascript">
    {{-- Success Message --}}
    @if (Session::has('success'))
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: '{{ Session::get("success") }}',
        timer: 3000,
        timerProgressBar: true,
        showConfirmButton: false
    });
    @endif

    {{-- Error Message --}}
    @if (Session::has('error'))
    Swal.fire({
        icon: 'error',
        title: '¡Error!',
        text: '{{ Session::get("error") }}',
        timer: 4000,
        timerProgressBar: true,
        confirmButtonColor: "#3a57e8"
    });
    @endif

    @if(Session::has('errors') || (isset($errors) && is_array($errors) && $errors->any()))
    Swal.fire({
        icon: 'error',
        title: '¡Error!',
        text: '{{ Session::get("errors")->first() }}',
        timer: 4000,
        timerProgressBar: true,
        confirmButtonColor: "#3a57e8"
    });
    @endif

    {{-- Auto cerrar alertas estándar de Bootstrap en 3.5s --}}
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(function () {
            document.querySelectorAll('.alert-dismissible').forEach(function (alert) {
                if (typeof bootstrap !== 'undefined' && bootstrap.Alert) {
                    let bsAlert = bootstrap.Alert.getInstance(alert) || new bootstrap.Alert(alert);
                    bsAlert.close();
                } else {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            });
        }, 3500);
    });

    {{-- Prevenir doble submit y cambiar botón a "Procesando..." --}}
    document.addEventListener('submit', function (e) {
        const form = e.target;
        if (form.checkValidity && !form.checkValidity()) {
            return;
        }
        const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
        if (submitBtn && !form.dataset.submitting) {
            form.dataset.submitting = 'true';
            submitBtn.innerHTML = `
                <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                Procesando...
            `;
            setTimeout(function () {
                submitBtn.disabled = true;
            }, 10);
        }
    });
</script>