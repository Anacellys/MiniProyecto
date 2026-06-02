<?php
/**
 * Modelo SeriesModel
 * Gestiona la lógica para el Problema #2
 * Calcula la suma de números del 1 al 1000 mostrando el procedimiento
 *
 * @author anacelis
 */

namespace App\Models;

use App\Utilities\MathUtility;

class SeriesModel
{
    private int $limit;
    private array $steps = [];
    private int $sum = 0;

   
    public function __construct(int $limit = 1000)
    {
        $this->limit = $limit;
        $this->calculateSum();
    }

  
    private function calculateSum(): void
    {
        $this->sum = 0;

        for ($i = 1; $i <= $this->limit; $i++) {
            $this->sum += $i;
            if ($i % 100 === 0 || $i === 1 || $i === $this->limit) {
                $this->steps[] = [
                    'number' => $i,
                    'sum' => $this->sum,
                ];
            }
        }
    }


    public function getLimit(): int
    {
        return $this->limit;
    }

    
    public function getSteps(): array
    {
        return $this->steps;
    }

  
    public function getSum(): int
    {
        return $this->sum;
    }

   
    public function getSumUsingUtility(): int
    {
        return MathUtility::sumFromOneToN($this->limit);
    }

   
    public function getCalculationInfo(): array
    {
        return [
            'limit' => $this->limit,
            'sum' => $this->sum,
            'steps' => $this->steps,
            'allStepsCount' => $this->limit,
        ];
    }
}
?>
