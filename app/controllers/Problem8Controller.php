<?php
/**
 * Controlador Problem8Controller
 * Calculadora de Datos Estadísticos
 */

namespace App\Controllers;

use App\Models\StatisticalDataCalculatorModel;
use App\Utilities\SecurityUtility;
use App\Utilities\ValidationUtility;

class Problem8Controller
{
    private StatisticalDataCalculatorModel $model;

    public function __construct()
    {
        $this->model = new StatisticalDataCalculatorModel();
    }

    public function handle(): void
    {
        $result = null;
        $errors = [];
        $formData = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->processForm($errors, $formData);
        }

        include VIEWS_PATH . 'problem8.php';
    }

    private function processForm(array &$errors, array &$formData): ?array
    {
        $csrfToken = isset($_POST['csrf_token']) ? (string) $_POST['csrf_token'] : '';
        if (!SecurityUtility::verifyCsrfToken($csrfToken)) {
            $errors[] = 'Solicitud no válida. Intenta nuevamente.';
            return null;
        }

        $countRaw = $_POST['count'] ?? null;
        $countSanitized = SecurityUtility::sanitizeInput($countRaw);
        $formData['count'] = $countSanitized;

        // Validación estricta (entero positivo)
        if (!ValidationUtility::isPositiveInteger($countSanitized)) {
            $errors[] = 'La cantidad de notas debe ser un entero positivo.';
            return null;
        }

        $count = (int) $countSanitized;
        if ($count <= 0) {
            $errors[] = 'La cantidad de notas es inválida.';
            return null;
        }

        $notes = [];
        for ($i = 1; $i <= $count; $i++) {
            $fieldName = "note{$i}";

            if (!isset($_POST[$fieldName])) {
                $errors[] = "La nota {$i} es obligatoria.";
                continue;
            }

            $rawValue = $_POST[$fieldName];
            $sanitized = SecurityUtility::sanitizeInput($rawValue);
            $formData[$fieldName] = $sanitized;

            if (!ValidationUtility::isPositiveNumber($sanitized)) {
                $errors[] = "La nota {$i} debe ser un número positivo válido.";
                continue;
            }

            $notes[] = (float) $sanitized;
        }

        if (!empty($errors) || count($notes) !== $count) {
            return null;
        }

        $statistics = $this->model->calculate($notes);
        $chartData = $this->model->getChartData($statistics);

        return [
            'statistics' => $statistics,
            'chart' => $chartData,
            'count' => $count,
        ];
    }
}
?>


