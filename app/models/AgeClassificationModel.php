<?php
/**
 * Modelo AgeClassificationModel
 * Clasifica edades y genera estadísticas para gráficas.
 */

namespace App\Models;

class AgeClassificationModel
{
    public const CATEGORY_CHILD = 'Niño (0–12)';
    public const CATEGORY_TEEN = 'Adolescente (13–17)';
    public const CATEGORY_ADULT = 'Adulto (18–64)';
    public const CATEGORY_SENIOR = 'Adulto mayor (65+)';

    /**
     * Clasifica una edad en su categoría.
     *
     * @param int $age
     * @return string
     */
    public function classifyAge(int $age): string
    {
        if ($age >= 0 && $age <= 12) {
            return self::CATEGORY_CHILD;
        }
        if ($age >= 13 && $age <= 17) {
            return self::CATEGORY_TEEN;
        }
        if ($age >= 18 && $age <= 64) {
            return self::CATEGORY_ADULT;
        }
        return self::CATEGORY_SENIOR;
    }

    /**
     * Genera estadísticas con conteos por categoría.
     *
     * @param array $ages Enteros
     * @return array
     */
    public function getStatistics(array $ages): array
    {
        $categories = [
            self::CATEGORY_CHILD,
            self::CATEGORY_TEEN,
            self::CATEGORY_ADULT,
            self::CATEGORY_SENIOR,
        ];

        $counts = [
            self::CATEGORY_CHILD => 0,
            self::CATEGORY_TEEN => 0,
            self::CATEGORY_ADULT => 0,
            self::CATEGORY_SENIOR => 0,
        ];

        $classifications = [];
        foreach ($ages as $index => $age) {
            $category = $this->classifyAge((int)$age);
            $classifications[] = [
                'personIndex' => (int)$index + 1,
                'age' => (int)$age,
                'category' => $category,
            ];
            $counts[$category]++;
        }

        return [
            'counts' => $counts,
            'classifications' => $classifications,
            'categories' => $categories,
        ];
    }

    /**
     * Construye un dataset compatible con Chart.js (barras).
     *
     * @param array $statistics
     * @return array
     */
    public function getChartData(array $statistics): array
    {
        $categories = $statistics['categories'];
        $counts = $statistics['counts'];

        $labels = [];
        $data = [];

        foreach ($categories as $category) {
            $labels[] = $category;
            $data[] = (int)($counts[$category] ?? 0);
        }

        // Colores en tonos verdes y complementarios.
        $colors = [
            'rgba(46, 204, 113, 0.85)', // verde
            'rgba(39, 174, 96, 0.85)',  // verde más oscuro
            'rgba(52, 152, 219, 0.85)', // azul suave
            'rgba(155, 89, 182, 0.85)', // morado suave
        ];

        return [
            'chartLabels' => $labels,
            'chartData' => $data,
            'chartColors' => $colors,
        ];
    }
}
?>

