<?php
/*
listar_pacientes.php
Este script se conecta a la base de datos, recupera pacientes
y los muestra en una tabla HTML. Soporta búsqueda.
*/

require 'config.php';

// Obtener el término de búsqueda si existe
$search = $_GET['search'] ?? '';

try {
    // Preparar la consulta SQL con filtro de búsqueda
    $query = "SELECT id, nombre_completo, tipo_documento, celular, eps FROM pacientes";
    $params = [];

    if (!empty($search)) {
        $query .= " WHERE nombre_completo LIKE ? OR tipo_documento LIKE ?";
        $params[] = "%$search%";
        $params[] = "%$search%";
    }

    $query .= " ORDER BY nombre_completo ASC";

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);

    // Generar la tabla
    if ($stmt->rowCount() > 0) {
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Nombre Completo</th>";
        echo "<th>Documento</th>";
        echo "<th>Celular</th>";
        echo "<th>EPS</th>";
        echo "<th style='text-align: center;'>Acciones</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nombre_completo']) . "</td>";
            echo "<td>" . htmlspecialchars($row['tipo_documento']) . "</td>";
            echo "<td>" . htmlspecialchars($row['celular']) . "</td>";
            echo "<td>" . htmlspecialchars($row['eps']) . "</td>";
            echo "<td class='actions' style='justify-content: center;'>";
            echo "<a href='editar_paciente.php?id=" . $row['id'] . "' class='edit'>Editar</a>";
            echo "<a href='eliminar_paciente.php?id=" . $row['id'] . "' class='delete' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este paciente?\");'>Eliminar</a>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<div style='padding: 2rem; text-align: center; color: #666;'>";
        echo empty($search) ? "No hay pacientes registrados aún." : "No se encontraron pacientes que coincidan con la búsqueda.";
        echo "</div>";
    }

} catch(PDOException $e) {
    echo "<div style='color: var(--error-color); padding: 1rem;'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
}
?>
