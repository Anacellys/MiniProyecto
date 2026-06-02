<?php
/**
 * Clase MathUtility
 * Proporciona métodos estáticos para operaciones matemáticas
 * Reutilizable en múltiples problemas
    * @author anaacelis
 */

namespace App\Utilities;

class MathUtility
{
    /**
     * Calcula la media aritmética de un arreglo de números
     *
     * @param array $numbers Arreglo de números
     * @return float Media aritmética
     */
    public static function calculateMean(array $numbers): float
    {
        if (empty($numbers)) {
            return 0;
        }
        return array_sum($numbers) / count($numbers);
    }

    /**
     * Calcula la desviación estándar de un arreglo de números
     *
     
     */
    public static function calculateStandardDeviation(array $numbers): float
    {
        if (empty($numbers)) {
            return 0;
        }

        $mean = self::calculateMean($numbers);
        $sumSquaredDifferences = 0;

        foreach ($numbers as $number) {
            $sumSquaredDifferences += pow($number - $mean, 2);
        }

        $variance = $sumSquaredDifferences / count($numbers);
        return sqrt($variance);
    }

    /**
     * Obtiene el valor mínimo de un arreglo
     *
     * @param array $numbers Arreglo de números
     * @return float|int Valor mínimo
     */
    public static function getMin(array $numbers)
    {
        if (empty($numbers)) {
            return null;
        }
        return min($numbers);
    }

    /**
     * Obtiene el valor máximo de un arreglo
     *
     * @param array $numbers Arreglo de números
     * @return float|int Valor máximo
     */
    public static function getMax(array $numbers)
    {
        if (empty($numbers)) {
            return null;
        }
        return max($numbers);
    }

    /**
     * Calcula la suma de números del 1 al N
     *
     * @param int $n Número limite
     * @return int Suma total
     */
    public static function sumFromOneToN(int $n): int
    {
        $sum = 0;
        for ($i = 1; $i <= $n; $i++) {
            $sum += $i;
        }
        return $sum;
    }

    /**
     * Genera los N primeros múltiplos de un número
     *
     * @param int $multiplier Número a multiplicar
     * @param int $count Cantidad de múltiplos
     * @return array Arreglo de múltiplos
     */
    public static function generateMultiples(int $multiplier, int $count): array
    {
        $multiples = [];
        for ($i = 1; $i <= $count; $i++) {
            $multiples[] = $multiplier * $i;
        }
        return $multiples;
    }
}
?>
