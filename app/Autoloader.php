<?php
/**
 * Autoloader PSR-4
 * Carga automáticamente las clases de la aplicación
 *
 * @author Desarrollador Senior PHP
 * @version 1.0
 */

namespace App;

class Autoloader
{
    /**
     * Registra el autoloader en spl_autoload_register
     *
     * @return void
     */
    public static function register(): void
    {
        spl_autoload_register([self::class, 'autoload']);
    }

    /**
     * Carga automáticamente las clases según el namespace
     *
     * @param string $class Nombre completamente calificado de la clase
     * @return void
     */
    public static function autoload(string $class): void
    {
        // Prefijo del namespace
        $prefix = 'App\\';

        // Verificar si la clase usa el prefijo correcto
        if (strpos($class, $prefix) !== 0) {
            return;
        }

        // Obtener la ruta relativa de la clase
        $relativeClass = substr($class, strlen($prefix));

        // Convertir el namespace a ruta de archivo
        $file = APP_PATH . str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
}

// samuel esto es una sugerencio de codigo en resume lo que hace es : register() activa el autoloader.
// autoload() transforma el namespace de una clase en la ruta de su archivo y lo carga.
// Esto evita tener que escribir manualmente require para cada clase.
