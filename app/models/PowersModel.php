<?php
/**
 * Modelo PowersModel
 * Encapsula la lógica de cálculo de potencias.
 */

namespace App\Models;

use App\Utilities\MathUtility;

class PowersModel
{
    private int $base;

    public function __construct(int $base)
    {
        $this->base = $base;
    }

    public function getBase(): int
    {
        return $this->base;
    }

    public function getPowers(int $count = 15): array
    {
        $powers = [];
        for ($exp = 1; $exp <= $count; $exp++) {
            $powers[] = (float) ($this->base ** $exp);
        }
        return $powers;
    }

    public function getPowersInfo(int $count = 15): array
    {
        $powers = $this->getPowers($count);

        $labels = [];
        $chartData = [];
        foreach ($powers as $idx => $value) {
            $labels[] = '2^' . ($idx + 1); // placeholder; replaced in controller
            $chartData[] = (float) $value;
        }

        return [
            'base' => $this->base,
            'count' => $count,
            'powers' => $powers,
            'chart' => [
                'chartLabels' => $labels,
                'chartData' => $chartData,
            ],
        ];
    }
}
?>

