<?php
/*
editar_paciente.php
Página para editar la información de un paciente existente.
*/

// Incluir la configuración de la base de datos
require 'config.php';

// Inicializar variables
$paciente = null;
$error = '';
$id = $_GET['id'] ?? null;

// Validar que el ID sea un número entero
if (!$id || !filter_var($id, FILTER_VALIDATE_INT)) {
    // Si el ID no es válido, redirigir a la página principal
    header("Location: index.php");
    exit;
}

try {
    // Buscar el paciente en la base de datos por su ID
    $stmt = $pdo->prepare("SELECT * FROM pacientes WHERE id = ?");
    $stmt->execute([$id]);
    $paciente = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si no se encuentra un paciente con ese ID, mostrar un error
    if (!$paciente) {
        $error = "No se encontró ningún paciente con el ID proporcionado.";
    }
} catch (PDOException $e) {
    // Manejar errores de la base de datos
    $error = "Error al obtener los datos del paciente: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Paciente - Sonrisa Sana</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Estilos adicionales para la página de edición */
        .container-edit {
            grid-template-columns: 1fr; /* Una sola columna para la página de edición */
        }
        .form-container a {
            display: inline-block;
            margin-top: 15px;
            color: #0056b3;
            text-decoration: none;
        }
        .form-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Centro Odontológico Sonrisa Sana</h1>
    </header>

    <div class="container container-edit">
        <div class="form-container">
            <h2>Editar Paciente</h2>

            <?php if ($error): ?>
                <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
                <a href="index.php">Volver a la lista</a>
            <?php elseif ($paciente): ?>
                <form action="actualizar_paciente.php" method="POST">
                    <!-- Campo oculto para enviar el ID del paciente -->
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($paciente['id']); ?>">

                    <div class="form-group">
                        <label for="nombre_completo">Nombre Completo:</label>
                        <input type="text" id="nombre_completo" name="nombre_completo" value="<?php echo htmlspecialchars($paciente['nombre_completo']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tipo_documento">Tipo de Documento:</label>
                        <input type="text" id="tipo_documento" name="tipo_documento" value="<?php echo htmlspecialchars($paciente['tipo_documento']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($paciente['direccion']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" id="telefono" name="telefono" value="<?php echo htmlspecialchars($paciente['telefono']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="celular">Celular:</label>
                        <input type="tel" id="celular" name="celular" value="<?php echo htmlspecialchars($paciente['celular']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo htmlspecialchars($paciente['fecha_nacimiento']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="edad">Edad:</label>
                        <input type="number" id="edad" name="edad" value="<?php echo htmlspecialchars($paciente['edad']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="eps">EPS:</label>
                        <input type="text" id="eps" name="eps" value="<?php echo htmlspecialchars($paciente['eps']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="contacto_adicional_nombre">Nombre Contacto Adicional:</label>
                        <input type="text" id="contacto_adicional_nombre" name="contacto_adicional_nombre" value="<?php echo htmlspecialchars($paciente['contacto_adicional_nombre']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="contacto_adicional_parentesco">Parentesco:</label>
                        <input type="text" id="contacto_adicional_parentesco" name="contacto_adicional_parentesco" value="<?php echo htmlspecialchars($paciente['contacto_adicional_parentesco']); ?>">
                    </div>
                    <div class="form-group">
                        <button type="submit">Actualizar Paciente</button>
                    </div>
                </form>
                <a href="index.php">Cancelar y Volver</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
