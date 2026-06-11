<?php
/**
 * Controlador Problem7Controller
 * Problema 7: Presupuesto Hospitalario
 */

namespace App\Controllers;

use App\Models\HospitalBudgetModel;
use App\Utilities\SecurityUtility;

class Problem7Controller
{
    private HospitalBudgetModel $model;

    public function __construct()
    {
        $this->model = new HospitalBudgetModel();
    }

    public function handle(): void
    {
        $distributionInfo = $this->model->getDistributionInfo();
        $chartData = $this->model->getChartData($distributionInfo);

        $distributionInfo['total'] = (float)$distributionInfo['total'];

        include VIEWS_PATH . 'problem7.php';
    }
}
?>

