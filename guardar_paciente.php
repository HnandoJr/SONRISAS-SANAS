<?php
/*
guardar_paciente.php
Este script recibe los datos del formulario de registro, los valida
y los inserta en la base de datos.
*/

// Incluir el archivo de configuración para la conexión a la BD
require 'config.php';

// Inicializar un array para la respuesta JSON
$response = ['success' => false, 'message' => ''];

// --- Validación de Datos del Lado del Servidor ---

// Verificar que la solicitud sea de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger y limpiar los datos del formulario
    $nombre_completo = trim($_POST['nombre_completo']);
    $tipo_documento = trim($_POST['tipo_documento']);
    $direccion = trim($_POST['direccion']);
    $telefono = trim($_POST['telefono']);
    $celular = trim($_POST['celular']);
    $fecha_nacimiento = trim($_POST['fecha_nacimiento']);
    $edad = trim($_POST['edad']);
    $eps = trim($_POST['eps']);
    $contacto_adicional_nombre = trim($_POST['contacto_adicional_nombre']);
    $contacto_adicional_parentesco = trim($_POST['contacto_adicional_parentesco']);

    // Validar que los campos requeridos no estén vacíos
    if (empty($nombre_completo) || empty($tipo_documento) || empty($celular) || empty($fecha_nacimiento) || empty($edad) || empty($eps)) {
        $response['message'] = 'Por favor, complete todos los campos requeridos.';
    } else {
        // --- Inserción en la Base de Datos ---
        try {
            // Preparar la consulta SQL para evitar inyecciones SQL
            $sql = "INSERT INTO pacientes (nombre_completo, tipo_documento, direccion, telefono, celular, fecha_nacimiento, edad, eps, contacto_adicional_nombre, contacto_adicional_parentesco) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $pdo->prepare($sql);

            // Ejecutar la consulta con los datos del formulario
            $stmt->execute([
                $nombre_completo,
                $tipo_documento,
                $direccion,
                $telefono,
                $celular,
                $fecha_nacimiento,
                $edad,
                $eps,
                $contacto_adicional_nombre,
                $contacto_adicional_parentesco
            ]);

            // Si la inserción fue exitosa
            $response['success'] = true;
            $response['message'] = 'Paciente registrado exitosamente.';

        } catch(PDOException $e) {
            // Manejar errores de la base de datos
            $response['message'] = 'Error al registrar el paciente: ' . $e->getMessage();
        }
    }
} else {
    // Si no es una solicitud POST, enviar un mensaje de error
    $response['message'] = 'Método de solicitud no válido.';
}

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
