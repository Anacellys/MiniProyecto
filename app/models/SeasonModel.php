<?php
/**
 * Modelo SeasonModel
 * Encapsula la lógica de cálculo de la estación del año según día y mes.
 *
 * Reglas:
 * - Verano: 21 diciembre – 20 marzo
 * - Otoño: 21 marzo – 21 junio
 * - Invierno: 22 junio – 22 septiembre
 * - Primavera: 23 septiembre – 20 diciembre
 */

namespace App\Models;

use App\Utilities\MathUtility;

class SeasonModel
{
    public const SEASON_SUMMER = 'Verano';
    public const SEASON_AUTUMN = 'Otoño';
    public const SEASON_WINTER = 'Invierno';
    public const SEASON_SPRING = 'Primavera';

    private int $day;
    private int $month;

    public function __construct(int $day, int $month)
    {
        $this->day = $day;
        $this->month = $month;
    }

    public function getDay(): int
    {
        return $this->day;
    }

    public function getMonth(): int
    {
        return $this->month;
    }

    public function getSeason(): string
    {
        // Implementación por rangos sobre calendario (sin año).
        // Nota: Los límites se aplican tal como especifica el enunciado.

        // Verano: desde 21/12 hasta 20/03
        if (($this->month === 12 && $this->day >= 21) || ($this->month === 1) || ($this->month === 2) || ($this->month === 3 && $this->day <= 20)) {
            return self::SEASON_SUMMER;
        }

        // Otoño: 21/03 – 21/06
        if (($this->month === 3 && $this->day >= 21) || ($this->month === 4) || ($this->month === 5) || ($this->month === 6 && $this->day <= 21)) {
            return self::SEASON_AUTUMN;
        }

        // Invierno: 22/06 – 22/09
        if (($this->month === 6 && $this->day >= 22) || ($this->month === 7) || ($this->month === 8) || ($this->month === 9 && $this->day <= 22)) {
            return self::SEASON_WINTER;
        }

        // Primavera: 23/09 – 20/12
        return self::SEASON_SPRING;
    }

    public function getSeasonInfo(): array
    {
        return [
            'day' => $this->day,
            'month' => $this->month,
            'season' => $this->getSeason(),
        ];
    }
}
?>

