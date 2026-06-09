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

    private const BUDGETS = [
        self::AREA_GYNECOLOGY => 8000.00,
        self::AREA_TRAUMATOLOGY => 7000.00,
        self::AREA_PEDIATRICS => 5000.00,
    ];

    public function getAreas(): array
    {
        return array_keys(self::BUDGETS);
    }

    public function getBudgetByArea(string $area): ?float
    {
        return self::BUDGETS[$area] ?? null;
    }

    public function getDistributionInfo(): array
    {
        $budgets = self::BUDGETS;
        $total = 0.0;
        foreach ($budgets as $value) {
            $total += (float)$value;
        }

        $percentages = [];
        foreach ($budgets as $area => $value) {
            $percentages[$area] = $total > 0 ? ((float)$value / $total) * 100 : 0.0;
        }

        return [
            'budgets' => $budgets,
            'total' => $total,
            'percentages' => $percentages,
        ];
    }

    public function getChartData(array $distributionInfo): array
    {
        $labels = [];
        $data = [];
        $backgroundColors = [];

        $colorPrimary = 'rgba(22, 163, 74, 0.80)'; // #16a34a
        $colorSecondary = 'rgba(46, 204, 113, 0.85)';
        $colorAccent = 'rgba(39, 174, 96, 0.85)';

        foreach ($distributionInfo['budgets'] as $area => $budget) {
            $labels[] = $area;
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

