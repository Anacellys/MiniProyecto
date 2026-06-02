<?php
/**
 * Clase ValidationUtility
 * Proporciona métodos estáticos para validaciones
 * @author anaacelis
 */

namespace App\Utilities;

class ValidationUtility
{
    /**
     * Valida que un valor sea un número positivo
     *
     * @param mixed $value Valor a validar
     * @return bool True si es un número positivo, false en caso contrario
     */
    public static function isPositiveNumber($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_FLOAT) !== false && (float)$value > 0;
    }

    /**
     * Valida que un valor sea un número entero positivo
     *
     * @param mixed $value Valor a validar
     * @return bool True si es un entero positivo, false en caso contrario
     */
    public static function isPositiveInteger($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_INT) !== false && (int)$value > 0;
    }

    /**
     * Valida mediante expresión regular
     *
     * @param string $value Valor a validar
     * @param string $pattern Patrón regex
     * @return bool True si coincide, false en caso contrario
     */
    public static function validateWithRegex(string $value, string $pattern): bool
    {
        return preg_match($pattern, $value) === 1;
    }

    /**
     * Valida que un email sea válido
     *
     * @param string $email Email a validar
     * @return bool True si es válido, false en caso contrario
     */
    public static function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Valida que un valor no esté vacío
     *
     * @param mixed $value Valor a validar
     * @return bool True si no está vacío, false en caso contrario
     */
    public static function isNotEmpty($value): bool
    {
        return !empty(trim((string)$value));
    }
}
?>
