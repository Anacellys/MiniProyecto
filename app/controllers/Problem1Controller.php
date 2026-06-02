<?php
/**
 * Controlador Problem1Controller
 * Gestiona las solicitudes para el Problema #1
 * Media, desviación estándar, mínimo y máximo
 * @author anacelis 
 */

namespace App\Controllers;

use App\Models\StatisticsModel;
use App\Utilities\ValidationUtility;
use App\Utilities\SecurityUtility;

class Problem1Controller
{
    private StatisticsModel $model;

   
    public function __construct()
    {
        $this->model = new StatisticsModel();
    }

   
    public function handle(): void
    {
        $result = null;
        $errors = [];
        $formData = [];

        // Procesar si es una solicitud POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->processForm($errors, $formData);
        }

        // Incluir la vista del formulario
        include VIEWS_PATH . 'problem1.php';
    }


    private function processForm(array &$errors, array &$formData): ?array
    {
        $numbers = [];

        // Procesar y validar los 5 números
        for ($i = 1; $i <= 5; $i++) {
            $fieldName = "number{$i}";

            if (isset($_POST[$fieldName])) {
                // Sanitizar entrada
                $value = SecurityUtility::sanitizeInput($_POST[$fieldName]);
                $formData[$fieldName] = $value;

                // Validar que sea un número positivo
                if (!ValidationUtility::isPositiveNumber($value)) {
                    $errors[] = "El número {$i} debe ser un valor positivo válido.";
                } else {
                    $numbers[] = (float)$value;
                }
            } else {
                $errors[] = "El número {$i} es obligatorio.";
            }
        }

        // Si no hay errores, calcular estadísticas
        if (empty($errors) && count($numbers) === 5) {
            $this->model->setNumbers($numbers);
            return $this->model->getAllStatistics();
        }

        return null;
    }
}
?>
