<?php
/**
 * Controlador Problem9Controller
 * Problema 9: Potencias
 */

namespace App\Controllers;

use App\Models\PowersModel;
use App\Utilities\SecurityUtility;
use App\Utilities\ValidationUtility;

class Problem9Controller
{
    private const POWERS_COUNT = 15;

    public function handle(): void
    {
        $result = null;
        $errors = [];
        $formData = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->processForm($errors, $formData);
        }

        include VIEWS_PATH . 'problem9.php';
    }

    private function processForm(array &$errors, array &$formData): ?array
    {
        $csrfToken = isset($_POST['csrf_token']) ? (string) $_POST['csrf_token'] : '';
        if (!SecurityUtility::verifyCsrfToken($csrfToken)) {
            $errors[] = 'Solicitud no válida. Intenta nuevamente.';
            return null;
        }

        $nRaw = $_POST['number'] ?? null;
        $nSanitized = SecurityUtility::sanitizeInput($nRaw);
        $formData['number'] = $nSanitized;

        if (!ValidationUtility::isPositiveInteger($nSanitized)) {
            $errors[] = 'El número debe ser un entero positivo entre 1 y 9.';
            return null;
        }

        $n = (int) $nSanitized;
        if ($n < 1 || $n > 9) {
            $errors[] = 'El número debe ser un entero positivo entre 1 y 9.';
            return null;
        }

        $model = new PowersModel($n);
        $info = $model->getPowersInfo(self::POWERS_COUNT);

        // Ajustar labels correctamente según base
        $labels = [];
        foreach ($info['powers'] as $idx => $_value) {
            $exp = $idx + 1;
            $labels[] = $n . '^' . $exp;
        }

        $info['chart'] = [
            'chartLabels' => $labels,
            'chartData' => $info['powers'],
        ];

        return [
            'info' => $info,
        ];
    }
}
?>

