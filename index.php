<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Pacientes - Sonrisa Sana</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Centro Odontológico Sonrisa Sana</h1>
    </header>

    <div class="container">
        <!-- Formulario para Registrar Nuevos Pacientes -->
        <div class="form-container">
            <h2>Registrar Nuevo Paciente</h2>
            <form action="guardar_paciente.php" method="POST" id="registro-form">
                <div class="form-group">
                    <label for="nombre_completo">Nombre Completo:</label>
                    <input type="text" id="nombre_completo" name="nombre_completo" required>
                </div>
                <div class="form-group">
                    <label for="tipo_documento">Tipo de Documento:</label>
                    <input type="text" id="tipo_documento" name="tipo_documento" required>
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="tel" id="telefono" name="telefono" required>
                </div>
                <div class="form-group">
                    <label for="celular">Celular:</label>
                    <input type="tel" id="celular" name="celular" required>
                </div>
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
                </div>
                <div class="form-group">
                    <label for="edad">Edad:</label>
                    <input type="number" id="edad" name="edad" required>
                </div>
                <div class="form-group">
                    <label for="eps">EPS:</label>
                    <input type="text" id="eps" name="eps" required>
                </div>
                <div class="form-group">
                    <label for="contacto_adicional_nombre">Nombre Contacto Adicional:</label>
                    <input type="text" id="contacto_adicional_nombre" name="contacto_adicional_nombre">
                </div>
                <div class="form-group">
                    <label for="contacto_adicional_parentesco">Parentesco:</label>
                    <input type="text" id="contacto_adicional_parentesco" name="contacto_adicional_parentesco">
                </div>
                <div class="form-group">
                    <button type="submit">Registrar Paciente</button>
                </div>
            </form>
        </div>

        <!-- Aquí se mostrará la lista de pacientes -->
        <div class="list-container">
            <h2>Pacientes Registrados</h2>
            <div id="lista-pacientes">
                <!-- La lista de pacientes se cargará aquí -->
            </div>
        </div>
    </div>

    <script src="js/main.js" defer></script>
</body>
</html>
