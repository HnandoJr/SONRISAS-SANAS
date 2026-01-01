<?php
/*
eliminar_paciente.php
Este script recibe el ID de un paciente, lo valida y lo elimina de la base de datos.
*/

// Incluir el archivo de configuración para la conexión a la BD
require 'config.php';

// Obtener el ID del paciente de la URL
$id = $_GET['id'] ?? null;

// Validar que el ID sea un número entero y no esté vacío
if (!$id || !filter_var($id, FILTER_VALIDATE_INT)) {
    // Si el ID no es válido, redirigir a la página principal con un error
    header("Location: index.php?status=error&message=" . urlencode("ID de paciente no válido."));
    exit;
}

try {
    // Preparar la consulta SQL para eliminar el paciente
    $sql = "DELETE FROM pacientes WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    // Ejecutar la consulta con el ID del paciente
    $stmt->execute([$id]);

    // Verificar si se eliminó alguna fila
    if ($stmt->rowCount() > 0) {
        // Si se eliminó, redirigir con un mensaje de éxito
        header("Location: index.php?status=deleted");
        exit;
    } else {
        // Si no se encontró el paciente (ya fue eliminado, por ejemplo)
        header("Location: index.php?status=error&message=" . urlencode("No se encontró el paciente para eliminar."));
        exit;
    }

} catch (PDOException $e) {
    // Manejar errores de la base de datos y redirigir con un mensaje de error
    header("Location: index.php?status=error&message=" . urlencode("Error al eliminar el paciente: " . $e->getMessage()));
    exit;
}
?>
