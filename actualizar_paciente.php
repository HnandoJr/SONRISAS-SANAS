<?php
/*
actualizar_paciente.php
Este script recibe los datos del formulario de edición, los valida
y actualiza el registro correspondiente en la base de datos.
*/

// Incluir el archivo de configuración para la conexión a la BD
require 'config.php';

// Verificar que la solicitud sea de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recoger y limpiar los datos del formulario
    $id = $_POST['id'];
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
    if (empty($id) || empty($nombre_completo) || empty($tipo_documento) || empty($celular) || empty($fecha_nacimiento) || empty($edad) || empty($eps)) {
        // En una aplicación real, se manejaría este error de forma más elegante
        die('Error: Por favor, complete todos los campos requeridos.');
    }

    try {
        // Preparar la consulta SQL para actualizar el paciente
        $sql = "UPDATE pacientes SET
                    nombre_completo = ?,
                    tipo_documento = ?,
                    direccion = ?,
                    telefono = ?,
                    celular = ?,
                    fecha_nacimiento = ?,
                    edad = ?,
                    eps = ?,
                    contacto_adicional_nombre = ?,
                    contacto_adicional_parentesco = ?
                WHERE id = ?";

        $stmt = $pdo->prepare($sql);

        // Ejecutar la consulta con los nuevos datos
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
            $contacto_adicional_parentesco,
            $id
        ]);

        // Redirigir al usuario a la página principal con un mensaje de éxito
        // (Se podría usar sesiones para pasar mensajes de estado)
        header("Location: index.php?status=updated");
        exit;

    } catch (PDOException $e) {
        // Manejar errores de la base de datos y redirigir con un mensaje de error
        header("Location: index.php?status=error&message=" . urlencode($e->getMessage()));
        exit;
    }

} else {
    // Si no es una solicitud POST, redirigir a la página principal
    header("Location: index.php");
    exit;
}
?>
