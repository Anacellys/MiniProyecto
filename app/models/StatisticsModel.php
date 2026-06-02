<?php
/**
 * Modelo StatisticsModel
 * Gestiona la lógica para el Problema #1
 * Calcula media, desviación estándar, mínimo y máximo
 *
 * @author anacelis
 */

namespace App\Models;

use App\Utilities\MathUtility;

class StatisticsModel
{
    private array $numbers = [];

   
    public function __construct(array $numbers = [])
    {
        $this->numbers = $numbers;
    }

  
    public function setNumbers(array $numbers): void
    {
        $this->numbers = $numbers;
    }


    public function getNumbers(): array
    {
        return $this->numbers;
    }

  
    public function getMean(): float
    {
        return MathUtility::calculateMean($this->numbers);
    }

   
    public function getStandardDeviation(): float
    {
        return MathUtility::calculateStandardDeviation($this->numbers);
    }

    
    public function getMin()
    {
        return MathUtility::getMin($this->numbers);
    }

    
    public function getMax()
    {
        return MathUtility::getMax($this->numbers);
    }

    public function getAllStatistics(): array
    {
        return [
            'numbers' => $this->numbers,
            'count' => count($this->numbers),
            'mean' => $this->getMean(),
            'standardDeviation' => $this->getStandardDeviation(),
            'min' => $this->getMin(),
            'max' => $this->getMax(),
            'sum' => array_sum($this->numbers),
        ];
    }
}
?>
