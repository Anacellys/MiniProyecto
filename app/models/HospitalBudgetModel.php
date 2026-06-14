<?php
/**
 * Modelo HospitalBudgetModel
 * Encapsula los datos y lógica de distribución del presupuesto hospitalario.
 */

namespace App\Models;

class HospitalBudgetModel
{
    public const AREA_GYNECOLOGY = 'Ginecología';
    public const AREA_TRAUMATOLOGY = 'Traumatología';
    public const AREA_PEDIATRICS = 'Pediatría';

    /**
     * Porcentajes fijos del problema.
     */
    private const PERCENTAGES = [
        self::AREA_GYNECOLOGY => 40.0,
        self::AREA_TRAUMATOLOGY => 35.0,
        self::AREA_PEDIATRICS => 25.0,
    ];

    public function getAreas(): array
    {
        return array_keys(self::PERCENTAGES);
    }

    /**
     * Calcula la distribución del presupuesto en base al total ingresado.
     *
     * @param float $totalBudget Presupuesto total (debe ser > 0 desde el controlador).
     * @return array{total: float, budgets: array<string,float>, percentages: array<string,float>}
     */
    public function calculateDistribution(float $totalBudget): array
    {
        $budgets = [];
        $percentages = self::PERCENTAGES;

        foreach (self::PERCENTAGES as $area => $percentage) {
            $budgets[$area] = ((float)$percentage / 100.0) * (float)$totalBudget;
        }

        return [
            'total' => (float)$totalBudget,
            'budgets' => $budgets,
            'percentages' => $percentages,
        ];
    }

    /**
     * Prepara datos para Chart.js a partir de una distribución calculada.
     *
     * @param array $distribution Distribución calculada por calculateDistribution().
     * @return array{chartLabels: array<int,string>, chartData: array<int,float>, chartColors: array<int,string>}
     */
    public function getChartDataFromDistribution(array $distribution): array
    {
        $labels = [];
        $data = [];
        $backgroundColors = [];

        $colorPrimary = 'rgba(22, 163, 74, 0.80)';
        $colorSecondary = 'rgba(46, 204, 113, 0.85)';
        $colorAccent = 'rgba(39, 174, 96, 0.85)';

        $budgets = $distribution['budgets'] ?? [];
        foreach ($budgets as $area => $budget) {
            $labels[] = (string)$area;
            $data[] = (float)$budget;

            if ($area === self::AREA_GYNECOLOGY) {
                $backgroundColors[] = $colorPrimary;
            } elseif ($area === self::AREA_TRAUMATOLOGY) {
                $backgroundColors[] = $colorSecondary;
            } else {
                $backgroundColors[] = $colorAccent;
            }
        }

        return [
            'chartLabels' => $labels,
            'chartData' => $data,
            'chartColors' => $backgroundColors,
        ];
    }
}
?>



