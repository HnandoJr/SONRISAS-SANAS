<?php
/*
config.php
Este archivo contiene las credenciales de la base de datos y establece la conexión con MySQL.
*/

// --- Configuración de la Base de Datos ---
// Reemplaza estos valores con tus credenciales reales.
// Por seguridad, en un entorno de producción se recomienda usar variables de entorno.

define('DB_HOST', '127.0.0.1'); // Host de la base de datos (usualmente 'localhost')
define('DB_USER', 'root');      // Usuario de la base de datos
define('DB_PASS', '');          // Contraseña del usuario (vacía por defecto en XAMPP)
define('DB_NAME', 'sonrisasana'); // Nombre de la base de datos

// --- Conexión a la Base de Datos ---
try {
    // Crear una nueva instancia de PDO
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

    // Configurar el modo de error de PDO para que lance excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Opcional: Establecer el juego de caracteres a utf8mb4 para soporte completo de Unicode
    $pdo->exec("SET NAMES 'utf8mb4'");

} catch(PDOException $e) {
    // Si la conexión falla, terminar el script y mostrar un mensaje de error.
    // En una aplicación real, se manejaría este error de forma más elegante (ej. registrando el error).
    die("ERROR: No se pudo conectar a la base de datos. " . $e->getMessage());
}
?>
