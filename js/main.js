/* main.js */

// Esperar a que todo el contenido del DOM esté completamente cargado y parseado
document.addEventListener('DOMContentLoaded', function() {

    // Contenedor donde se mostrará la lista de pacientes
    const listaPacientesContainer = document.getElementById('lista-pacientes');

    // Función para cargar y mostrar la lista de pacientes
    function cargarPacientes() {
        // Usar la API Fetch para hacer una solicitud GET al script PHP
        fetch('listar_pacientes.php')
            .then(response => {
                // Comprobar si la respuesta es exitosa (código 200)
                if (!response.ok) {
                    throw new Error('La solicitud falló con estado: ' + response.status);
                }
                // Convertir la respuesta a texto (HTML)
                return response.text();
            })
            .then(html => {
                // Insertar el HTML recibido en el contenedor
                listaPacientesContainer.innerHTML = html;
            })
            .catch(error => {
                // Manejar cualquier error que ocurra durante la solicitud
                console.error('Error al cargar la lista de pacientes:', error);
                listaPacientesContainer.innerHTML = '<p>Error al cargar la lista de pacientes. Por favor, intente de nuevo más tarde.</p>';
            });
    }

    // --- Lógica para el envío del formulario de registro ---
    const registroForm = document.getElementById('registro-form');

    if (registroForm) {
        registroForm.addEventListener('submit', function(event) {
            // Prevenir el comportamiento por defecto del formulario (recarga de la página)
            event.preventDefault();

            // Recoger los datos del formulario
            const formData = new FormData(registroForm);

            // Enviar los datos al script PHP usando Fetch
            fetch('guardar_paciente.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json()) // Esperar una respuesta JSON
            .then(data => {
                // Manejar la respuesta del servidor
                if (data.success) {
                    // Si fue exitoso, limpiar el formulario
                    registroForm.reset();
                    // Mostrar un mensaje de éxito (se podría usar un modal o una notificación más elegante)
                    alert(data.message);
                    // Recargar la lista de pacientes para mostrar el nuevo registro
                    cargarPacientes();
                } else {
                    // Si hubo un error, mostrar el mensaje de error
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                // Manejar errores de red o del script
                console.error('Error al enviar el formulario:', error);
                alert('Ocurrió un error de comunicación. Por favor, intente de nuevo.');
            });
        });
    }

    // Cargar la lista de pacientes tan pronto como la página esté lista
    cargarPacientes();

});
