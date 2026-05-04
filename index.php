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
        <!-- Panel Lateral: Registro -->
        <aside class="card">
            <h2>Registrar Paciente</h2>
            <p style="font-size: 0.85rem; color: #666; margin-bottom: 1rem;">Complete los datos básicos para ingresar un nuevo paciente al sistema.</p>

            <form action="guardar_paciente.php" method="POST" id="registro-form">
                <div class="form-group">
                    <label for="nombre_completo">Nombre Completo *</label>
                    <input type="text" id="nombre_completo" name="nombre_completo" placeholder="Ej: Juan Pérez" required>
                </div>

                <div class="form-group">
                    <label for="tipo_documento">Tipo de Documento *</label>
                    <input type="text" id="tipo_documento" name="tipo_documento" placeholder="Ej: Cédula de Ciudadanía" required>
                </div>

                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento *</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
                </div>

                <div class="form-group">
                    <label for="edad">Edad</label>
                    <input type="number" id="edad" name="edad" readonly placeholder="Calculado automáticamente">
                </div>

                <div class="form-group">
                    <label for="celular">Celular *</label>
                    <input type="tel" id="celular" name="celular" placeholder="300 123 4567" required>
                </div>

                <div class="form-group">
                    <label for="eps">EPS *</label>
                    <input type="text" id="eps" name="eps" placeholder="Nombre de la EPS" required>
                </div>

                <hr style="border: 0; border-top: 1px solid #eee; margin: 1.5rem 0;">

                <p style="font-weight: 600; font-size: 0.9rem; color: #0056b3;">Información de Contacto (Opcional)</p>

                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" id="direccion" name="direccion" placeholder="Calle/Carrera # 00 - 00">
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono Fijo</label>
                    <input type="tel" id="telefono" name="telefono">
                </div>

                <div class="form-group">
                    <label for="contacto_adicional_nombre">Contacto de Emergencia</label>
                    <input type="text" id="contacto_adicional_nombre" name="contacto_adicional_nombre" placeholder="Nombre del familiar">
                </div>

                <div class="form-group">
                    <label for="contacto_adicional_parentesco">Parentesco</label>
                    <input type="text" id="contacto_adicional_parentesco" name="contacto_adicional_parentesco" placeholder="Ej: Madre, Padre, Esposo(a)">
                </div>

                <div style="margin-top: 1.5rem;">
                    <button type="submit" class="btn">Registrar Paciente</button>
                </div>
            </form>
        </aside>

        <!-- Panel Principal: Lista y Búsqueda -->
        <main class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
                <h2 style="margin-bottom: 0;">Pacientes Registrados</h2>

                <div class="search-container" style="margin-bottom: 0; flex-grow: 1; max-width: 400px;">
                    <input type="text" id="search-input" placeholder="Buscar por nombre o documento...">
                </div>
            </div>

            <div id="lista-pacientes" class="table-responsive">
                <!-- La lista de pacientes se cargará aquí vía AJAX -->
                <p style="text-align: center; padding: 2rem;">Cargando pacientes...</p>
            </div>
        </main>
    </div>

    <!-- Contenedor para Notificaciones (Toast) -->
    <div id="toast-container"></div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Centro Odontológico Sonrisa Sana - Sistema de Gestión de Pacientes</p>
    </footer>

    <script src="js/main.js" defer></script>
</body>
</html>
