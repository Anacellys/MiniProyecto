<?php
/**
 * Controlador Problem2Controller
 * Gestiona las solicitudes para el Problema #2
 * Suma de números del 1 al 1000 con procedimiento
 *
 * @author Anacelly
 */

namespace App\Controllers;

use App\Models\SeriesModel;

class Problem2Controller
{
    private SeriesModel $model;

   
    public function __construct()
    {
        // Crear el modelo con límite de 1000
        $this->model = new SeriesModel(1000);
    }

   
    public function handle(): void
    {
        $calculationInfo = $this->model->getCalculationInfo();

        // Incluir la vista con los resultados
        include VIEWS_PATH . 'results' . DIRECTORY_SEPARATOR . 'problem2_result.php';
    }
}
?>
