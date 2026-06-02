<?php
/**
 * Clase SecurityUtility
 * Proporciona métodos estáticos para seguridad (OWASP)
 * Protección contra XSS, inyección HTML 
 */

namespace App\Utilities;

class SecurityUtility
{
    /**
     * Sanitiza una cadena contra XSS
     * Aplica htmlspecialchars() para escapar caracteres especiales
     *
     * @param mixed $value Valor a sanitizar
     * @param int $flags Flags de htmlspecialchars
     * @return string Valor sanitizado
     */

    
    public static function sanitizeOutput($value, int $flags = ENT_QUOTES): string
    {
        return htmlspecialchars((string)$value, $flags, 'UTF-8');
    }

    /**
     * Sanitiza una entrada de formulario
     * Elimina espacios en blanco y aplica htmlspecialchars
     *
     * @param mixed $input Entrada a sanitizar
     * @return string Entrada sanitizada
     */
    public static function sanitizeInput($input): string
    {
        return htmlspecialchars(trim((string)$input), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Escapa una cadena para HTML
     *
     * @param string $string Cadena a escapar
     * @return string Cadena escapada
     */
    public static function escapeHtml(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Escapa una cadena para atributos HTML
     *
     * @param string $string Cadena a escapar
     * @return string Cadena escapada
     */
    public static function escapeAttribute(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    /**
     * Valida y sanitiza una URL
     *
     * @param string $url URL a validar
     * @return string|false URL sanitizada o false si no es válida
     */
    public static function sanitizeUrl(string $url)
    {
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    /**
     * Genera un token CSRF (puede ampliarse)
     *
     * @return string Token CSRF
     */
    public static function generateCsrfToken(): string
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Verifica un token CSRF
     *
     * @param string $token Token a verificar
     * @return bool True si es válido, false en caso contrario
     */
    public static function verifyCsrfToken(string $token): bool
    {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
}
?>
