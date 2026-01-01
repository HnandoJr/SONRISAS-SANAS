<?php
/*
listar_pacientes.php
Este script se conecta a la base de datos, recupera todos los pacientes
y los muestra en una tabla HTML.
*/

// Incluir el archivo de configuración para obtener la conexión a la base de datos
require 'config.php';

try {
    // Preparar la consulta SQL para seleccionar todos los pacientes
    $stmt = $pdo->query("SELECT id, nombre_completo, tipo_documento, celular, eps FROM pacientes ORDER BY nombre_completo ASC");

    // Iniciar la tabla HTML
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Nombre Completo</th>";
    echo "<th>Documento</th>";
    echo "<th>Celular</th>";
    echo "<th>EPS</th>";
    echo "<th>Acciones</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Recorrer los resultados y mostrar cada paciente en una fila de la tabla
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['nombre_completo']) . "</td>";
        echo "<td>" . htmlspecialchars($row['tipo_documento']) . "</td>";
        echo "<td>" . htmlspecialchars($row['celular']) . "</td>";
        echo "<td>" . htmlspecialchars($row['eps']) . "</td>";
        echo "<td class='actions'>";
        // En los siguientes pasos, estos enlaces apuntarán a editar_paciente.php y eliminar_paciente.php
        echo "<a href='editar_paciente.php?id=" . $row['id'] . "'>Editar</a>";
        echo "<a href='eliminar_paciente.php?id=" . $row['id'] . "' class='delete' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este paciente?\");'>Eliminar</a>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";

} catch(PDOException $e) {
    // Manejar errores de la base de datos
    echo "Error al recuperar la lista de pacientes: " . $e->getMessage();
}
?>
