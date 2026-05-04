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
    header("Location: index.php");
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM pacientes WHERE id = ?");
    $stmt->execute([$id]);
    $paciente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$paciente) {
        $error = "No se encontró ningún paciente con el ID proporcionado.";
    }
} catch (PDOException $e) {
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
</head>
<body>
    <header>
        <h1>Centro Odontológico Sonrisa Sana</h1>
    </header>

    <div class="container container-single">
        <div class="card">
            <h2>Editar Información del Paciente</h2>

            <?php if ($error): ?>
                <div style="background: #fff1f0; border: 1px solid #ffa39e; padding: 1rem; border-radius: 4px; color: #cf1322; margin-bottom: 1.5rem;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
                <a href="index.php" class="btn btn-secondary">Volver a la lista</a>
            <?php elseif ($paciente): ?>
                <form action="actualizar_paciente.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($paciente['id']); ?>">

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div class="form-group">
                            <label for="nombre_completo">Nombre Completo *</label>
                            <input type="text" id="nombre_completo" name="nombre_completo" value="<?php echo htmlspecialchars($paciente['nombre_completo']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="tipo_documento">Tipo de Documento *</label>
                            <input type="text" id="tipo_documento" name="tipo_documento" value="<?php echo htmlspecialchars($paciente['tipo_documento']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha de Nacimiento *</label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo htmlspecialchars($paciente['fecha_nacimiento']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="edad">Edad</label>
                            <input type="number" id="edad" name="edad" value="<?php echo htmlspecialchars($paciente['edad']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="celular">Celular *</label>
                            <input type="tel" id="celular" name="celular" value="<?php echo htmlspecialchars($paciente['celular']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="eps">EPS *</label>
                            <input type="text" id="eps" name="eps" value="<?php echo htmlspecialchars($paciente['eps']); ?>" required>
                        </div>
                    </div>

                    <hr style="border: 0; border-top: 1px solid #eee; margin: 1.5rem 0;">

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($paciente['direccion']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono Fijo</label>
                            <input type="tel" id="telefono" name="telefono" value="<?php echo htmlspecialchars($paciente['telefono']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="contacto_adicional_nombre">Contacto de Emergencia</label>
                            <input type="text" id="contacto_adicional_nombre" name="contacto_adicional_nombre" value="<?php echo htmlspecialchars($paciente['contacto_adicional_nombre']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="contacto_adicional_parentesco">Parentesco</label>
                            <input type="text" id="contacto_adicional_parentesco" name="contacto_adicional_parentesco" value="<?php echo htmlspecialchars($paciente['contacto_adicional_parentesco']); ?>">
                        </div>
                    </div>

                    <div style="margin-top: 2rem; display: flex; gap: 1rem;">
                        <button type="submit" class="btn">Actualizar Paciente</button>
                        <a href="index.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <script src="js/main.js" defer></script>
</body>
</html>
