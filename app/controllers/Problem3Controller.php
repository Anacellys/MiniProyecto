<?php
/**
 * Controlador Problem3Controller
 * Gestiona las solicitudes para el Problema #3
 * N primeros múltiplos de 4
 * @author Anacelly
 */

namespace App\Controllers;

use App\Models\MultiplesModel;
use App\Utilities\ValidationUtility;
use App\Utilities\SecurityUtility;

class Problem3Controller
{
    private MultiplesModel $model;

    
    public function __construct()
    {
        $this->model = new MultiplesModel();
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
        include VIEWS_PATH . 'problem3.php';
    }

    
    private function processForm(array &$errors, array &$formData): ?array
    {
        if (isset($_POST['n'])) {
           
            $value = SecurityUtility::sanitizeInput($_POST['n']);
            $formData['n'] = $value;

    
            if (!ValidationUtility::isPositiveInteger($value)) {
                $errors[] = "Por favor ingrese un número entero positivo válido.";
            } else {
                $n = (int)$value;
                $this->model->setN($n);
                return $this->model->getMultiplesInfo();
            }
        } else {
            $errors[] = "El campo N es obligatorio.";
        }

        return null;
    }
}
?>
