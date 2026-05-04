/* main.js */

document.addEventListener('DOMContentLoaded', function() {
    const listaPacientesContainer = document.getElementById('lista-pacientes');
    const searchInput = document.getElementById('search-input');
    const registroForm = document.getElementById('registro-form');
    const fechaNacimientoInput = document.getElementById('fecha_nacimiento');
    const edadInput = document.getElementById('edad');
    const toastContainer = document.getElementById('toast-container');

    // --- Funciones de Notificación (Toast) ---
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `
            <span>${message}</span>
            <span style="cursor:pointer; margin-left:10px;" onclick="this.parentElement.remove()">&times;</span>
        `;
        toastContainer.appendChild(toast);

        // Auto-eliminar después de 5 segundos
        setTimeout(() => {
            if (toast.parentElement) {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                toast.style.transition = 'all 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }
        }, 5000);
    }

    // --- Cargar Pacientes (con búsqueda) ---
    function cargarPacientes(search = '') {
        fetch(`listar_pacientes.php?search=${encodeURIComponent(search)}`)
            .then(response => {
                if (!response.ok) throw new Error('Error al cargar pacientes');
                return response.text();
            })
            .then(html => {
                listaPacientesContainer.innerHTML = html;
            })
            .catch(error => {
                console.error(error);
                showToast('No se pudo cargar la lista de pacientes', 'error');
            });
    }

    // --- Búsqueda en tiempo real (con debounce) ---
    let searchTimeout;
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                cargarPacientes(this.value);
            }, 300);
        });
    }

    // --- Cálculo automático de edad ---
    if (fechaNacimientoInput && edadInput) {
        fechaNacimientoInput.addEventListener('change', function() {
            if (!this.value) return;

            const birthDate = new Date(this.value);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const m = today.getMonth() - birthDate.getMonth();

            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            edadInput.value = age >= 0 ? age : 0;
        });
    }

    // --- Envío del Formulario ---
    if (registroForm) {
        registroForm.addEventListener('submit', function(event) {
            event.preventDefault();

            // Validación básica adicional
            const celular = document.getElementById('celular').value;
            if (celular.length < 7) {
                showToast('El número de celular es demasiado corto', 'error');
                return;
            }

            const formData = new FormData(registroForm);

            fetch('guardar_paciente.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    registroForm.reset();
                    showToast(data.message, 'success');
                    cargarPacientes();
                } else {
                    showToast(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error de comunicación con el servidor', 'error');
            });
        });
    }

    // Cargar pacientes inicialmente
    if (listaPacientesContainer) {
        cargarPacientes();
    }

    // Detectar mensajes de estado en la URL (para redirecciones PHP)
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('status')) {
        const status = urlParams.get('status');
        const message = urlParams.get('message');

        if (status === 'updated') showToast('Paciente actualizado correctamente', 'success');
        if (status === 'deleted') showToast('Paciente eliminado correctamente', 'success');
        if (status === 'error') showToast(message || 'Ocurrió un error', 'error');

        // Limpiar la URL sin recargar
        window.history.replaceState({}, document.title, window.location.pathname);
    }
});
