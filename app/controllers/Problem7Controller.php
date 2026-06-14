<?php
/**
 * Controlador Problem7Controller
 * Problema 7: Presupuesto Hospitalario
 */

namespace App\Controllers;

use App\Models\HospitalBudgetModel;
use App\Utilities\SecurityUtility;
use App\Utilities\ValidationUtility;

class Problem7Controller
{
    private HospitalBudgetModel $model;

    public function __construct()
    {
        $this->model = new HospitalBudgetModel();
    }

    public function handle(): void
    {
        $result = null;
        $errors = [];
        $formData = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->processForm($errors, $formData);
        }

        include VIEWS_PATH . 'problem7.php';
    }

    private function processForm(array &$errors, array &$formData): ?array
    {
        $csrfToken = isset($_POST['csrf_token']) ? (string) $_POST['csrf_token'] : '';
        if (!SecurityUtility::verifyCsrfToken($csrfToken)) {
            $errors[] = 'Solicitud no válida. Intenta nuevamente.';
            return null;
        }

        $budgetRaw = $_POST['budget_total'] ?? null;
        $budgetSanitized = SecurityUtility::sanitizeInput($budgetRaw);
        $formData['budget_total'] = $budgetSanitized;

        // Regla: 0 => mensaje exacto.
        $budgetFloat = is_numeric($budgetSanitized) ? (float)$budgetSanitized : null;
        if ($budgetFloat === 0.0) {
            $errors[] = 'Piense en la Salud y agregue un presupuesto';
            return null;
        }

        // Regla: negativo => error indicando que no se aceptan < 0.
        if ($budgetFloat !== null && $budgetFloat < 0) {
            $errors[] = 'No se aceptan valores menores a 0 para el presupuesto.';
            return null;
        }

        // Validación positiva (OWASP / prompt base)
        if (!ValidationUtility::isPositiveNumber($budgetSanitized)) {
            $errors[] = 'El presupuesto debe ser un número positivo.';
            return null;
        }

        $total = (float) $budgetSanitized;

        $distribution = $this->model->calculateDistribution($total);
        $chartData = $this->model->getChartDataFromDistribution($distribution);

        return [
            'distribution' => $distribution,
            'chart' => $chartData,
        ];
    }
}
?>



