<?php
/**
 * Modelo EvenOddModel
 * Gestiona la lógica para el Problema #4
 * Calcula la suma de números pares e impares del 1 al 200
 *
 * @author Anacelly
 */

namespace App\Models;

class EvenOddModel
{
    private int $start;
    private int $end;
    private int $evenSum = 0;
    private int $oddSum = 0;
    private array $evenNumbers = [];
    private array $oddNumbers = [];

    
    public function __construct(int $start = 1, int $end = 200)
    {
        $this->start = $start;
        $this->end = $end;
        $this->calculateSums();
    }

    private function calculateSums(): void
    {
        $this->evenSum = 0;
        $this->oddSum = 0;
        $this->evenNumbers = [];
        $this->oddNumbers = [];
        

        for ($i = $this->start; $i <= $this->end; $i++) {
            if ($i % 2 === 0) {
                
                $this->evenSum += $i;
                $this->evenNumbers[] = $i;
            } else {
                
                $this->oddSum += $i;
                $this->oddNumbers[] = $i;
            }
        }
    }

 
    public function getEvenSum(): int
    {
        return $this->evenSum;
    }

    
    public function getOddSum(): int
    {
        return $this->oddSum;
    }

   
    public function getEvenNumbers(): array
    {
        return $this->evenNumbers;
    }

  
    public function getOddNumbers(): array
    {
        return $this->oddNumbers;
    }

 
    public function getRange(): array
    {
        return [
            'start' => $this->start,
            'end' => $this->end,
        ];
    }


    public function getCompleteInfo(): array
    {
        return [
            'range' => $this->getRange(),
            'evenCount' => count($this->evenNumbers),
            'oddCount' => count($this->oddNumbers),
            'evenSum' => $this->evenSum,
            'oddSum' => $this->oddSum,
            'totalSum' => $this->evenSum + $this->oddSum,
            'evenNumbers' => $this->evenNumbers,
            'oddNumbers' => $this->oddNumbers,
        ];
    }
}
?>
