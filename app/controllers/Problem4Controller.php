<?php
/**
 * Controlador Problem4Controller
 * Gestiona las solicitudes para el Problema #4
 * Suma de pares e impares del 1 al 200
 *
    * @author Anacelly
 */

namespace App\Controllers;

use App\Models\EvenOddModel;

class Problem4Controller
{
    private EvenOddModel $model;

    public function __construct()
    {
        // Crear el modelo con rango 1-200
        $this->model = new EvenOddModel(1, 200);
    }

   
    public function handle(): void
    {
        $completeInfo = $this->model->getCompleteInfo();

        // Incluir la vista con los resultados
        include VIEWS_PATH . 'results' . DIRECTORY_SEPARATOR . 'problem4_result.php';
    }
}
?>
