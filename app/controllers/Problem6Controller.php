<?php
/**
 * Controlador Problem6Controller
 * Clasificación de Edades
 */

namespace App\Controllers;

use App\Models\AgeClassificationModel;
use App\Utilities\SecurityUtility;
use App\Utilities\ValidationUtility;

class Problem6Controller
{
    private const PEOPLE_COUNT = 5;

    private AgeClassificationModel $model;

    public function __construct()
    {
        $this->model = new AgeClassificationModel();
    }

    public function handle(): void
    {
        $result = null;
        $errors = [];
        $formData = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->processForm($errors, $formData);
        }

        include VIEWS_PATH . 'problem6.php';
    }

    private function processForm(array &$errors, array &$formData): ?array
    {
        $csrfToken = isset($_POST['csrf_token']) ? (string) $_POST['csrf_token'] : '';
        if (!SecurityUtility::verifyCsrfToken($csrfToken)) {
            $errors[] = 'Solicitud no válida. Intenta nuevamente.';
            return null;
        }

        $ages = [];

        for ($i = 1; $i <= self::PEOPLE_COUNT; $i++) {
            $fieldName = "age{$i}";

            if (!isset($_POST[$fieldName])) {
                $errors[] = "La edad {$i} es obligatoria.";
                continue;
            }

            $rawValue = $_POST[$fieldName];
            $sanitized = SecurityUtility::sanitizeInput($rawValue);
            $formData[$fieldName] = $sanitized;

            // "Permite 0" según enunciado: 0-...
            if (!ValidationUtility::isPositiveInteger($sanitized)) {
                $valueInt = (int)$sanitized;
                if ($valueInt === 0) {
                    $ages[] = 0;
                    continue;
                }
                $errors[] = "La edad {$i} debe ser un entero entre 0 y 150 aprox. (no negativo).";
                continue;
            }

            $ages[] = (int)$sanitized;
        }

        if (!empty($errors) || count($ages) !== self::PEOPLE_COUNT) {
            return null;
        }

        $statistics = $this->model->getStatistics($ages);
        $chartData = $this->model->getChartData($statistics);

        return [
            'ages' => $ages,
            'statistics' => $statistics,
            'chart' => $chartData,
        ];
    }
}
?>

