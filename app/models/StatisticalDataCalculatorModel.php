<?php
/**
 * Modelo StatisticalDataCalculatorModel
 * Encapsula la lógica de cálculo de estadísticas para un conjunto de notas.
 */

namespace App\Models;

use App\Utilities\MathUtility;

class StatisticalDataCalculatorModel
{
    /**
     * Calcula estadísticas (media, desviación estándar, mínimo y máximo)
     * para un conjunto de notas.
     *
     * @param array $notes Array de números
     * @return array
     */
    public function calculate(array $notes): array
    {
        $normalized = array_map(static fn($v) => (float)$v, $notes);

        return [
            'count' => count($normalized),
            'mean' => MathUtility::calculateMean($normalized),
            'standardDeviation' => MathUtility::calculateStandardDeviation($normalized),
            'min' => MathUtility::getMin($normalized),
            'max' => MathUtility::getMax($normalized),
            'notes' => $normalized,
        ];
    }

    /**
     * Prepara data para gráfica (Chart.js) usando distribución simple.
     *
     * @param array $statistics
     * @return array
     */
    public function getChartData(array $statistics): array
    {
        $notes = $statistics['notes'] ?? [];

        $labels = [];
        $data = [];
        foreach ($notes as $index => $note) {
            $labels[] = 'Nota ' . ((int)$index + 1);
            $data[] = (float)$note;
        }

        $colors = [
            'rgba(22, 163, 74, 0.75)',
            'rgba(46, 204, 113, 0.75)',
            'rgba(39, 174, 96, 0.75)',
            'rgba(52, 152, 219, 0.65)',
            'rgba(155, 89, 182, 0.55)',
        ];

        $backgroundColors = [];
        $borderColors = [];
        foreach ($data as $i => $_) {
            $color = $colors[$i % count($colors)];
            $backgroundColors[] = $color;
            $borderColors[] = $color;
        }

        return [
            'chartLabels' => $labels,
            'chartData' => $data,
            'chartBackgroundColors' => $backgroundColors,
            'chartBorderColors' => $borderColors,
        ];
    }
}
?>

